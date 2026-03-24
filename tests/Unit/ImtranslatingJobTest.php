<?php

/**
 * Unit tests for ImtranslatingJob.
 *
 * These tests exercise the class in isolation.  All filesystem interaction
 * is confined to a temporary directory tree under ICMS_ROOT_PATH, so no
 * real ImpressCMS installation is needed.
 */

// ── Path resolution ────────────────────────────────────────────────────────

describe('setPath()', function () {
    it('resolves core/default paths from ICMS_ROOT_PATH and language names', function () {
        $job = new ImtranslatingJob('english', 'french', 'core', 0, 'default');

        expect($job->_from_path)->toBe(ICMS_ROOT_PATH . '/language/english/');
        expect($job->_to_path)->toBe(ICMS_ROOT_PATH . '/language/french/');
    });

    it('resolves core/install paths', function () {
        $job = new ImtranslatingJob('english', 'french', 'core', 0, 'install');

        expect($job->_from_path)->toBe(ICMS_ROOT_PATH . '/install/language/english/');
        expect($job->_to_path)->toBe(ICMS_ROOT_PATH . '/install/language/french/');
    });

    it('resolves core/system paths', function () {
        $job = new ImtranslatingJob('english', 'french', 'core', 0, 'system');

        expect($job->_from_path)->toBe(ICMS_ROOT_PATH . '/modules/system/language/english/');
        expect($job->_to_path)->toBe(ICMS_ROOT_PATH . '/modules/system/language/french/');
    });

    it('resolves core/system/admin paths', function () {
        $job = new ImtranslatingJob('english', 'french', 'core', 0, 'system/admin');

        expect($job->_from_path)->toBe(ICMS_ROOT_PATH . '/modules/system/language/english/admin/');
        expect($job->_to_path)->toBe(ICMS_ROOT_PATH . '/modules/system/language/french/admin/');
    });

    it('resolves module (non-core) paths', function () {
        $job = new ImtranslatingJob('english', 'french', 'mymodule', 0, 'default');

        expect($job->_from_path)->toBe(ICMS_ROOT_PATH . '/modules/mymodule/language/english/');
        expect($job->_to_path)->toBe(ICMS_ROOT_PATH . '/modules/mymodule/language/french/');
    });
});

// ── File listing ───────────────────────────────────────────────────────────

describe('getFileName()', function () {
    beforeEach(function () {
        // Place fixture files under ICMS_ROOT_PATH so the path helper
        // resolves them naturally (no manual _from_path override).
        $this->langFrom = ICMS_ROOT_PATH . '/language/english_getfilename_' . uniqid();
        mkdir($this->langFrom, 0777, true);
        make_lang_file($this->langFrom, 'admin.php',   ['CONST_A' => 'Hello']);
        make_lang_file($this->langFrom, 'modinfo.php', ['CONST_B' => 'World']);

        $this->job = new ImtranslatingJob();
        // Override _from_path so getFileName() scans our fixture directory.
        $this->job->_from_path = $this->langFrom . '/';
    });

    afterEach(function () {
        remove_dir($this->langFrom);
    });

    it('returns the first PHP file for step 0', function () {
        $name = $this->job->getFileName(0);
        expect($name)->toBeIn(['admin.php', 'modinfo.php']);
    });

    it('returns the second PHP file for step 1', function () {
        $name = $this->job->getFileName(1);
        expect($name)->toBeIn(['admin.php', 'modinfo.php']);
    });

    it('returns false when step is out of range', function () {
        expect($this->job->getFileName(99))->toBeFalse();
    });

    it('ignores non-PHP files', function () {
        file_put_contents($this->langFrom . '/readme.txt', 'ignored');
        // Only 2 PHP files exist → step 2 is out of range.
        expect($this->job->getFileName(2))->toBeFalse();
    });
});

// ── write() ────────────────────────────────────────────────────────────────

describe('write()', function () {
    beforeEach(function () {
        // write() builds the upload sub-path from _to_lang ('french') and
        // _fileset ('default') — NOT from an arbitrary suffix — so we must
        // use the canonical language names as directory names, all rooted
        // under ICMS_ROOT_PATH to keep str_replace() maths correct.
        $this->langFrom = ICMS_ROOT_PATH . '/language/english';
        $this->langTo   = ICMS_ROOT_PATH . '/language/french';

        if (!is_dir($this->langFrom)) {
            mkdir($this->langFrom, 0777, true);
        }
        if (!is_dir($this->langTo)) {
            mkdir($this->langTo, 0777, true);
        }
        make_lang_file($this->langFrom, 'admin.php', ['GREETING' => 'Hello']);

        if (!is_dir(_IMTRANSLATING_UPLOAD_PATH)) {
            mkdir(_IMTRANSLATING_UPLOAD_PATH, 0777, true);
        }

        // new ImtranslatingJob() sets _from_path / _to_path / _to_lang automatically.
        $this->job = new ImtranslatingJob('english', 'french', 'core', 1, 'default');

        // Simulate the POST data that write() reads internally.
        $_POST = [
            'from_lang' => 'english',
            'to_lang'   => 'french',
            'module'    => 'core',
            'step'      => 1,
            'fileset'   => 'default',
            'write'     => '1',
            'GREETING'  => 'Bonjour',
        ];
    });

    afterEach(function () {
        $_POST = [];
        remove_dir($this->langFrom);
        remove_dir($this->langTo);
        // Remove the upload sub-tree created by write() for these paths.
        remove_dir(_IMTRANSLATING_UPLOAD_PATH . '/language');
    });

    it('returns true on success', function () {
        expect($this->job->write())->toBeTrue();
    });

    it('creates the output file in the upload path', function () {
        $this->job->write();

        $destFile = _IMTRANSLATING_UPLOAD_PATH . '/language/french/admin.php';
        expect(file_exists($destFile))->toBeTrue();
    });

    it('writes translated constants into the output file', function () {
        $this->job->write();

        $contents = file_get_contents(_IMTRANSLATING_UPLOAD_PATH . '/language/french/admin.php');
        expect($contents)->toContain('define("GREETING", "Bonjour")');
    });

    it('omits reserved POST keys from the output', function () {
        $this->job->write();

        $contents = file_get_contents(_IMTRANSLATING_UPLOAD_PATH . '/language/french/admin.php');

        expect($contents)
            ->not->toContain('"step"')
            ->not->toContain('"module"')
            ->not->toContain('"to_lang"')
            ->not->toContain('"from_lang"')
            ->not->toContain('"fileset"')
            ->not->toContain('"write"');
    });
});

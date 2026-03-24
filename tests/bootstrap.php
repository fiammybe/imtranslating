<?php

/**
 * Test bootstrap for the imtranslating module.
 *
 * Defines the minimal ImpressCMS/XOOPS constants and stub classes required
 * to load class/job.php in isolation, without a live ImpressCMS installation.
 */

// ── Constants ──────────────────────────────────────────────────────────────

define('ICMS_ROOT_PATH', sys_get_temp_dir() . '/imtranslating_tests');
define('XOOPS_ROOT_PATH', ICMS_ROOT_PATH);
define('ICMS_URL', 'http://localhost');

// Note: the constant name is fixed (constants cannot be re-defined), so the
// directory is shared across the single PHP process that runs the test suite.
// Each test that writes to the filesystem creates its own sub-directory so
// runs stay isolated.  Parallel Pest workers each spin up their own process,
// so there is no cross-worker conflict.

// ── Language constants used by ImtranslatingJob ────────────────────────────
// The real constants come from the ImpressCMS language files loaded at
// runtime.  Here we provide plain-string stubs sufficient for unit tests.

define('_AM_IMTRANSL_WRITE_ERR',  'Cannot write in file %s.');
define('_AM_IMTRANSL_COMMENT',    '//New constants created via IMtranslating');

// ── Stubs ──────────────────────────────────────────────────────────────────

/**
 * Minimal stub for MyTextSanitizer.
 * The real class lives in the ImpressCMS core; here we only replicate the
 * two methods used by ImtranslatingJob (htmlSpecialChars / undoHtmlSpecialChars).
 */
if (!class_exists('MyTextSanitizer')) {
    class MyTextSanitizer
    {
        private static ?self $instance = null;

        public static function getInstance(): self
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function htmlSpecialChars(string $str): string
        {
            return htmlspecialchars($str, ENT_QUOTES);
        }

        public function undoHtmlSpecialChars(string $str): string
        {
            return htmlspecialchars_decode($str, ENT_QUOTES);
        }
    }
}

// ── Class under test ───────────────────────────────────────────────────────

require_once __DIR__ . '/../class/job.php';

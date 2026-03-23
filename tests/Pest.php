<?php

/**
 * Global Pest configuration for the imtranslating module.
 *
 * Helpers defined here are available to every test file without
 * explicit imports.  Place dataset helpers, shared `beforeEach`
 * hooks, and custom expectations here.
 */

// ── Shared helpers ─────────────────────────────────────────────────────────

/**
 * Construct and initialise an ImtranslatingJob.
 *
 * In PHP 8 the old-style constructor (method named the same as the class)
 * is no longer called automatically by `new`.  This helper creates the
 * object and then explicitly calls the initialisation method so all
 * properties — including the path pair set by setPath() — are populated
 * before assertions run.
 */
function make_job(
    string $fromLang = '',
    string $toLang   = '',
    string $module   = 'core',
    int    $step     = 0,
    string $fileset  = 'default'
): ImtranslatingJob {
    $job = new ImtranslatingJob();
    // Bypass the PHP-8 old-style-constructor behaviour by invoking the
    // method directly; it sets all instance properties and calls setPath().
    $job->ImtranslatingJob($fromLang, $toLang, $module, $step, $fileset);

    return $job;
}


/**
 * Create a minimal PHP language-file under $dir/$filename with the
 * given constant definitions and return the full path.
 *
 * @param  string              $dir
 * @param  string              $filename
 * @param  array<string,string> $constants  ['CONST_NAME' => 'value', …]
 */
function make_lang_file(string $dir, string $filename, array $constants = []): string
{
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $lines = ["<?php\n"];
    foreach ($constants as $name => $value) {
        $escaped = addslashes($value);
        $lines[] = "define('{$name}', '{$escaped}');\n";
    }
    $lines[] = "?>\n";

    $path = $dir . '/' . $filename;
    file_put_contents($path, implode('', $lines));

    return $path;
}

/**
 * Recursively remove a directory tree (used in afterEach tear-down).
 */
function remove_dir(string $path): void
{
    if (!file_exists($path)) {
        return;
    }

    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    ) as $item) {
        $item->isDir() ? rmdir((string) $item) : unlink((string) $item);
    }

    rmdir($path);
}

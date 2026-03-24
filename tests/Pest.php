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

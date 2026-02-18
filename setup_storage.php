<?php

// Set up storage symlink for file uploads
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$storageLink = public_path('storage');
$storageTarget = storage_path('app/public');

// Create symlink if it doesn't exist
if (!is_link($storageLink)) {
    if (PHP_OS_FAMILY === 'Windows') {
        // On Windows, use junction
        echo "Creating storage junction...\n";
        exec("mklink /J \"$storageLink\" \"$storageTarget\"", $output, $return);
        echo "Return code: $return\n";
    } else {
        // On Linux/Mac, create symlink
        echo "Creating storage symlink...\n";
        symlink($storageTarget, $storageLink);
    }
    echo "Storage link created successfully!\n";
} else {
    echo "Storage link already exists.\n";
}

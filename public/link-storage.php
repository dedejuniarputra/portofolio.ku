<?php

/**
 * Script to create storage symlink for Laravel on shared hosting (Hostinger, etc.)
 * Usage: Upload this file to your 'public' or 'public_html' folder and visit:
 * yourdomain.com/link-storage.php
 */

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

echo "<h1>Laravel Storage Symlink Generator</h1>";

if (file_exists($link)) {
    if (is_link($link)) {
        echo "<p style='color: orange;'>The 'storage' symlink already exists.</p>";
    } else {
        echo "<p style='color: red;'>The 'storage' directory already exists but is NOT a symlink. Please delete the 'public/storage' folder first.</p>";
    }
} else {
    if (symlink($target, $link)) {
        echo "<p style='color: green;'>Successfully created the 'storage' symlink!</p>";
        echo "<p>Your images should now load correctly.</p>";
    } else {
        echo "<p style='color: red;'>Failed to create the symlink. Please check your folder permissions.</p>";
    }
}

echo "<br><p><b>Important:</b> Delete this file after use for security reasons.</p>";

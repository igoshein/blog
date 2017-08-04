<?php

/**
 * Get All files HTML
 * @return array files.html
 */
function getDirContents($dir, &$files_path = array())
{

    foreach (scandir($dir) as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (strripos($path, '.html')) {
                $files_path[] = $path;
            }
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $files_path);
            if (strripos($path, '.html')) {
                $files_path[] = $path;
            }
        }
    }

    return $files_path;
}

$count = 0;
foreach (getDirContents(__DIR__) as $key => $path) {

    $search_string = 'str1';

    $replace_string = 'str2';

    $content_file = file_get_contents($path);
    $content_new = str_replace($search_string, $replace_string, $content_file);
    file_put_contents($path, $content_new);
    $count++;
}

echo 'Done - edit ' . $count . ' files' . PHP_EOL;

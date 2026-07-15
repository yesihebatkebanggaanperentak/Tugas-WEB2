<?php

define('BASE_PATH', __DIR__ . '/../');

// Make BASE_URL dynamic based on the request host, falling back to localhost if running in CLI
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $dirName = rtrim(dirname($scriptName), '/\\');
    $baseUrl = $protocol . $domainName . $dirName . '/';
    // Remove double slashes (except in protocol)
    $baseUrl = preg_replace('/(?<!:)\/{2,}/', '/', $baseUrl);
    define('BASE_URL', $baseUrl);
} else {
    define('BASE_URL', 'http://localhost/inventoryHub/');
}
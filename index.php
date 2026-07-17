<?php

declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
    $assetPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if (is_string($assetPath) && $assetPath !== '/' && is_file(__DIR__ . $assetPath)) {
        return false;
    }
}

$config = require __DIR__ . '/config.php';
require __DIR__ . '/functions.php';

$requestUri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$rawPath = rtrim($requestUri, '/') ?: '/';
$langPattern = implode('|', array_map(static fn (string $item): string => preg_quote($item, '#'), $config['supported_langs']));
$lang = '';
$path = $rawPath;

if (preg_match("#^/({$langPattern})(/.*)?$#", $rawPath, $matches)) {
    $lang = $matches[1];
    $path = rtrim($matches[2] ?? '/', '/') ?: '/';
} else {
    $lang = detect_lang();
    $redirect = $rawPath === '/' ? "/{$lang}/" : "/{$lang}{$rawPath}";
    header("Location: {$redirect}", true, 302);
    exit;
}

setcookie('lang', $lang, [
    'expires' => time() + 86400 * 365,
    'path' => '/',
    'samesite' => 'Lax',
]);

$pagesDir = $config['paths']['pages'];
$file = match ($path) {
    '/' => "{$pagesDir}/home.php",
    default => null,
};

if ($file === null || !is_file($file)) {
    http_response_code(404);
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>404</title></head><body><main><h1>404 Not Found</h1></main></body></html>';
    exit;
}

require $file;

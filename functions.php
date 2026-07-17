<?php

declare(strict_types=1);

/** Detect the preferred language in cookie, browser, then default order. */
function detect_lang(): string
{
    global $config;
    $supported = $config['supported_langs'];
    $default = $config['default_lang'];

    if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $supported, true)) {
        return $_COOKIE['lang'];
    }

    $accept = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '');
    foreach ($supported as $candidate) {
        if (str_starts_with($accept, $candidate)) {
            return $candidate;
        }
    }

    return $default;
}

/** Build a language-prefixed internal URL. */
function lang_url(string $path, ?string $override_lang = null): string
{
    global $lang;
    $language = $override_lang ?? $lang;
    $path = '/' . ltrim($path, '/');
    return "/{$language}{$path}";
}

/** Return the current path without query parameters or language prefix. */
function current_path(): string
{
    global $config;
    $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    $uri = rtrim($uri, '/') ?: '/';
    $languages = array_map(static fn (string $item): string => preg_quote($item, '#'), $config['supported_langs']);
    $pattern = '#^/(' . implode('|', $languages) . ')(/.*)?$#';

    if (preg_match($pattern, $uri, $matches)) {
        return rtrim($matches[2] ?? '/', '/') ?: '/';
    }

    return $uri;
}

/** Translate a content key for the active language. */
function t(string $key): string
{
    static $strings = [];
    global $config, $lang;

    if ($strings === []) {
        $file = $config['paths']['content'] . "/{$lang}.php";
        $strings = is_file($file) ? require $file : [];
    }

    return $strings[$key] ?? $key;
}

/** Build an absolute site URL. */
function url(string $path = ''): string
{
    global $config;
    $base = rtrim($config['site_url'], '/');
    $path = ltrim($path, '/');
    return $path === '' ? $base : "{$base}/{$path}";
}

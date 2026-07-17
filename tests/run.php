<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$failures = [];
$checks = 0;

function check(bool $condition, string $message): void
{
    global $checks, $failures;
    $checks++;
    if (!$condition) {
        $failures[] = $message;
    }
}

function source(string $path): string
{
    return is_file($path) ? (string) file_get_contents($path) : '';
}

$required = [
    'README.md',
    'LICENSE',
    'SECURITY.md',
    'accepted-risk.yml',
    'CHANGELOG.md',
    'index.php',
    'config.php',
    'functions.php',
    'pages/home.php',
    'package.json',
    'package-lock.json',
    'tailwind.config.js',
    'src/input.css',
    'css/tw.css',
    'favicon.svg',
    'img/og-image.svg',
];
foreach ($required as $file) {
    check(is_file("$root/$file"), "missing $file");
}

$config = is_file("$root/config.php") ? require "$root/config.php" : [];
check(($config['site_url'] ?? null) === 'https://arcanada.wiki', 'canonical URL must use HTTPS');
check(($config['default_lang'] ?? null) === 'en', 'default language must be English');
check(($config['supported_langs'] ?? null) === ['en', 'ru'], 'supported languages must be EN and RU');
check(array_key_exists('ga_id', $config), 'GA4 ID must be configurable');
check(($config['ga_id'] ?? null) === '', 'GA4 ID must remain empty until the operator configures it');

$en = is_file("$root/content/en.php") ? require "$root/content/en.php" : [];
$ru = is_file("$root/content/ru.php") ? require "$root/content/ru.php" : [];
check(array_keys($en) === array_keys($ru), 'language keys differ');
check(($en['slogan'] ?? null) === 'One human life matters', 'English slogan is missing');
check(($ru['slogan'] ?? null) === 'Жизнь одного человека имеет значение', 'Russian slogan is missing');
check(($en['status_text'] ?? null) === 'No knowledge content is published yet.', 'English coming-soon status is not honest');
check(($ru['status_text'] ?? null) === 'Материалы базы знаний пока не опубликованы.', 'Russian coming-soon status is not honest');

$functions = source("$root/functions.php");
if ($functions !== '') {
    require_once "$root/functions.php";
    $_COOKIE = ['lang' => 'ru'];
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en-US,en;q=0.9';
    check(detect_lang() === 'ru', 'language cookie must take precedence');

    $_COOKIE = [];
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'ru-RU,ru;q=0.9,en;q=0.8';
    check(detect_lang() === 'ru', 'Accept-Language must select Russian');

    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'de-DE,de;q=0.9';
    check(detect_lang() === 'en', 'unsupported Accept-Language must fall back to English');

    $lang = 'en';
    check(lang_url('/') === '/en/', 'English home URL must keep a trailing slash');
    check(lang_url('/', 'ru') === '/ru/', 'language override must keep a trailing slash');
    check(lang_url('/status') === '/en/status', 'language URL helper must prefix paths');

    $_SERVER['REQUEST_URI'] = '/ru/';
    check(current_path() === '/', 'current path must remove the Russian prefix');
    $_SERVER['REQUEST_URI'] = '/en/status?from=test';
    check(current_path() === '/status', 'current path must strip prefix and query');
}

$index = source("$root/index.php");
check(str_contains($index, "detect_lang()"), 'prefix-less routing must detect language');
check(str_contains($index, 'header("Location: {$redirect}", true, 302)'), 'prefix-less routing must issue a 302');
check(str_contains($index, "setcookie('lang'"), 'router must persist the language cookie');
check(str_contains($index, "86400 * 365"), 'language cookie must last one year');
check(str_contains($index, "'samesite' => 'Lax'"), 'language cookie must use SameSite Lax');
check(!str_contains($index, "\$_GET['lang']"), 'query-string language routing must be removed');
check(str_contains($index, "'/'=>") || str_contains($index, "'/'"), 'router must map the language home path');

$header = source("$root/templates/header.php");
$footer = source("$root/templates/footer.php");
$home = source("$root/pages/home.php");
$allUi = $header . $footer . $home;

check(str_contains($header, '/css/tw.css'), 'header must reference built Tailwind CSS');
check(!str_contains($header, 'cdn.tailwindcss.com'), 'Tailwind CDN must not be used');
check(str_contains($header, 'alpinejs@3.'), 'Alpine.js 3 must be loaded');
check(str_contains($header, 'x-data='), 'theme state must use Alpine x-data');
check(str_contains($header, "localStorage.getItem('theme')"), 'theme must load from localStorage');
check(str_contains($header, "matchMedia('(prefers-color-scheme: dark)')"), 'theme must default from system preference');
check(str_contains($header, '@click="dark = !dark"'), 'theme toggle must switch state');
check(str_contains($header, ':aria-label="dark ?'), 'theme toggle must expose a dynamic aria-label');
check(substr_count($header, '<svg') >= 3, 'brand and sun/moon icons must be SVG');
check(str_contains($header, 'lang_url($cp, \'en\')'), 'English language switch must preserve the current path');
check(str_contains($header, 'lang_url($cp, \'ru\')'), 'Russian language switch must preserve the current path');

check(str_contains($header, 'property="og:title"'), 'Open Graph title is missing');
check(str_contains($header, 'property="og:description"'), 'Open Graph description is missing');
check(str_contains($header, 'property="og:image"'), 'Open Graph image is missing');
check(str_contains($header, 'property="og:url"'), 'Open Graph URL is missing');
check(str_contains($header, 'name="twitter:card"'), 'Twitter card metadata is missing');
check(str_contains($header, 'name="twitter:title"'), 'Twitter title metadata is missing');
check(str_contains($header, 'rel="icon"'), 'favicon link is missing');
check(str_contains($header, "if (!empty(\$config['ga_id']))"), 'GA4 must be gated on a non-empty config value');
check(str_contains($header, "gtag('consent', 'default'"), 'Consent Mode v2 default is missing');
check(str_contains($header, "'analytics_storage': 'denied'"), 'analytics consent must default to denied');
check(str_contains($header, "gtag('consent', 'update'"), 'Consent Mode v2 update is missing');

check(str_contains($footer, "t('slogan')"), 'footer must render the translated slogan');
check(!str_contains($header . $home, "t('slogan')"), 'slogan must appear only in the footer');
check(str_contains($footer, 'https://arcanada.ai/<?= $lang ?>/ecosystem'), 'ecosystem footer link must use the active language');
check(str_contains($footer, 'target="_blank"'), 'ecosystem footer link must open in a new tab');
check(str_contains($footer, 'rel="noopener"'), 'ecosystem footer link must prevent opener access');

check(str_contains($header, '<header'), 'semantic header landmark is missing');
check(str_contains($header, '<nav'), 'semantic navigation landmark is missing');
check(str_contains($header, '<main'), 'semantic main landmark is missing');
check(str_contains($home, '<section'), 'semantic section landmark is missing');
check(str_contains($footer, '<footer'), 'semantic footer landmark is missing');
check(str_contains($header, 'href="#main-content"'), 'skip-to-content link is missing');
check(!preg_match('/user-scalable\s*=\s*0/i', $header), 'viewport must allow user scaling');

$package = json_decode(source("$root/package.json"), true) ?: [];
check(($package['scripts']['build:css'] ?? null) === 'tailwindcss -i src/input.css -o css/tw.css --minify', 'Tailwind build script is not canonical');
check(str_starts_with((string) ($package['devDependencies']['tailwindcss'] ?? ''), '^3.'), 'Tailwind must use the v3 CLI');
$tailwind = source("$root/tailwind.config.js");
check(str_contains($tailwind, "darkMode: 'class'"), 'Tailwind dark mode must use the class strategy');
foreach (['index.php', 'pages/**/*.php', 'templates/**/*.php', 'content/**/*.php'] as $glob) {
    check(str_contains($tailwind, $glob), "Tailwind content globs must cover $glob");
}
check(!str_contains(source("$root/css/tw.css"), ':not(.dark)'), 'built CSS must not use :not(.dark)');
check(!str_contains($allUi, ':not(.dark)'), 'templates must not use :not(.dark)');

$publicText = '';
foreach (['index.php', 'functions.php', 'content/en.php', 'content/ru.php', 'templates/header.php', 'templates/footer.php', 'pages/home.php'] as $file) {
    $publicText .= source("$root/$file");
}
check(!preg_match('/password|local login|basic auth/i', $publicText), 'local authentication UI/copy detected');
check(!preg_match('/\b(?:WIKI|AUTH|ARCA|INFRA|TUNE)-\d{4}\b/', $publicText), 'internal task identifier detected');
check(!preg_match('/100\.(?:6[4-9]|[7-9]\d|1[01]\d|12[0-7])\.\d{1,3}\.\d{1,3}/', $publicText), 'private mesh address detected');

if ($failures !== []) {
    fwrite(STDERR, implode("\n", $failures) . "\n");
    exit(1);
}

echo "site tests: {$checks} passed\n";

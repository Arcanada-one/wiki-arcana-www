<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$failures = [];

function check(bool $condition, string $message): void {
    global $failures;
    if (!$condition) {
        $failures[] = $message;
    }
}

$required = ['README.md', 'LICENSE', 'SECURITY.md', 'accepted-risk.yml', 'CHANGELOG.md', 'index.php', 'config.php'];
foreach ($required as $file) {
    check(is_file("$root/$file"), "missing $file");
}

$en = is_file("$root/content/en.php") ? require "$root/content/en.php" : [];
$ru = is_file("$root/content/ru.php") ? require "$root/content/ru.php" : [];
check(array_keys($en) === array_keys($ru), 'language keys differ');

$allText = '';
foreach ([$root . '/index.php', $root . '/content/en.php', $root . '/content/ru.php'] as $file) {
    if (is_file($file)) {
        $allText .= file_get_contents($file);
    }
}

check(str_contains($allText, 'No knowledge content is published yet'), 'missing honest initial-status copy');
check(str_contains($allText, 'https://github.com/Arcanada-one/wiki-arcana'), 'missing server repository link');
check(str_contains($allText, 'https://api.arcanada.wiki'), 'missing API link');
check(str_contains($allText, 'One human life matters'), 'missing ecosystem slogan');
check(!preg_match('/password|local login|basic auth/i', $allText), 'local authentication UI/copy detected');
check(!preg_match('/\b(?:WIKI|AUTH|ARCA|INFRA|TUNE)-\d{4}\b/', $allText), 'internal task identifier detected');

$config = is_file("$root/config.php") ? require "$root/config.php" : [];
check(($config['canonical_url'] ?? null) === 'https://arcanada.wiki', 'canonical URL must use HTTPS');

if ($failures !== []) {
    fwrite(STDERR, implode("\n", $failures) . "\n");
    exit(1);
}

echo "site tests: 15 passed\n";


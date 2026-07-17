<?php
declare(strict_types=1);
/** @var array<string,string> $content */
/** @var string $language */
?>
<!doctype html>
<html lang="<?= htmlspecialchars($language, ENT_QUOTES) ?>">
<head>
 <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Wiki Arcana global knowledge structure for agents">
 <link rel="canonical" href="https://arcanada.wiki/"><link rel="stylesheet" href="/css/custom.css?v=1"><title>Wiki Arcana</title>
</head>
<body><header class="site-header"><a class="brand" href="/">Wiki Arcana</a><nav aria-label="Primary navigation">
 <a href="#about"><?= htmlspecialchars($content['nav_about']) ?></a>
 <a href="#access"><?= htmlspecialchars($content['nav_access']) ?></a>
 <a href="#interfaces"><?= htmlspecialchars($content['nav_interfaces']) ?></a>
 <a href="/?lang=<?= $language === 'en' ? 'ru' : 'en' ?>"><?= $language === 'en' ? 'RU' : 'EN' ?></a>
</nav></header><main>


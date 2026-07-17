<?php
declare(strict_types=1);
$config = require __DIR__ . '/config.php';
$requested = $_GET['lang'] ?? $config['default_language'];
$language = in_array($requested, $config['supported_languages'], true) ? $requested : $config['default_language'];
$content = require __DIR__ . "/content/$language.php";
require __DIR__ . '/templates/header.php';
?>
<section class="hero"><p class="eyebrow">Wiki Arcana</p><h1><?= htmlspecialchars($content['hero_title']) ?></h1><p><?= htmlspecialchars($content['hero_text']) ?></p></section>
<section class="status"><h2><?= htmlspecialchars($content['status_title']) ?></h2><p><?= htmlspecialchars($content['status_text']) ?></p></section>
<section id="about"><h2><?= htmlspecialchars($content['about_title']) ?></h2><p><?= htmlspecialchars($content['about_text']) ?></p><div class="system-map">Wiki Arcana ↔ Search · Long-term memory · OIDC</div></section>
<section id="access"><h2><?= htmlspecialchars($content['access_title']) ?></h2><p><?= htmlspecialchars($content['access_text']) ?></p><ol class="levels"><li>Public</li><li>Archivist</li><li>Council</li><li>Hidden Holocron</li></ol></section>
<section id="interfaces"><h2><?= htmlspecialchars($content['interfaces_title']) ?></h2><p><?= htmlspecialchars($content['interfaces_text']) ?></p><p class="links">
 <a href="https://github.com/Arcanada-one/wiki-arcana"><?= htmlspecialchars($content['repo_server']) ?></a>
 <a href="https://github.com/Arcanada-one/wiki-arcana-www"><?= htmlspecialchars($content['repo_site']) ?></a>
 <a href="https://api.arcanada.wiki"><?= htmlspecialchars($content['api_docs']) ?></a></p></section>
<?php require __DIR__ . '/templates/footer.php'; ?>


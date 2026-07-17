<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? t('tagline');
$pageDesc = $pageDesc ?? t('description');
$canonicalUrl = url(ltrim(lang_url(current_path()), '/'));
$ogImageUrl = url('img/og-image.svg');
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES) ?>" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki Arcana — <?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES) ?>">
    <meta property="og:title" content="Wiki Arcana — <?= htmlspecialchars($pageTitle, ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImageUrl, ENT_QUOTES) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wiki Arcana — <?= htmlspecialchars($pageTitle, ENT_QUOTES) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImageUrl, ENT_QUOTES) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
    <link rel="alternate" hreflang="en" href="<?= url('en/') ?>">
    <link rel="alternate" hreflang="ru" href="<?= url('ru/') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= url('en/') ?>">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/css/tw.css?v=<?= urlencode((string) $config['version']) ?>">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.12/dist/cdn.min.js"></script>

    <?php if (!empty($config['ga_id'])): ?>
    <!-- Google tag (gtag.js), gated until a site-specific ID is configured. -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($config['ga_id'], ENT_QUOTES) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('consent', 'default', {
        'analytics_storage': 'denied',
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied'
      });
      (function () {
        var consent = null;
        try { consent = window.localStorage && localStorage.getItem('cookie-consent'); } catch (e) {}
        if (consent === 'accepted') {
          gtag('consent', 'update', {'analytics_storage': 'granted'});
        }
      })();
      gtag('js', new Date());
      gtag('config', '<?= htmlspecialchars($config['ga_id'], ENT_QUOTES) ?>');
    </script>
    <?php endif; ?>
</head>
<body
  x-data="{
    dark: localStorage.getItem('theme') === 'dark'
      || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
  }"
  x-init="
    $watch('dark', value => {
      localStorage.setItem('theme', value ? 'dark' : 'light');
      document.documentElement.classList.toggle('dark', value);
    });
    document.documentElement.classList.toggle('dark', dark);
  "
  class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100"
>
  <a href="#main-content" class="sr-only z-50 rounded-md bg-violet-700 px-4 py-3 text-white focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
    Skip to content
  </a>
  <header class="sticky top-0 z-40 border-b border-slate-200 bg-slate-50/90 backdrop-blur dark:border-white/10 dark:bg-slate-950/90">
    <div class="mx-auto flex h-16 max-w-5xl items-center justify-between gap-3 px-4 sm:px-6">
      <a href="<?= lang_url('/') ?>" class="flex min-h-11 items-center gap-3 rounded-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500">
        <svg class="h-9 w-9 text-violet-600 dark:text-violet-400" viewBox="0 0 40 40" fill="none" aria-hidden="true">
          <path d="M20 3 34 10v20L20 37 6 30V10L20 3Z" fill="currentColor" opacity=".18"/>
          <path d="m13 14 7-4 7 4v12l-7 4-7-4V14Z" stroke="currentColor" stroke-width="2"/>
          <path d="m13 14 7 4 7-4M20 18v12" stroke="currentColor" stroke-width="2"/>
        </svg>
        <span class="text-base font-semibold tracking-tight sm:text-lg">Wiki Arcana</span>
      </a>

      <nav aria-label="<?= htmlspecialchars(t('nav_label'), ENT_QUOTES) ?>" class="flex items-center gap-1.5">
        <?php $cp = current_path(); ?>
        <div class="flex items-center rounded-full bg-slate-200/70 p-1 text-xs font-semibold dark:bg-white/10">
          <a href="<?= lang_url($cp, 'en') ?>" aria-label="<?= htmlspecialchars(t('switch_english'), ENT_QUOTES) ?>"
             class="flex min-h-9 min-w-10 items-center justify-center rounded-full px-2 <?= $lang === 'en' ? 'bg-violet-600 text-white' : 'text-slate-600 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white' ?>">EN</a>
          <a href="<?= lang_url($cp, 'ru') ?>" aria-label="<?= htmlspecialchars(t('switch_russian'), ENT_QUOTES) ?>"
             class="flex min-h-9 min-w-10 items-center justify-center rounded-full px-2 <?= $lang === 'ru' ? 'bg-violet-600 text-white' : 'text-slate-600 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white' ?>">RU</a>
        </div>
        <button type="button" @click="dark = !dark"
                class="flex h-11 w-11 items-center justify-center rounded-full text-slate-600 transition-colors hover:bg-slate-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-slate-300 dark:hover:bg-white/10"
                :aria-label="dark ? '<?= htmlspecialchars(t('switch_light'), ENT_QUOTES) ?>' : '<?= htmlspecialchars(t('switch_dark'), ENT_QUOTES) ?>'">
          <svg x-show="dark" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <circle cx="12" cy="12" r="5"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
          </svg>
          <svg x-show="!dark" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>
      </nav>
    </div>
  </header>
  <main id="main-content">

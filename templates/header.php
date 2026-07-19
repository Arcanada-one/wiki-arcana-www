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

    <!-- Fonts — shared Arcanada type ramp: Cinzel (display), DM Sans (body), JetBrains Mono. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/tw.css?v=<?= urlencode((string) $config['version']) ?>">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.12/dist/cdn.min.js"></script>

    <style>
      [x-cloak] { display: none !important; }

      /* ---- Noise texture overlay (shared Arcanada canon) ---- */
      .noise::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        background-repeat: repeat;
        pointer-events: none;
        z-index: 9999;
        opacity: 0.5;
      }
      .dark .noise::before { opacity: 0.3; }

      /* ---- Sacred geometry background ---- */
      .sacred-geo { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
      .sacred-geo svg { position: absolute; opacity: 0.03; }
      .dark .sacred-geo svg { opacity: 0.06; }

      /* ---- Glow orbs ---- */
      .orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
      .orb-violet { background: rgba(139, 76, 240, 0.15); }
      .orb-gold { background: rgba(212, 160, 48, 0.08); }
      .orb-mint { background: rgba(94, 228, 199, 0.06); }
      .dark .orb-violet { background: rgba(139, 76, 240, 0.12); }
      .dark .orb-gold { background: rgba(212, 160, 48, 0.06); }

      /* ---- Arcana card frame (holocron plate) ---- */
      .arcana-card {
        position: relative;
        border: 1px solid transparent;
        background-clip: padding-box;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }
      .arcana-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, rgba(183, 148, 246, 0.2), rgba(212, 160, 48, 0.1), rgba(183, 148, 246, 0.05));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }
      .arcana-card:hover::before {
        background: linear-gradient(135deg, rgba(183, 148, 246, 0.5), rgba(212, 160, 48, 0.3), rgba(183, 148, 246, 0.2));
      }
      .arcana-card:hover { transform: translateY(-4px); box-shadow: 0 8px 40px rgba(139, 76, 240, 0.12); }
      .dark .arcana-card:hover { box-shadow: 0 8px 40px rgba(139, 76, 240, 0.2); }

      /* ---- Luminous border line ---- */
      .lumi-line { height: 1px; background: linear-gradient(90deg, transparent, rgba(183, 148, 246, 0.3), rgba(212, 160, 48, 0.2), rgba(183, 148, 246, 0.3), transparent); }
      .dark .lumi-line { background: linear-gradient(90deg, transparent, rgba(183, 148, 246, 0.2), rgba(212, 160, 48, 0.15), rgba(183, 148, 246, 0.2), transparent); }

      /* ---- Access-tier badges (Jedi Archive holocron hierarchy) ---- */
      .badge-public   { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); }
      .badge-restricted { background: rgba(212, 160, 48, 0.12); color: #e8b730; border: 1px solid rgba(212, 160, 48, 0.2); }
      .badge-council  { background: rgba(139, 76, 240, 0.15); color: #b794f6; border: 1px solid rgba(139, 76, 240, 0.25); }
      .badge-hidden   { background: rgba(148, 106, 8, 0.14); color: #d4a030; border: 1px solid rgba(148, 106, 8, 0.28); }

      /* ---- Scrollbar ---- */
      ::-webkit-scrollbar { width: 8px; }
      ::-webkit-scrollbar-track { background: transparent; }
      .dark ::-webkit-scrollbar-thumb { background: #1e1e3f; border-radius: 4px; }
      ::-webkit-scrollbar-thumb { background: #d5cee9; border-radius: 4px; }

      /* ---- Selection ---- */
      ::selection { background: rgba(139, 76, 240, 0.3); color: inherit; }

      /* ---- Fade-up initial state ---- */
      .will-animate { opacity: 0; }

      /* ---- Reduced motion ---- */
      @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
          animation-duration: 0.01ms !important;
          animation-iteration-count: 1 !important;
          transition-duration: 0.01ms !important;
        }
        .will-animate { opacity: 1; }
        .orb { display: none; }
      }
    </style>

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
  class="noise min-h-screen font-body antialiased transition-colors duration-500"
  :class="dark ? 'bg-void-950 text-void-100' : 'bg-void-50 text-void-800'"
>
  <a href="#main-content" class="sr-only z-[10000] rounded-md bg-violet-700 px-4 py-3 text-white focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
    Skip to content
  </a>
  <header class="sticky top-0 z-40 border-b backdrop-blur"
          :class="dark ? 'border-white/10 bg-void-950/80' : 'border-void-200 bg-void-50/90'">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-3 px-4 sm:px-6">
      <a href="<?= lang_url('/') ?>" class="flex min-h-11 items-center gap-3 rounded-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500">
        <svg class="h-9 w-9 text-violet-400" viewBox="0 0 40 40" fill="none" aria-hidden="true">
          <path d="M20 3 34 10v20L20 37 6 30V10L20 3Z" fill="currentColor" opacity=".18"/>
          <path d="m13 14 7-4 7 4v12l-7 4-7-4V14Z" stroke="currentColor" stroke-width="2"/>
          <path d="m13 14 7 4 7-4M20 18v12" stroke="currentColor" stroke-width="2"/>
        </svg>
        <span class="font-display text-base font-bold tracking-wider sm:text-lg"
              style="background: linear-gradient(135deg, #b794f6 0%, #d4a030 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
          WIKI ARCANA
        </span>
      </a>

      <nav aria-label="<?= htmlspecialchars(t('nav_label'), ENT_QUOTES) ?>" class="flex items-center gap-1.5">
        <?php $cp = current_path(); ?>
        <div class="flex items-center rounded-full p-1 text-xs font-semibold"
             :class="dark ? 'bg-white/10' : 'bg-void-200/70'">
          <a href="<?= lang_url($cp, 'en') ?>" aria-label="<?= htmlspecialchars(t('switch_english'), ENT_QUOTES) ?>"
             class="flex min-h-9 min-w-10 items-center justify-center rounded-full px-2 <?= $lang === 'en' ? 'bg-violet-600 text-white' : '' ?>"
             <?= $lang === 'en' ? '' : ':class="dark ? \'text-void-300 hover:text-white\' : \'text-void-500 hover:text-void-900\'"' ?>>EN</a>
          <a href="<?= lang_url($cp, 'ru') ?>" aria-label="<?= htmlspecialchars(t('switch_russian'), ENT_QUOTES) ?>"
             class="flex min-h-9 min-w-10 items-center justify-center rounded-full px-2 <?= $lang === 'ru' ? 'bg-violet-600 text-white' : '' ?>"
             <?= $lang === 'ru' ? '' : ':class="dark ? \'text-void-300 hover:text-white\' : \'text-void-500 hover:text-void-900\'"' ?>>RU</a>
        </div>
        <button type="button" @click="dark = !dark"
                class="flex h-11 w-11 items-center justify-center rounded-full transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500"
                :class="dark ? 'text-void-300 hover:bg-white/10' : 'text-void-500 hover:bg-void-200'"
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

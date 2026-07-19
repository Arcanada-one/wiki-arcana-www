<?php

declare(strict_types=1);

$pageTitle = t('tagline');
$pageDesc = t('description');
require __DIR__ . '/../templates/header.php';
?>
<section class="relative isolate overflow-hidden">
  <!-- Sacred geometry + glow orbs (shared Arcanada canon) -->
  <div class="sacred-geo" aria-hidden="true">
    <svg class="left-1/2 top-10 h-[520px] w-[520px] -translate-x-1/2 text-violet-400 animate-rotate-slow" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="0.5">
      <circle cx="100" cy="100" r="90"/><circle cx="100" cy="100" r="60"/><circle cx="100" cy="100" r="30"/>
      <path d="M100 10 190 100 100 190 10 100Z"/><path d="M100 10 100 190M10 100 190 100"/>
    </svg>
  </div>
  <div class="orb orb-violet left-[8%] top-24 h-72 w-72 animate-float" aria-hidden="true"></div>
  <div class="orb orb-gold right-[10%] top-40 h-64 w-64 animate-float-delayed" aria-hidden="true"></div>
  <div class="orb orb-mint bottom-10 left-1/3 h-56 w-56 animate-float" aria-hidden="true"></div>

  <div class="mx-auto flex min-h-[72vh] max-w-5xl flex-col items-center justify-center px-4 py-20 text-center sm:px-6 sm:py-28">
    <p class="will-animate animate-fade-up mb-6 inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.18em]"
       :class="dark ? 'border-violet-400/20 bg-violet-400/10 text-violet-300' : 'border-violet-200 bg-violet-50 text-violet-700'">
      <span class="h-1.5 w-1.5 rounded-full bg-violet-500 animate-glow-pulse" aria-hidden="true"></span>
      <?= htmlspecialchars(t('hero_eyebrow')) ?>
    </p>
    <h1 class="will-animate animate-fade-up-1 text-balance font-display text-4xl font-bold tracking-tight sm:text-6xl lg:text-7xl"
        :class="dark ? 'text-white' : 'text-void-900'">
      <?= htmlspecialchars(t('hero_title')) ?>
    </h1>
    <p class="will-animate animate-fade-up-2 mt-6 max-w-2xl text-base leading-7 sm:text-lg" :class="dark ? 'text-void-300' : 'text-void-600'">
      <?= htmlspecialchars(t('hero_text')) ?>
    </p>

    <!-- Jedi Archive access hierarchy — preview of the holocron tiers -->
    <div class="will-animate animate-fade-up-3 mt-12 grid w-full max-w-3xl grid-cols-2 gap-4 sm:grid-cols-4">
      <?php
      $tiers = [
          ['key' => 'public', 'badge' => 'badge-public'],
          ['key' => 'restricted', 'badge' => 'badge-restricted'],
          ['key' => 'council', 'badge' => 'badge-council'],
          ['key' => 'hidden', 'badge' => 'badge-hidden'],
      ];
      foreach ($tiers as $tier):
      ?>
      <div class="arcana-card rounded-2xl p-4 text-left backdrop-blur" :class="dark ? 'bg-white/5' : 'bg-white/70'">
        <span class="<?= $tier['badge'] ?> inline-flex rounded-full px-2.5 py-0.5 text-[0.65rem] font-semibold uppercase tracking-wide">
          <?= htmlspecialchars(t('tier_' . $tier['key'] . '_label')) ?>
        </span>
        <p class="mt-2 text-xs leading-5" :class="dark ? 'text-void-400' : 'text-void-500'">
          <?= htmlspecialchars(t('tier_' . $tier['key'] . '_desc')) ?>
        </p>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="will-animate animate-fade-up-4 mt-10 max-w-xl rounded-2xl arcana-card px-5 py-4 backdrop-blur sm:px-7"
         :class="dark ? 'bg-white/5' : 'bg-white/70'">
      <h2 class="font-display text-sm font-semibold" :class="dark ? 'text-white' : 'text-void-900'"><?= htmlspecialchars(t('status_title')) ?></h2>
      <p class="mt-1 text-sm leading-6" :class="dark ? 'text-void-300' : 'text-void-600'"><?= htmlspecialchars(t('status_text')) ?></p>
    </div>
  </div>
</section>
<?php require __DIR__ . '/../templates/footer.php'; ?>

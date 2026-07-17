<?php

declare(strict_types=1);

$pageTitle = t('tagline');
$pageDesc = t('description');
require __DIR__ . '/../templates/header.php';
?>
<section class="relative isolate overflow-hidden">
  <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 flex justify-center" aria-hidden="true">
    <div class="h-72 w-72 rounded-full bg-violet-300/25 blur-3xl dark:bg-violet-600/15 sm:h-96 sm:w-96"></div>
  </div>
  <div class="mx-auto flex min-h-[70vh] max-w-5xl flex-col items-center justify-center px-4 py-20 text-center sm:px-6 sm:py-28">
    <p class="mb-5 inline-flex items-center gap-2 rounded-full border border-violet-200 bg-violet-50 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-violet-700 dark:border-violet-400/20 dark:bg-violet-400/10 dark:text-violet-300">
      <span class="h-1.5 w-1.5 rounded-full bg-violet-500" aria-hidden="true"></span>
      <?= htmlspecialchars(t('hero_eyebrow')) ?>
    </p>
    <h1 class="text-balance text-4xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-6xl lg:text-7xl">
      <?= htmlspecialchars(t('hero_title')) ?>
    </h1>
    <p class="mt-6 max-w-2xl text-base leading-7 text-slate-600 dark:text-slate-300 sm:text-lg">
      <?= htmlspecialchars(t('hero_text')) ?>
    </p>
    <div class="mt-9 max-w-xl rounded-2xl border border-slate-200 bg-white/75 px-5 py-4 shadow-sm backdrop-blur dark:border-white/10 dark:bg-white/5 sm:px-7">
      <h2 class="text-sm font-semibold text-slate-950 dark:text-white"><?= htmlspecialchars(t('status_title')) ?></h2>
      <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-300"><?= htmlspecialchars(t('status_text')) ?></p>
    </div>
  </div>
</section>
<?php require __DIR__ . '/../templates/footer.php'; ?>

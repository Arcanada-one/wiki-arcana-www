  </main>
  <footer class="border-t border-slate-200 dark:border-white/10">
    <div class="mx-auto flex max-w-5xl flex-col items-center gap-5 px-4 py-10 text-center sm:px-6">
      <a href="https://arcanada.ai/<?= $lang ?>/ecosystem"
         target="_blank"
         rel="noopener"
         class="inline-flex min-h-11 items-center gap-2 rounded-lg px-3 text-sm font-medium text-violet-700 transition-colors hover:bg-violet-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-violet-300 dark:hover:bg-violet-400/10">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2 2 7l10 5 10-5-10-5ZM2 12l10 5 10-5M2 17l10 5 10-5"/></svg>
        <?= htmlspecialchars(t('ecosystem_link')) ?>
      </a>
      <div class="text-xs text-slate-500 dark:text-slate-400">
        <p class="mb-1 italic opacity-80"><?= htmlspecialchars(t('slogan')) ?></p>
        <p>&copy; <?= date('Y') ?> Arcanada. <?= htmlspecialchars(t('footer_rights')) ?></p>
      </div>
    </div>
  </footer>
</body>
</html>

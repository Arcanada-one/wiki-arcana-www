  </main>

  <footer class="relative border-t pt-14 pb-8" :class="dark ? 'border-white/5' : 'border-void-200'">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
      <div class="mb-10 grid grid-cols-2 gap-8 md:grid-cols-4">
        <!-- Brand -->
        <div class="col-span-2 md:col-span-1">
          <span class="font-display text-lg font-bold tracking-wider"
                style="background: linear-gradient(135deg, #b794f6 0%, #d4a030 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            WIKI ARCANA
          </span>
          <p class="mt-3 text-sm" :class="dark ? 'text-void-500' : 'text-void-400'"><?= htmlspecialchars(t('footer_brand_note')) ?></p>
        </div>

        <!-- Related engines (Wiki Arcana orchestrates over these) -->
        <div>
          <h4 class="mb-4 font-display text-xs font-semibold uppercase tracking-widest opacity-50"><?= htmlspecialchars(t('footer_related_heading')) ?></h4>
          <ul class="space-y-2 text-sm" :class="dark ? 'text-void-400' : 'text-void-500'">
            <li><a href="https://arcanada.ai/<?= $lang ?>/ecosystem/scrutator" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">Scrutator</a></li>
            <li><a href="https://arcanada.ai/<?= $lang ?>/ecosystem" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">Long Term Memory</a></li>
            <li><a href="https://arcanada.ai/<?= $lang ?>/ecosystem/datarim" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">Datarim</a></li>
          </ul>
        </div>

        <!-- Resources -->
        <div>
          <h4 class="mb-4 font-display text-xs font-semibold uppercase tracking-widest opacity-50"><?= htmlspecialchars(t('footer_resources_heading')) ?></h4>
          <ul class="space-y-2 text-sm" :class="dark ? 'text-void-400' : 'text-void-500'">
            <li><a href="https://arcanada.ai/<?= $lang ?>/ecosystem" target="_blank" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400"><?= htmlspecialchars(t('ecosystem_link')) ?></a></li>
            <li><a href="https://github.com/Arcanada-one/wiki-arcana" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">GitHub</a></li>
            <li><a href="https://arcanada.online" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400"><?= htmlspecialchars(t('footer_status')) ?></a></li>
          </ul>
        </div>

        <!-- Ecosystem -->
        <div>
          <h4 class="mb-4 font-display text-xs font-semibold uppercase tracking-widest opacity-50"><?= htmlspecialchars(t('footer_ecosystem_heading')) ?></h4>
          <ul class="space-y-2 text-sm" :class="dark ? 'text-void-400' : 'text-void-500'">
            <li><a href="https://arcanada.ai" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">arcanada.ai</a></li>
            <li><a href="https://datarim.club" target="_blank" rel="noopener" class="transition-colors hover:text-violet-400">datarim.club</a></li>
            <li><span>arcanada.wiki</span></li>
          </ul>
        </div>
      </div>

      <div class="lumi-line mb-6"></div>

      <div class="mb-4 text-center">
        <span class="text-sm font-medium italic tracking-wide" :class="dark ? 'text-gold-400/70' : 'text-gold-600/70'"><?= htmlspecialchars(t('slogan')) ?></span>
      </div>

      <div class="flex flex-col items-center justify-between gap-4 text-xs sm:flex-row" :class="dark ? 'text-void-500' : 'text-void-400'">
        <span>&copy; <?= date('Y') ?> Arcanada. <?= htmlspecialchars(t('footer_rights')) ?></span>
        <span class="opacity-50">arcanada.wiki</span>
      </div>
    </div>
  </footer>
</body>
</html>

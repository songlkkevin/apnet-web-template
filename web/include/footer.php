    </main>
  </div>
  <footer class="site-footer" role="contentinfo">
    <div class="site-footer-inner">
      <p class="footer-title"><strong><?= e(event_name()) ?></strong> — <?= e($site['edition'] !== '' ? $site['edition'] . ' ' : '') ?><?= e($site['name']) ?></p>
      <p class="footer-meta"><?= e($site['dates']) ?> &middot; <?= e($site['location']) ?><?php if (trim($site['contact_email']) !== ''): ?> &middot; <a href="mailto:<?= e($site['contact_email']) ?>"><?= e($site['contact_email']) ?></a><?php endif; ?></p>
    </div>
  </footer>
</div>
</body>
</html>

<?php if (!empty($page['footer'])): ?>
  <div class="callback-row red-bar-row"><?php print render($page['callback_section']); ?></div>
  <div class="footer-wrap">
  <footer class="footer <?php //print $container_class; ?>">
    <?php print render($page['footer']); ?>
  </footer>
  </div>
<?php endif; ?>

<?php 
  global $base_url; 
  global $user;
?>
<?php
	  $become_mentor_block = module_invoke('custom_popup', 'block_view', 'become-mentor-popup');
	  print render($become_mentor_block['content']);
	  
	  $callback_block = module_invoke('custom_popup', 'block_view', 'callback-popup');
    print $callback_block['content'];
    
    $join_tad_block = module_invoke('custom_popup', 'block_view', 'join-tad-popup');
    print $join_tad_block['content'];
    
    $get_in_touch_block = module_invoke('custom_popup', 'block_view', 'get-in-touch-popup');
	  print $get_in_touch_block['content'];
?>

<header id="navbar" role="banner" class="navbar navbar-default">
  <div class="<?php //print $container_class; ?> tad-nav">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if (!empty($site_name)): ?>
        <!-- <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a> -->
      <?php endif; ?>

      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <?php endif; ?>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse" id="navbar-collapse">
        
        <?php if(user_is_logged_in()) {  ?>
          <div class="user-profile-info-wrap visible-xs">
            <div class="user-name-section">
              <?php echo $user->name;?>
            </div>
            <div class="user-email-section">
              <?php echo $user->mail;?>
            </div>
            <div class='my_courses'>
              <a href='#'>My Courses & Tutorials</a>
            </div>
          </div>
        <?php }  ?>
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php //print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php //print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
        <div class="ham-social footer-social">
          <a href="https://www.facebook.com/TADCOURSES/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://in.linkedin.com/company/tadcourses/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          <a href="https://twitter.com/tadcourses" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/tadcourses/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      </div>
      <div class="user-login-trigger visible-xs">
        <?php if(!user_is_logged_in()) {  ?>
          <a href="javascript:void(0)" class="btn btn-border btnLogin">Log In</a> 
        <?php } else {  ?>
          <a href="<?php echo $base_url?>/user/logout" class="btn btn-border btnLogin">Log Out</a>
        <?php }  ?>  
      </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($page['sub_navigation'])): ?>
      <?php print render($page['sub_navigation']); ?>
    <?php endif; ?>
  </div>
</header>
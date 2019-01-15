<?php

/**
 * @file
 * The primary PHP file for this theme.
 */

function tad_css_alter(&$css) {
   
    unset($css['sites/all/themes/bootstrap/css/3.3.7/overrides.min.css']);

}

function tad_preprocess_page(&$variables) {
  if (isset($variables['node']->type)) {
   // If the content type's machine name is "my_machine_name" the file
   // name will be "page--node--my-machine-name.tpl.php".
   $variables['theme_hook_suggestions'][] = 'page__node__' . $variables['node']->type;
   }
} 

function tad_menu_tree__main_menu(&$variables) {
    return '<ul class="nav navbar-nav navbar-right">' . $variables['tree'] . '</ul>';
  }
<?php

/**
 * @file
 * The primary PHP file for this theme.
 */

function tad_css_alter(&$css) {
   
    unset($css['sites/all/themes/bootstrap/css/3.3.7/overrides.min.css']);

}
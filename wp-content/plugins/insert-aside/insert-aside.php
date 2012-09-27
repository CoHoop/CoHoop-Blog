<?php
/*
Plugin Name: Insert Aside
Plugin URI: http://enigmastation.com
Description: Plugin inserts "aside" content
Author: Joseph B. Ottinger (joeo@enigmastation.com)
Version: 1.0
Author URI: http://enigmastation.com/
*/

add_filter('the_content', 'handle_insert_aside');



function handle_insert_aside($the_content)
{
   $new_content = preg_replace("/\[aside\]/i", "<div class='insertaside'>", $the_content);
   $new_content = preg_replace("/\[\/aside\]/i", "</div>", $new_content);
   return $new_content;
}
?>
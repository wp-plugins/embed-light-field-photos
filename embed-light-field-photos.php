<?php  
/* 
Plugin Name: Embed Light Field Photos
Plugin URI: http://www.lightfieldphotobook.com/wordpress-plugins/embed-light-field-photos
Description: Simply drop URL of a light field photo from Lytro.com in your post and the photo will be displayed there (the same as you do with Youtube videos).
Version: 1.1 
Author: Light Field Photobook
Author URI: http://www.lightfieldphotobook.com
*/

/*  Copyright 2012 http://www.lightfieldphotobook.com (e-mail: admin@lightfieldphotobook.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter('the_content', 'embed_light_field_photo');  
function embed_light_field_photo($text) {  

preg_match_all("/(http:\/\/|https:\/\/)(www.lytro.com|lytro.com)(\/living-pictures\/)(.*)/", $text, $matches, PREG_SET_ORDER);
foreach ($matches as $val) {
$pieces = explode("/", $val[0]);
$photo_id = ereg_replace ('<', '', $pieces[4]);
$text = ereg_replace($val[0], '<iframe src="http://www.lytro.com/living-pictures/'.$photo_id.'/embed?utm_source=Embed&amp;utm_medium=EmbedLink" scrolling="no" width="500" frameborder="0" height="515"></iframe>', $text);
}
preg_match_all("/(http:\/\/|https:\/\/)(pictures.lytro.com)(.*)/", $text, $matches, PREG_SET_ORDER);
foreach ($matches as $val) {
$photo_id = ereg_replace ('<', '', $val[0]);
$photo_id = ereg_replace ('p>', '', $val[0]);
$text = ereg_replace($val[0], '<iframe src="'.$photo_id.'/embed/" width="500" frameborder="0" height="515" allowfullscreen></iframe>', $text);
}
return $text;
}

function embed_light_field_photo_options_page() {
?>
   <div class="wrap">
   	<h2><?php _e('Embed Lytro Light Field Photos', HI_TEXTDOMAIN); ?></h2>
<br />
Thank you for using Embed Lytro Light Field Photos plugin. Visit <a href="http://www.lightfieldphotobook.com" target="_blank">www.lightfieldphotobook.com</a> for more news about the Lytro camera and light field photography.
   </div>
<?php
}

function embed_light_field_photo_admin_menu() {
   add_options_page(__('Lytro Light Field Photos', HI_TEXTDOMAIN), __('Lytro Light Field Photos', HI_TEXTDOMAIN), 'manage_options', basename(__FILE__), 'embed_light_field_photo_options_page');
}

add_action('admin_menu', 'embed_light_field_photo_admin_menu');
?>
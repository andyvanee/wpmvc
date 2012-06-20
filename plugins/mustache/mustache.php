<?php
/**
 * @package Mustache
 */
/*
Plugin Name: Mustache
Plugin URI: 
Description: Add Mustache templating to wordpress
Version: 0.0.1
Author: Andy Vanee <andy@nonfiction.ca>
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once('lib/Mustache.php');

class N_View {
  function render() {
    $template_path = TEMPLATEPATH.'/templates';
    $template = file_get_contents($template_path.'/'.$this->template.'.mustache');
    $m = new Mustache;
    echo $m->render($template, $this->assigns);
  }
}

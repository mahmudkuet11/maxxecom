<?php

function active_menu($menu_item='', $active_menu){
    if(!isset($active_menu)) $active_menu = '';
    if($active_menu == $menu_item) return 'active';
    else return '';
}
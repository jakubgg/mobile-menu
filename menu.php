<?php

if (!function_exists('mobile_nav')){
/**
* Create Mobile Menu wrapped in <select> and <form> and echo it in place.
*
* @param string $menu_name Name of the menu that will be used to create Mobile Menu. If none passed, select the first menu from Wordpress nav_menus
* @return void
*/
    function mobile_nav($menu_name=''){
        //declare all variables
        $select_prefix = '';
        $select_suffix = '';
        $options = array();
        $menu_list = '';
        $mobile_menu = '';
       
        // if $menu_name empty get first menu form the list
        if(empty($menu_name)){
            $menu_list = wp_get_nav_menus();
            $menu_name =  $menu_list[0]->name;
        }
   
        //get all items of selected menu
        $menu_list = wp_get_nav_menu_items( $menu_name );
        //create <option> items
        foreach ($menu_list as $single_item) {
            $options[] = '<option value="' . $single_item->url . '">';
            $options[] .= $single_item->title;
            $options[] .= '</option>';
        };
        //<form> and <select> start
        $select_prefix = "<form>\n
<select id='page-dropdown' name='page-dropdown' onchange='document.location.href=this.options[this.selectedIndex].value;'>\n
<option value=''>Select page</option>\n ";
       
        //<form> and <select> end
        $select_suffix = "</select>\n
</form>\n";
       
        // put the whole menu together
        $mobile_menu .= $select_prefix;
        foreach ($options as $one_option){
            $mobile_menu .= $one_option;
        }
        $mobile_menu .= $select_suffix;
       
        echo $mobile_menu;
    }
}
?>

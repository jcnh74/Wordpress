<?php
/*
Plugin Name: Fisher Inc Category UI
Plugin URI: http://fisherinc.com/
Description: Plugin for showing categories.
Version: 1.0
Author: Neil Tan
Author URI: http://neiltan.net
*/

function pods_ui_categories()
{
  $icon = '';
  add_object_page('Reorder Categories', 'Reorder Categories', 'read', 'reorder categories', '', $icon);
  add_submenu_page('reorder categories', 'Reorder Categories', 'Reorder Categories', 'read', 'reorder categories', 'categories_page');
}

function categories_page () {
    $object = new Pod('portfolio_categories');
    $add_fields = $edit_fields = array(
				'name',
				'category');
    $object->ui = array(
						'title' => 'Portfolio Categories',
						'reorder' => 'displayorder',
						'reorder_columns' => array(
							'name' => 'Name'),
                        'columns' => array(
								'name' => 'Name',
                              	'created' => 'Date Created',
                                'modified' => 'Last Modified'),
                        'add_fields' => $add_fields,
                        'edit_fields' => $edit_fields
                        );
    pods_ui_manage($object);
    /*
    // or you can pass as an array, if you want something simple!
    pods_ui_manage(array('pod' => 'pods_ui_gadget',
                         'title' => 'Gadgets',
                         'item' => 'Gadget',
                         'columns'=>array('name' => 'Name',
                                          'approved'=>array('coltype' => 'boolean',
                                                            'label' => 'Approved'),
                                          'created' => 'Date Created',
                                          'modified' => 'Last Modified'),
                         'add_fields'=>array('name',
                                             'information'),
                         'edit_fields'=>array('name',
                                              'information',
                                              'approved'),
                         'filters' => 'related_gadget'));
    */
}

add_action('admin_menu','pods_ui_categories');

?>
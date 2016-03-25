<?php
/*
Plugin Name: Fisher Inc Portfolio UI
Plugin URI: http://fisherinc.com/
Description: Plugin for showing projects based on categories.
Version: 1.0
Author: Neil Tan
Author URI: http://neiltan.net
*/

function pods_ui_projects()
{
  $icon = '';
  add_object_page('Reorder Projects', 'Reorder Projects', 'read', 'reorder projects', '', $icon);
  add_submenu_page('reorder projects', 'Reorder Projects', 'Reorder Projects', 'read', 'reorder projects', 'projects_page');
}

function projects_page () {
    $object = new Pod('portfolio_projects');
    $add_fields = $edit_fields = array(
				'name',
				'category');
    $object->ui = array(
						'title' => 'Portfolio Projects',
						'reorder' => 'displayorder',
						'reorder_columns' => array(
							'name' => 'Name',
							'category' => 'Category'),
                        'columns' => array(
								'name' => 'Name',
								'category' => 'Category',
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

add_action('admin_menu','pods_ui_projects');

?>
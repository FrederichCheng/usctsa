<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Layouts
|--------------------------------------------------------------------------
|
| specify the name of the layouts and their fields associated with them
*/

$config['default_layout'] = 'main';

$config['layouts_folder'] = '_layouts';

$config['layouts']['main'] = array(
	//'file' 		=> $config['layouts_path'].'main',
	// 'class'		=> 'Main_layout',
	// 'filepath' => 'libraries',
	// 'filename' => 'Main_layout.php',
	
	
	'fields'	=> array(
		'Header' => array('type' => 'fieldset', 'label' => 'Header', 'class' => 'tab'),
		'page_title' => array('label' => lang('layout_field_page_title')),
		'meta_description' => array('label' => lang('layout_field_meta_description')),
		'meta_keywords' => array('label' => lang('layout_field_meta_keywords')),
		'Body' => array('type' => 'fieldset', 'label' => 'Body', 'class' => 'tab'),
		'heading' => array('label' => lang('layout_field_heading')),
		'body' => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),
		'body_class' => array('label' => lang('layout_field_body_class')),
	)
);

$config['layouts']['test'] = array(
	//'file' 		=> $config['layouts_path'].'main',
	// 'class'		=> 'Main_layout',
	// 'filepath' => 'libraries',
	// 'filename' => 'Main_layout.php',
	
	
	'fields'=> array(
		'Body' => array('type' => 'fieldset', 'label' => 'Body', 'class' => 'tab'),
		'body' => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),
	)
);

$config['layouts']['events'] = array(
	//'file' 		=> $config['layouts_path'].'main',
	// 'class'		=> 'Main_layout',
	// 'filepath' => 'libraries',
	// 'filename' => 'Main_layout.php',
	
	
	'fields'=> array(
		'page_title' => array('label' => lang('layout_field_page_title')),
		'meta_description' => array('label' => lang('layout_field_meta_description')),
		'meta_keywords' => array('label' => lang('layout_field_meta_keywords')),
            )
);

$common_meta = array(
    'Meta' => array('type' => 'fieldset', 'label' => 'Meta', 'class' => 'tab'),
    'meta_section' => array('type' => 'copy', 'label' => 'The following fields control the meta information found in the head of the HTML.'),
    'page_title' => array('style' => 'width: 520px', 'label' => lang('layout_field_page_title')),
    'meta_description' => array('style' => 'width: 520px', 'label' => lang('layout_field_meta_description')),
    'meta_keywords' => array('style' => 'width: 520px', 'label' => lang('layout_field_meta_keywords')),
);

$common_sections = array(
	'Sections' => array('type' => 'fieldset', 'label' => 'Sections', 'class' => 'tab'),
	'section_description' => array('type' => 'copy', 'label' => 'The following fields control the sections of the legal page.'),
);

$common_footer = array(
	'Footer' => array('type' => 'fieldset', 'label' => 'Footer', 'class' => 'tab'),
	'footer_description' => array('type' => 'copy', 'label' => 'The following fields control the footer of the legal page.'),
	'page_footer' => array('style' => 'width: 520px', 'label' => 'Page footer'),
);

$home_sections = array(
	'cover_photo_1' => array('label'=>'Cover photo 1', 'type'=>'asset'),
	'cover_photo_2' => array('label'=>'Cover photo 2', 'type'=>'asset'),
	'cover_photo_3' => array('label'=>'Cover photo 3', 'type'=>'asset'),
	'cover_photo_4' => array('label'=>'Cover photo 4', 'type'=>'asset'),
	'heading' => array('label' => lang('layout_field_heading')),
	"sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 900px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 800px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 800px; height: 300px;'),
                                            ))
);

$newstudents_sections = array(
	'top_heading' => array('label' => 'Top Heading'),
	'top_sections' => array('label' => 'Top Sections', 'type' => 'textarea'),
	'tw_office_heading' => array('label' => 'Taiwan Office Heading'),
	'tw_office_sections' => array('label' => 'Taiwan Office Sections', 'type' => 'textarea'),
);





/* ------------------------------    Home  Layout   ------------------------------ */
/* ------------------------------------------------------------------------------- */

$home_layout = new Fuel_layout('home');
$home_layout->set_description('This is the home layout used for the home page.');
$home_layout->set_label('home');
$home_layout->add_fields($common_meta);
$home_layout->add_fields($common_sections);
$home_layout->add_fields($home_sections);
$home_layout->add_fields($common_footer);
$config['layouts']['home'] = $home_layout; // !!! IMPORTANT ... NOW ASSIGN THIS TO THE home "layouts"

// old-way setting
/*$home_layout->add_field('Sections',  array('type' => 'fieldset', 'label' => 'Sections', 'class' => 'tab'));
$home_layout->add_field('section_description', array('type' => 'copy', 'label' => 'The following fields control the sections of the legal page.'));
$home_layout->add_field('sections', array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 900px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 800px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 800px; height: 300px;'),
                                            )));*/

/* ------------------------------------------------------------------------------- */





/* ---------------------------    Newstudents  Layout   -------------------------- */
/* ------------------------------------------------------------------------------- */

$newstudents_layout = new Fuel_layout('newstudents');
$newstudents_layout->set_description('This is the newstudents layout used for the newstudents page.');
$newstudents_layout->set_label('newstudents');
$newstudents_layout->add_fields($common_meta);
$newstudents_layout->add_fields($common_sections);
$newstudents_layout->add_fields($newstudents_sections);
$newstudents_layout->add_fields($common_footer);
$config['layouts']['newstudents'] = $newstudents_layout; // !!! IMPORTANT ... NOW ASSIGN THIS TO THE newstudents "layouts"

/* ------------------------------------------------------------------------------- */

/* End of file MY_fuel_layouts.php */
/* Location: ./application/config/MY_fuel_layouts.php */


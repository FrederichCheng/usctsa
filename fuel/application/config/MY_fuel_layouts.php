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

$about_sections = array(
	
        'about_content' => array('type' => 'textarea', 'label' => 'Content of About'),
	'heading' => array('label' => lang('layout_field_heading')),
	'sections' => array( 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
           'fields' => array(
                'sections' => array('type' => 'section', 'label' => 'Members'),
                'title_left' => array('label' => 'Title'), 
                'img_left' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Picture'),
                'name_left' => array('label' => 'Name'),
                'major_left' => array('label' => 'Major'),
                'email_left' => array('label' => 'Email'),
                'intro_left' => array('type' => 'textarea','label' => 'Introduction'),
                
                'title_right' => array('label' => 'Title'),
                'img_right' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;','label' => 'Picture'),
                'name_right' => array('label' => 'Name'),
                'major_right' => array('label' => 'Major'),
                'email_right' => array('label' => 'Email'),
                'intro_right' => array('type' => 'textarea','label' => 'Introduction'),
                ))
);

$about_layout = new Fuel_layout('about');
$about_layout->set_description('This is the about layout');
$about_layout->set_label('about');
$about_layout->add_fields($common_meta);
$about_layout->add_fields($common_sections);
$about_layout->add_fields($about_sections);
$about_layout->add_fields($common_footer);

$config['layouts']['about'] = $about_layout;

$cars_sections = array(
	 
	'heading' => array('label' => lang('layout_field_heading')),
	'sections' => array( 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
           'fields' => array(
                'sections' => array('type' => 'section', 'label' => 'Car Information'),
               
                'car_BigImg' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Car Big Image'),
                'model' => array('label' => 'Car Model'), 
                'year' => array('label' => 'Year'),
                'miles' => array('label' => 'Miles'), 
                'location' => array('label' => 'Location'), 
                'saler' => array('label' => 'Saler'), 
                'mobile' => array('label' => 'Mobile'),  
                'email' => array('label' => 'Email'), 
                'price' => array('label' => 'Price'), 
                'description' => array('type' => 'textarea','label' => 'Description'),
                'sImg_1' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 1'),
                'sImg_2' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 2'),
                'sImg_3' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 3'),
                'sImg_4' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 4'),
                'sImg_5' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 5'),
                'sImg_6' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 6'),
                'sImg_7' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 7'),
                'sImg_8' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'Small Image 8'),
               
                ))
);

$cars_layout = new Fuel_layout('cars');
$cars_layout->set_description('This is the cars layout');
$cars_layout->set_label('cars');
$cars_layout->add_fields($common_meta);
$cars_layout->add_fields($common_sections);
$cars_layout->add_fields($cars_sections);
$cars_layout->add_fields($common_footer);

$config['layouts']['cars'] = $cars_layout;


$housing_sections = array(
	 
	'heading' => array('label' => lang('layout_field_heading')),
	'sections' => array( 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
        'fields' => array(
                'sections' => array('type' => 'section', 'label' => 'Housing Information'),
                'house_img_left' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'House Image'),
                'location_left' => array('label' => 'Location'), 
                'price_left' => array('label' => 'Price'),
                'description_left' => array('type' => 'textarea','label' => 'Description'),
            
                'house_img_right' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'House Image'),
                'location_right' => array('label' => 'Location'), 
                'price_right' => array('label' => 'Price'),
                'description_right' => array('type' => 'textarea','label' => 'Description'),
                        
                ))
);

$housing_layout = new Fuel_layout('housing');
$housing_layout->set_description('This is the housing layout');
$housing_layout->set_label('housing');
$housing_layout->add_fields($common_meta);
$housing_layout->add_fields($common_sections);
$housing_layout->add_fields($housing_sections);
$housing_layout->add_fields($common_footer);

$config['layouts']['housing'] = $housing_layout;
//$config['layouts']['about'] = array(
//	//'file' 		=> $config['layouts_path'].'main',
//	// 'class'		=> 'Main_layout',
//	// 'filepath' => 'libraries',
//	// 'filename' => 'Main_layout.php',
//	
//	
//	'fields'	=> array(
//		'Header' => array('type' => 'fieldset', 'label' => 'Header', 'class' => 'tab'),
//		'page_title' => array('label' => lang('layout_field_page_title')),
//		'meta_description' => array('label' => lang('layout_field_meta_description')),
//		'meta_keywords' => array('label' => lang('layout_field_meta_keywords')),
//		'Body' => array('type' => 'fieldset', 'label' => 'Body', 'class' => 'tab'),
//		'heading' => array('label' => lang('layout_field_heading')),
//		'body' => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),
//		'body_class' => array('label' => lang('layout_field_body_class')),
//              
//                //'president_img' => array('label' => 'president'),
//                
//            
//            //$fields['file_example'] = array('type' => 'file', 'overwrite' => TRUE, 'display_overwrite' => TRUE, 'multiple' => FALSE, 'file_name' => 'my_file_{id}');
//                'title_left' => array('label' => 'title_left'), 
//                'president_img' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;', 'label' => 'president'),
//                'president_name' => array('label' => 'president name'),
//                'president_major' => array('label' => 'president major'),
//                'president_email' => array('label' => 'president email'),
//                'president_intro' => array('type' => 'textarea','label' => 'president intro'),
//                
//                'title_right' => array('label' => 'title_right'),
//                'vice_president_img' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;','label' => 'vice president'),
//                'vice_president_name' => array('label' => 'vice president name'),
//                'vice_president_major' => array('label' => 'vice president major'),
//                'vice_president_email' => array('label' => 'vice president email'),
//                'vice_president_intro' => array('type' => 'textarea','label' => 'vice president intro'),
//            
//            
//                'public_relation_img' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;','label' => 'public relation'),
//                'public_relation_name' => array('label' => 'public relation name'),
//                'public_relation_major' => array('label' => 'public relation major'),
//                'public_relation_email' => array('label' => 'public relation email'),
//                'public_relation_intro' => array('type' => 'textarea','label' => 'public relation intro'),
//                'web_technician_img' => array('type' => 'asset', 'style' => 'width: 200px; height: 200px;','label' => 'web technician'),
//                'web_technician_name' => array('label' => 'web technician name'),
//                'web_technician_major' => array('label' => 'web technician major'),
//                'web_technician_email' => array('label' => 'web technician email'),
//                'web_technician_intro' => array('type' => 'textarea','label' => 'web technician intro'),
//	)
//    
//);

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


$config['layouts']['market'] = array(
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




/* -------- Setting variables for home, newstudents and jobs pages (Sky)   ------- */
/* ------------------------------------------------------------------------------- */

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
	'sections' => array( 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 850px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 850px; height: 300px;'),
                                            ))
);

$newstudents_sections = array(
	
	/* ----- Top Section ----- */
	'top_title' => array('type' => 'copy', 'label' => 'Top Section Setting'),
	'top_scroller' => array('label' => 'Top Section Pagescroller'),
	'top_heading' => array('label' => 'Top Section Heading'),
	'top_description' => array('style' => 'width: 520px', 'label' => 'Top Section Description'),
	'top_sections' => array('label' => 'Top Section Content', 'type' => 'textarea'),
	
	/* ------ Taiwan Office Section ----- */
	'tw_office_title' => array('type' => 'copy', 'label' => 'Taiwan Office Section Setting'),
	'tw_office_scroller' => array('label' => 'Taiwan Office Section Pagescroller'),
	'tw_office_heading' => array('label' => 'Taiwan Office Section Heading'),
	'tw_office_description' => array('style' => 'width: 520px', 'label' => 'Taiwan Office Section Description'),
	'tw_office_sections' => array('label' => 'Taiwan Office Section Content', 'type' => 'textarea'),
	
	/* ------ Materials Receiving Section ------ */
	'recv_title' => array('type' => 'copy', 'label' => 'Materials Receiving Section Setting'),
	'recv_scroller' => array('label' => 'Materials Receiving Section Pagescroller'),
	'recv_heading' => array('label' => 'Materials Receiving Section Heading'),
	'recv_description' => array('style' => 'width: 520px', 'label' => 'Materials Receiving Section Description'),
	"recv_sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 850px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 850px; height: 300px;'),
                                            )),
                                            
    /* ------ Important Notes Section ------ */                    
    'important_title' => array('type' => 'copy', 'label' => 'Important Notes Section Setting'),
    'important_scroller' => array('label' => 'Important Notes Section Pagescroller'),                                      
	'important_heading' => array('label' => 'Important Notes Section Heading'),
	'important_description' => array('style' => 'width: 520px', 'label' => 'Important Notes Section Description'),
	"important_sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 850px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 850px; height: 300px;'),
                                            )),
                                            
	/* ------ Experience Sharing Section ------ */  
	'experience_title' => array('type' => 'copy', 'label' => 'Experience Sharing Section Setting'),
    'experience_scroller' => array('label' => 'Experience Sharing Section Pagescroller'),                                        
	'experience_heading' => array('label' => 'Experience Sharing Section Heading'),
	'experience_description' => array('style' => 'width: 520px', 'label' => 'Experience Sharing Section Description'),
	"experience_sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 850px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 850px; height: 300px;'),
                                            )),
                                            
    /* ------ Useful Website Section ------ */  
    'useful_title' => array('type' => 'copy', 'label' => 'Useful Website Section Setting'),
    'useful_scroller' => array('label' => 'Useful Website Section Pagescroller'),                                        
	'useful_heading' => array('label' => 'Useful Website Section Heading'),
	'useful_description' => array('style' => 'width: 520px', 'label' => 'Useful Website Section Description'),
	'useful_sections' => array('label' => 'Useful Website Section Content', 'type' => 'textarea'),
);

$jobs_sections = array(
	
	/* ----- Top Section ----- */
	'top_title' => array('type' => 'copy', 'label' => 'Top Section Setting'),
	'top_scroller' => array('label' => 'Top Section Pagescroller'),
	'top_heading' => array('label' => 'Top Section Heading'),
	'top_description' => array('style' => 'width: 520px', 'label' => 'Top Section Description'),
	'top_sections' => array('label' => 'Top Section Content', 'type' => 'textarea'),
                                            
    /* ------ Job Opportunity Section ------ */                    
    'opportunity_title' => array('type' => 'copy', 'label' => 'Job Opportunity Section Setting'),
    'opportunity_scroller' => array('label' => 'Job Opportunity Section Pagescroller'),                                      
	'opportunity_heading' => array('label' => 'Job Opportunity Section Heading'),
	'opportunity_description' => array('style' => 'width: 520px', 'label' => 'Job Opportunity Section Description'),
	"opportunity_sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 700px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 500px'),
                                                'link' => array('style' => 'width: 500px'),
                                                'job_type' => array('style' => 'width: 500px'),
                                                'job_description' => array('style' => 'width: 500px'),
                                                'company' => array('style' => 'width: 500px'),
                                                'location' => array('style' => 'width: 500px'),
                                            )),
                                            
	/* ------ Experience Sharing Section ------ */  
	'experience_title' => array('type' => 'copy', 'label' => 'Experience Sharing Section Setting'),
    'experience_scroller' => array('label' => 'Experience Sharing Section Pagescroller'),                                        
	'experience_heading' => array('label' => 'Experience Sharing Section Heading'),
	'experience_description' => array('style' => 'width: 520px', 'label' => 'Experience Sharing Section Description'),
	"experience_sections" => array('display_label' => FALSE, 'add_extra' => FALSE, 'init_display' => 'none', 'dblclick' => 'accordian', 'repeatable' => TRUE, 'style' => 'width: 950px;', 'type' => 'template', 'label' => 'Page sections', 'title_field' => 'title',
                                            'fields' => array(
                                                'sections' => array('type' => 'section', 'label' => '{__title__}'),
                                                'title' => array('style' => 'width: 850px'),
                                                'content' => array('type' => 'textarea', 'style' => 'width: 850px; height: 300px;'),
                                            )),
                                            
    /* ------ Useful Website Section ------ */  
    'useful_title' => array('type' => 'copy', 'label' => 'Useful Website Section Setting'),
    'useful_scroller' => array('label' => 'Useful Website Section Pagescroller'),                                        
	'useful_heading' => array('label' => 'Useful Website Section Heading'),
	'useful_description' => array('style' => 'width: 520px', 'label' => 'Useful Website Section Description'),
	'useful_sections' => array('label' => 'Useful Website Section Content', 'type' => 'textarea'),
);

/* ------------------------------------------------------------------------------- */


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


/* ------------------------------    Jobs  Layout   ------------------------------ */
/* ------------------------------------------------------------------------------- */

$jobs_layout = new Fuel_layout('jobs');
$jobs_layout->set_description('This is the jobs layout used for the jobs page.');
$jobs_layout->set_label('jobs');
$jobs_layout->add_fields($common_meta);
$jobs_layout->add_fields($common_sections);
$jobs_layout->add_fields($jobs_sections);
$jobs_layout->add_fields($common_footer);
$config['layouts']['jobs'] = $jobs_layout; // !!! IMPORTANT ... NOW ASSIGN THIS TO THE jobs "layouts"

/* ------------------------------------------------------------------------------- */


/* ------------------------------    Contact  Layout   ------------------------------ */
/* ------------------------------------------------------------------------------- */

$contact_layout = new Fuel_layout('contact');
$contact_layout->set_description('This is the contact layout used for the contact page.');
$contact_layout->set_label('contact');
$contact_layout->add_fields($common_meta);
$contact_layout->add_fields($common_sections);
/*$contact_layout->add_fields($contact_sections);*/
$contact_layout->add_fields($common_footer);
$config['layouts']['contact'] = $contact_layout; // !!! IMPORTANT ... NOW ASSIGN THIS TO THE contact "layouts"

/* ------------------------------------------------------------------------------- */


/* End of file MY_fuel_layouts.php */
/* Location: ./application/config/MY_fuel_layouts.php */


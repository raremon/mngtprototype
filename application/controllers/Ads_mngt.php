<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Ad Management Controller

	// MY_Controller in Core Folder
	class Ads_mngt extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');
		}
		
		// Index Function
		public function upload()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Ads Management';
			$data['page_description'] = 'Upload/Browse Ads';
            $data['breadcrumbs']=array
		      (
                array('Upload New Ad','ads_mngt/upload'),
		      );
            $data['css']=array
            (
            	'assets/css/browse_style.css',
            );
            $data['script']=array
            (

            );
			$data['treeActive'] = 'ads_management';
			$data['childActive'] = 'upload_new_ad' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/ad_upload", $data);
			$this->load->view("template/footer", $data);
		}

	}

// END OF AD MANAGEMENT CONTROLLER
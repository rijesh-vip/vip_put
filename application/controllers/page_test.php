<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_test extends CI_Controller {

	
	public function index()
	{
		$this->load->helper('common_helper');
		$data	=	array();
		if($_POST)
		{
			require_once 'simplehtmldom/simple_html_dom.php';
			$url = $_POST['testurl'];
			$website = file_get_html($url);
			$request_urls	=	array();
			$cnt	=	0;
			foreach ($website->find('link[rel="stylesheet"]') as $stylesheet)
			{
				$request_urls[]		=		$url.$stylesheet->href;
			}
			foreach ($website->find('script') as $stylesheet)
			{	
			
				if($stylesheet->src<>""){
					$stylesheet_url = $stylesheet->src;
					if (!preg_match("~^(?:f|ht)tps?://~i", $stylesheet->src)) 
					{
						$request_urls[]		=		$url.$stylesheet->src;
					}
					else
					{
						$request_urls[]		=		$stylesheet->src;
					}
					
				}
			}
			foreach ($website->find('img') as $stylesheet)
			{
				$stylesheet_url = $stylesheet->src;
				$request_urls[]		=		$url.$stylesheet->src;
			}
			$data['request_urls']	=	$request_urls;
		}

		$this->load->view('template/header');
		$this->load->view('page_test',$data);
		$this->load->view('template/footer');
	}
	
}
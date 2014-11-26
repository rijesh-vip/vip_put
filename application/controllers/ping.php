<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ping extends CI_Controller {

	public function index()
	{
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);
		$data = array();
		if($this->input->post('domain_name'))
		{
			//Add validation after removing http and other elements which are not part of domain name
			$domain_name = $this->input->post('domain_name');
			if($this->input->post('action_type') == 'ping')
			{
				$data['ping'] = $this->_ping_domain($domain_name);
				$this->load->view('ping_result', $data);	
			}
			elseif($this->input->post('action_type') == 'traceroute')
			{
				$data['traceroute'] = $this->_traceroute_domain($domain_name);
				$this->load->view('traceroute_result', $data);	
			}
			else
			{
				die('Unknown Request.');
			}
			exit;
		}
		$this->load->view('template/header');
		$this->load->view('ping_traceroute');
		$this->load->view('template/footer');
	}

	private function _ping_domain($domain)
	{
		$result = array();
		exec("ping -c 4 $domain 2>&1", $result['output'], $result['return_var']);
		return $result;
	}

	private function _traceroute_domain($domain)
	{
		$result = array();
		exec("traceroute $domain", $result['output'], $result['return_var']);
		return $result;
	}

}

/* End of file ping.php */
/* Location: ./application/controllers/ping.php */
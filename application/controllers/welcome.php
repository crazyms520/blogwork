<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
	$this->load->model('user');
	}
	public function index()
	{	$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user->get_user_by_id($user_id);
		$data['user_login'] = $this->session->userdata('user_login');
		$this->load->view('welcome_message',$data);
	}
}


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
		$data['message'] = '';
		if($data['user_login']){
			$data['message'] = 'message1';
		}else{
			$data['message'] = 'message2';
		}

		$this->load->view('welcome_message',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
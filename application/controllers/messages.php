<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
    $this->load->model('message');
    date_default_timezone_set("Asia/Taipei");
  }
  public function index(){
    $content = $this->input->post('messages');
    $data['user_login'] = $this->session->userdata('user_login');
    $data['user_id'] = $this->session->userdata('user_id');
    $data['messages'] = $this->message->get_messages_by_id($data['user_id']);
    $this->load->view('messages',$data);
    // if($data['user_login']){
    //   $this->load->view('messages',$data);
    // }else{

    // }
  }

}
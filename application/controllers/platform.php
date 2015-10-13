<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Platform extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
  }
  public function login(){
    $data['user_login'] = $this->session->userdata('user_login');
    $data['warning'] = '';
    $this->load->view('login',$data);
  }
  public function login_post(){
    // $data['account'] = $this->input->post('account');
    // $data['password'] = $this->input->post('password');
    $account = $this->input->post('account');
    $password = $this->input->post('password');

    $data['user'] = $this->user->get_user_by_acc_pss($account,$password);

    if($account && $password){
      if($data['user']){
        $this->session->set_userdata('user_login','YES',86500);
        $this->session->set_userdata('user_id',$user->id,86500);
      }else{
        $data['warning'] = 'error1';
      }

    }else{
      $data['warning'] = 'error2';
    }
    $data['user_login'] = $this->session->userdata('user_login');
    $this->load->view('login',$data);

  }


}
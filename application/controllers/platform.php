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
    $data['warning'] = '';
    if($account && $password){
      if($data['user']){
        $this->session->set_userdata('user_login','YES',86500);
        $this->session->set_userdata('user_id',$data['user']->id,86500);
        redirect('');
      }else{
        $data['warning'] = 'error1';
      }
    }else{
      $data['warning'] = 'error2';
    }
    $data['user_login'] = $this->session->userdata('user_login');
    $this->load->view('login',$data);
  }

  public function logout(){
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_login');
    $data['user_login'] = $this->session->userdata('user_login');
    $data['message'] = 'message2';
    redirect('');
    $this->load->view('welcome_message',$data);
  }
  public function register(){
    $data['warning'] = '';
    $this->load->view('register',$data);
  }
  public function register_post(){
    $data['name'] = $this->input->post('name');
    $data['account'] = $this->input->post('account');
    $data['password'] = $this->input->post('password');
    $repassword = $this->input->post('repassword');
    if($data['name'] && $data['account'] && $data['password'] && $repassword){
      if($data['password'] == $repassword){
        $this->user->register($data);
        redirect('platform/login');
      }else{
        $data['warning'] = 'error1';
      }
    }else{
      $data['warning'] = 'error2';
    }
  }

}
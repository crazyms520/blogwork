<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Platform extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
  }
  public function login(){
    $data['user_login'] = $this->session->userdata('user_login');
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
        $this->session->set_flashdata('message','登入成功');
        redirect('');
      }else{
        $this->session->set_flashdata('message','登入失敗，帳號密碼有誤');
        redirect('platform/login');
      }
    }else{
      $this->session->set_flashdata('message','資料填寫錯誤');
      redirect('platform/login');
    }
    // $data['user_login'] = $this->session->userdata('user_login');
    // $this->load->view('welcome_message',$data);

  }

  public function logout(){
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_login');
    $this->session->set_flashdata('message','登出成功');
    redirect('');
  }
  public function register(){
    $this->load->view('register');
  }
  public function register_post(){
    $data['name'] = $this->input->post('name');
    $data['account'] = $this->input->post('account');
    $data['password'] = $this->input->post('password');
    $repassword = $this->input->post('repassword');
    if($data['name'] && $data['account'] && $data['password'] && $repassword){
      if($data['password'] == $repassword){
        $this->user->register($data);
        $this->session->set_flashdata('message','註冊成功，快登入吧！');
        redirect('platform/login');
      }else{
        $this->session->set_flashdata('message','密碼確認有誤');
        redirect('platform/register');
      }
    }else{
      $this->session->set_flashdata('message','資料填寫有誤');
      redirect('platform/register');
    }

  }

}
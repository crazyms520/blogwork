<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
    $this->load->model('message');
    $this->load->model('friend');
  }
  public function index(){
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_login'] = $this->session->userdata('user_login');
    $user_id  = $this->session->userdata('user_id');
    $data['users'] = $this->user->all_users();
    foreach ($data['users'] as $user){
      $user->get_friend  = $this->friend->get_friend($user_id,$user->id);
    }
    // echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    // var_dump ($data['users']);
    // exit ();
    $this->load->view('user',$data);

  }
  public function insert_friends(){
    $friend_id = $this->input->get('friend_id');
    $user_id = $this->session->userdata('user_id');
    $this->friend->creat($user_id,$friend_id);
    redirect('users');
  }
  public function delete_friends(){
    $friend_id = $this->input->get('friend_id');
    $user_id = $this->session->userdata('user_id');
    $this->friend->delete($user_id,$friend_id);
    redirect('users');
  }
}
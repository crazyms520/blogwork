<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
    $this->load->model('message');
    $this->load->model('friend');
    $this->load->library('pagination');
  }
  public function index(){
    $keyword = $this->input->get('keyword');
    $per_page = $this->input->get('per_page');
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_login'] = $this->session->userdata('user_login');
    $user_id  = $this->session->userdata('user_id');
    // $data['users'] = $this->user->all_users();
    // $config['base_url'] = 'http://crazyms.com/blogwork/index.php/messages/index?';
    $config['base_url'] = "http://crazyms.com/blogwork/index.php/users/index?keyword=$keyword";
    if($keyword){
      $config['total_rows'] = $this->user->get_total_by_keyword($keyword);
    }else{
      if($user_id){
        $config['total_rows'] = $this->db->count_all_results('users')-1;
      }else{
        $config['total_rows'] = $this->db->count_all_results('users');
      }
    }
    $config['per_page'] = 3;
    $config['page_query_string'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    if($per_page){
        $offset = ($per_page-1) * $config['per_page'];
      }else{
        $offset = 0;
      }
    //此標籤是放在顯示分頁結果的左側。
    $config['full_tag_open'] = '<ul class="pagination">';
    //此標籤是放在顯示分頁結果的右側。
    $config['full_tag_close'] = '</ul>';

    //分頁左邊顯示"第一頁"的名稱
    $config['first_link'] = '第一頁';
    //第一頁連結左邊標籤。
    $config['first_tag_open'] = '<li>';
    //第一頁連結右邊標籤。
    $config['first_tag_close'] = '</li>';

    //分頁中顯示"上一頁"的名稱。
    $config['prev_link'] = '上一頁';
    //上一頁連結的左邊標籤。
    $config['prev_tag_open'] = '<li>';
    //上一頁連結的右邊標籤。
    $config['prev_tag_close'] = '</li>';

    //分頁中顯示"下一頁"的名稱。
    $config['next_link'] = '下一頁';
    //下一頁連結的左邊標籤。
    $config['next_tag_open'] = '<li>';
    //下一頁連結的右邊標籤。
    $config['next_tag_close'] = '</li>';

    //分頁右邊顯示"最後頁"的名稱。
    $config['last_link'] = '最後頁';
    //最後一頁連結左邊標籤。
    $config['last_tag_open'] = '<li>';
    //最後一頁連結右邊標籤。
    $config['last_tag_close'] = '</li>';

    //目前頁面左邊標籤。
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    //目前頁面右邊標籤。
    $config['cur_tag_close'] = '</li>';

    //分頁數字連結左邊標籤。
    $config['num_tag_open'] = '<li>';
    //分頁數字連結右邊標籤。
    $config['num_tag_close'] = '</li>';



    $this->pagination->initialize($config);
    $this->db->limit($config['per_page'],$offset);
    $data['pagination'] = $this->pagination->create_links();
    if($keyword){
      $data['users'] = $this->user->get_users_by_keyword($keyword);
    }else{
      $data['users'] = $this->user->all_users($user_id);
    }
    foreach ($data['users'] as $user){
      $user->get_friend  = $this->friend->get_friend($user_id,$user->id);
    }
    $data['keyword'] = $keyword;
    $this->load->view('user',$data);

  }
  public function insert_friends(){
    $friend_id = $this->input->get('friend_id');
    $user_id = $this->session->userdata('user_id');
    if($user_id){
      $this->friend->creat($user_id,$friend_id);
      $this->session->set_flashdata('message','新增好友成功');
      redirect('users');
    }else{
      $this->session->set_flashdata('_message','請先登入');
      redirect('users');
    }
  }
  public function delete_friends(){
    $friend_id = $this->input->get('friend_id');
    $user_id = $this->session->userdata('user_id');
    if($user_id){
      $this->friend->delete($user_id,$friend_id);
      $this->session->set_flashdata('message','刪除好友成功');
      redirect('users');
    }else{
      $this->session->set_flashdata('_message','請先登入');
      redirect('users');
    }
  }
}
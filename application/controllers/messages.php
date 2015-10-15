<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user');
    $this->load->model('message');
    date_default_timezone_set("Asia/Taipei");
  }
  public function index($offset = 0){
    $this->load->library('pagination');
    $per_page = $this->input->get('per_page');

    $config['base_url'] = 'http://crazyms.com/blogwork/index.php/messages/index?';
    $config['total_rows'] = $this->db->count_all_results('messages');
    $config['per_page'] = 3;
    $config['page_query_string'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    if($per_page){
        $offset = ($per_page-1) * $config['per_page'];
      }else{
        $offset = 0;
      }
    $this->pagination->initialize($config);
    $this->db->limit($config['per_page'],$offset);
    $data['pagination'] = $this->pagination->create_links();

    $data['messages'] = $this->message->get_all_messages();
    $data['user_login'] = $this->session->userdata('user_login');
    $data['user_id'] = $this->session->userdata('user_id');

    $this->load->view('messages',$data);
  }

  public function messages_post(){
    $content = $this->input->post('content');

    if(!$content){
      $this->session->set_flashdata('message','資料填寫有誤');
      redirect('messages');
    }

    $user_id = $this->session->userdata('user_id');
    $data = array(
      'user_id' => $user_id,
      'content' => $content,
      'created_at' => date('Y-m-d H:i:s')
      );
    $messages_id = $this->message->creat_message($data);
    if(!$messages_id){
      $this->session->set_flashdata('message','新增失敗');
      redirect('messages');
    }else{
      $this->session->set_flashdata('message','新增成功');
      redirect('messages');
    }
  }

}
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

    //此標籤是放在顯示分頁結果的左側。
    $config['full_tag_open'] = '<ul class="pagination">';
    //此標籤是放在顯示分頁結果的右側。
    $config['full_tag_close'] = '</ul>';

    // //分頁左邊顯示"第一頁"的名稱
    // $config['first_link'] = '第一頁';
    // //第一頁連結左邊標籤。
    // $confug['first_tag_open'] = '<li>';
    // //第一頁連結右邊標籤。
    // $config['first_tag_close'] = '</li>';

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

    // //分頁右邊顯示"最後頁"的名稱。
    // $config['last_link'] = '最後頁';
    // //最後一頁連結左邊標籤。
    // $config['last_tag_open'] = '<li>';
    // //最後一頁連結右邊標籤。
    // $config['last_tag_close'] = '</li>';

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
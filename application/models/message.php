<?php
  Class Message extends CI_Model{

    function __construct(){
      parent::__construct();
    }


    public function creat_message($data){
      $this->db->insert('messages',$data);
      //Query 輔助函數
      return $this->db->insert_id();
    }

    public function get_all_messages(){
      $this->db->select('*');
      $this->db->from('messages');
      $this->db->join('users','messages.user_id = users.id');
      $messages = $this->db->get()->result();
      return $messages;
    }

    public function get_messages_by_keyword($keyword,$per_page,$offset){
      return $this->db->select('*')
                      ->like('content',$keyword)
                      ->limit($per_page,$offset)
                      ->join('users','messages.user_id = users.id')
                      ->from('messages')
                      ->get()
                      ->result();
    }

    public function get_total_by_keyword($keyword){
      $this->db->like('content',$keyword)
               ->from('messages');
      return $this->db->count_all_results();
    }
  }
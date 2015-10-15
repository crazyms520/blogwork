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
  }
<?php
  Class Message extends CI_Model{

    function __construct(){
      parent::__construct();
    }

    public function get_messages_by_id($user_id){
      return $this->db->where('user_id',$user_id)
                      ->get('messages')
                      ->result();
    }

    public function creatd_message($data){
      $this->db->insert('messages',$data);
    }

  }
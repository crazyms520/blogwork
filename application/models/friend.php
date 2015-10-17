<?php
  Class Friend extends CI_Model{

    function __construct(){
      parent::__construct();
    }

    public function creat($user_id,$friend_id){
    $this->db->insert('friends',array(
      'user_id' => $user_id,
      'friend_id' => $friend_id
      ));
  }
    public function delete($user_id,$friend_id){
      $this->db->delete('friends',array(
      'user_id' => $user_id,
      'friend_id' => $friend_id
      ));

    }

    public function all_friends(){
      return $this->db->get('friends')
                      ->result();
    }
    public function get_friend($user_id,$friend_id){
     $users = $this->db->where('user_id',$user_id)
                       ->where('friend_id',$friend_id)
                       ->get('friends')
                       ->result();

      if(count($users) > 0 ){
        return true;
      }else{
        return false;
      }
    }
  }
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

    public function get_friends_by_keyword($user_id,$keyword){
      return $friends = $this->db->select('*')
                                 ->where('user_id',$user_id)
                                 ->like('name',$keyword)
                                 ->join('friends','friends.friend_id = users.id')
                                 ->from('users')
                                 ->get()
                                 ->result();
    }
    public function get_friends_by_keyword_total($user_id,$keyword){
      $friends = $this->db->select('*')
                          ->where('user_id',$user_id)
                          ->like('name',$keyword)
                          ->join('users','friends.friend_id = users.id')
                          ->from('friends');
      return $this->db->count_all_results();

    }
    public function get_all_friends($user_id){
        return $friends = $this->db->select('*')
                                 ->where('user_id',$user_id)
                                 ->join('friends','friends.friend_id = users.id')
                                 ->order_by ('friends.friend_id')
                                 ->from('users')
                                 ->get()
                                 ->result();
    }

    public function get_friends_total($user_id){
       $friends = $this->db->select('*')
                                 ->where('user_id',$user_id)
                                 ->join('friends','friends.friend_id = users.id')
                                 ->from('users');
      return $this->db->count_all_results();
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
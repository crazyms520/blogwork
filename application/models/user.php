<?php
  Class User extends CI_Model{

    function __construct(){
      parent::__construct();
    }

    public function get_user_by_id($user_id){
      $user = $this->db->where('id',$user_id)
                       ->get('users')
                       ->result();
      if(count($user) > 0){
        return $user[0];
      }else{
        return null;
      }
    }

    public function get_user_by_acc_pss($account,$password){
     $user = $this->db->where('account',$account)
                      ->where('password',$password)
                      ->get('users')
                      ->result();

      if(count($user) > 0 ){
        return $user[0];
      }else{
        return null;
      }
    }

    public function register($data){
      $this->db->insert('users',$data);
    }

    public function get_all_users(){
      return $this->db->select('*')
                      ->join('users','friends.friend_id = users.id')
                      ->from('friends')
                      ->get()
                      ->result();
    }

    public function all_users(){
      return $this->db->get('users')
                      ->result();
    }
  }
<?php
  Class User extends CI_Model{

    function __construct(){
      parent::__construct();
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

    }
  }
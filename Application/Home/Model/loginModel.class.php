<?php


namespace Home\Model;

  use Think\Model;

  class loginModel extends Model{
    public function login($data){  
        $username = $data['name'];  
        $password = md5($data['pw']);  
        $info = $this -> getByUsername($username);  
        if($info != null){  
            if($password === $info['pw']){  
                return $info;  
            }else{  
                return false;        
            }  
        }  
    }
}

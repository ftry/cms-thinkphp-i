<?php

namespace Home\Model;

  use Think\Model;

  class UserModel extends Model{

    /*--------------------------------------------------------
    protected $_validata = array(

        array('name', 'require' , '用户名必须'),
        array('repassword' , 'password' , '确认密码' , 0 , 'confirm'),
        //其他注册验证消息

        array('agree' , 'require' , '请同意规则' , 1),

       // array('area');
       // array('ttime');

    );

    protected $_auto = array(
       // array('password' , 3 , 'function'),//3->1

    );

    protected function is_agree(){

        $agree = I('post.agree' , 0 , 'intval');
        
            if($agree){
                return true;
            }else{
                return false;}
    }*/ //-----------------------------------------!!!!
     


    function checkNamePwd($name , $pw){

        $User = D('User');

        $info = $User -> getBy_name($name);

        if($info != null){
            if($info['pw'] == $pw){
                return $info;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


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

/*class loginModel extends Model{
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
    }*/  




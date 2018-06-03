<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
 

   //REGISTER
   public function register_boy(){
    if(IS_POST){
        $User = D('User');

        if(!$data = $User -> create()){
            header("Content-type: text/html ; charset = utf-8");
             
            exit($User -> getError());
        }

      
        if($id = $User -> add($Data)){

          
            
            $this -> success('注册成功', './login');
        }else{
            $this -> error('注册失败');
        }
    
    }else{
        $this -> display();
    }
    
   }

   public function register(){
    if(IS_POST){
        $User = D('User');

        if(!$data = $User -> create()){
            //header("Content-type: text/html ; charset = utf-8");
             
            exit($User -> getError());
        }

      
        if($id = $User -> add($Data)){

          
            
            $this -> success('注册成功', './login');
        }else{
            $this -> error('注册失败');
        }
    
    }else{
        $this -> display();
    }
 }

   


   //login--------------------------------------------------------------------
  public function login(){
    
            if(!empty($_POST)){
             
                    $user = new \Home\Model\UserModel();//此处调用的model里的方法要单独以xxxModel的方式。非常重要我的青娘！！！！！！！！！！！！！！！！
                    $user = D('user');
                    $rst = $user -> checkNamePwd($_POST['name'] , $_POST["pw"]);
    
                    if($rst === false){
                        echo '用户名或密码错误';
                    }else{
                        session("name" , $rst['name']);
                        session("id" , $rst['id']);
                        session("tel" , $rst['tel']);
                        $this -> redirect('Index/home_page',0);
                        //$this -> redirect('Index/shuo',0)
                    
                } 
            }else {$this -> display();}
 
    }//---------------------------------------------------------------
    //退出------------------------------
    public function userLogout()
    {
        session(null);
        //session_destroy();
        //unset($_SESSION);
        $this->redirect(U('Home/Index/index'));
    }
   //--------------------------------------
    //show
    public function show(){ 
        session_start();
        //uname == $_SESSION['name']; 
        //upwd==_SESSION['pw'];
        $id = SESSION('id');
           $user=M('user');
           $select=$user->query("select * from think_user where name='$name' and tel");
        
           $this->assign('info',$select);
           $this->display();      
           
        }



    //user
    public function user_center(){

    }

    //校园动态：新闻发布/
    public function news()
    {
       
           
            
    }
    //Admin登录
    public function adlogin(){
        if(!empty($_POST)){

            $user = new \Home\Model\UserModel();//此处调用的model里的方法要单独以xxxModel的方式。非常重要我的青娘！！！！！！！！！！！！！！！！
            $user = D('user');
            $rst = $user -> checkNamePwd($_POST['name'] , $_POST["pw"]);

            if($rst === false){
                echo '用户名或密码错误';
            }else{
                session("name" , $rst['name']);
                session("id" , $rst['id']);
                session("tel" , $rst['tel']);
                $this -> redirect('Index/apul',0);
                //$this -> redirect('Index/shuo',0)

            }
        }else {$this -> display();}
    }
    
    //文章发表
    public function pul(){
        if(IS_POST) {
        $imgname = $_FILES['img']['name'];
        $tmp1 = $_FILES['img']['tmp_name'];
        //echo "$tmp1";
        $filepath1 = './Public/img/inst/';
        if(move_uploaded_file($tmp1,$filepath1.$imgname)){
                echo "good";
            //$imgp = './upload/'.$imgname;

            //echo ' <img src="'.$imgp.'" style="float:left;width:100%;"/> ';

        }else{
            echo "上传失败，请重试";
            $_FILES['img']['error'];
        }

        $smname = $_FILES['sm']['name'];
        $tmp = $_FILES['sm']['tmp_name'];
        $filepath = './Public/word/';
        if(move_uploaded_file($tmp,$filepath.$smname)){
                echo "GOOD";
            //$imgp = './upload/'.$imgname;

            //echo ' <img src="'.$imgp.'" style="float:left;width:100%;"/> ';

        }else{
            echo "上传失败，请重试";
            $_FILES['sm']['error'];
        }


            $data['name'] = I('post.word');
            $data['path'] = $smname;
            $data['pic'] = $imgname;

            if (M('inst')->add($data)) {
                $data = null;
                $this->success('发布成功!');
            } else {
                $data = null;

                $this->error('抱歉，发布失败！');
            }
        }else{
            $this ->display();
        }

   }

   //视频
    public function pulv(){
        if(IS_POST) {
            $imgname = $_FILES['path']['name'];
            $tmp1 = $_FILES['path']['tmp_name'];
            //echo "$tmp1";
            $filepath1 = './Public/video/v/';
            if(move_uploaded_file($tmp1,$filepath1.$imgname)){
                echo "good";
                //$imgp = './upload/'.$imgname;

                //echo ' <img src="'.$imgp.'" style="float:left;width:100%;"/> ';

            }else{
                echo "上传失败，请重试";
               echo $_FILES['img']['error'];
            }

            $smname = $_FILES['sm']['name'];
            $tmp = $_FILES['sm']['tmp_name'];
            $filepath = './Public/video/s/';
            if(move_uploaded_file($tmp,$filepath.$smname)){
                echo "GOOD";
                //$imgp = './upload/'.$imgname;

                //echo ' <img src="'.$imgp.'" style="float:left;width:100%;"/> ';

            }else{
                echo "上传失败，请重试";
                echo $_FILES['sm']['error'];
            }


            $data['name'] = I('post.word');
            $data['path'] = $smname;
            $data['pic'] = $imgname;

            if (M('videos')->add($data)) {
                $data = null;
                $this->success('发布成功!');
            } else {
                $data = null;

                $this->error('抱歉，发布失败！');
            }
        }else{
            $this ->display();
        }

    }

    //方式二
    public function publish()
    {
        if(IS_POST){
            //if (IS_POST && isset($_POST['artsubmit'])){
            //$task = M('task');

            //$data['name'] = session('id');
            $data['name'] = I('post.time');
            $data['path'] = I('post.class');
            $data['pic'] = I('post.room');
            //$data['demand'] = I('post.demand');

            if(M('') -> add($data)){
                $data = null;
                $this -> success('发布成功!','./work');
            }else{
                $data = null;

                $this -> error('抱歉，发布失败！');

            }
        }else{

            $this -> display();

        }

    }
    //仪器查看
    public function read()
    {
        $Tags = M('inst');

   
        $list = $Tags -> limit(100) -> select();
        
        $this -> assign('list' , $list);
        
        


        $this -> display();
    }

    public function words()
    {
        

        $Tags = M('inst');
        $id = I('get.id');//一个非常重要的部分：用于读取由模板view传来的参数------------------++++++++++------------
       
     


        $data = $Tags -> find($id);
        if($data) {
            $this->assign('data',$data);// 模板变量赋值
            }else{
            $this->error('数据错误');
            }



        $this -> display();

    }

    public function testword(){

       $inst = M('inst');
       $id = I('get.id');
       $data = $inst -> find($id);
       //print_r($data[pic]);//检测数组
        if($data) {
            $this->assign('data',$data);// 模板变量赋值
        }else{
            $this->error('数据错误');
        }

        $ww = $data[path];
        //$w = file_get_contents("C:/phpStudy_2016.11.03/WWW/PLadmin/Public/word/$ww");
        //文本一定要以utf-8码保存。
		//$w = file("D:/aspproject/aixunxi/Public/word/$ww");
		$w = file_get_contents("D:/aspproject/wamp/www/aixunxi/Public/word/$ww");
		//echo $w;
        $this -> assign( 'w',$w);
       

        $this -> display();
    }


    //视频播放
    public function video()
    {
        # code...
        $Video = M('Videos');

        $list = $Video -> limit(100) -> select();
        
        $this -> assign('list' , $list);

        $this -> display();


        
    }


    
    //交易----------------
    //发布
    public function deal()
    {
        if(IS_POST){
        //if (IS_POST && isset($_POST['artsubmit'])){
        //$task = M('task');

        $data['uid'] = session('id');
        $data['time'] = I('post.time');
        $data['class'] = I('post.class');
        $data['room'] = I('post.room');
        $data['demand'] = I('post.demand');

        if(M('task') -> add($data)){
            $data = null;
            $this -> success('发布成功!','./work');
        }else{
            $data = null;

            $this -> error('抱歉，发布失败！');

        }
        }else{
            
            $this -> display();

        }
 
        

        
      


    }

    //任务列表

    public function work()
    {
        $task = M('task');

        $list = $task -> limit(100) -> select();
        
        $this -> assign('list' , $list);

        $this -> display();
    }


    //接受任务
    public function take()
    {
        $tid = M('tid');
        //$uid = I('get.uid')
        //if(IS_POST){

            
            
    
            $data['jid'] = session('id');//记录接任务的人
            $data['uid'] = I('get.id');//记录发布任务的人
            $data['time'] = I('get.t');
            $data['class'] = I('get.c');
            $data['room'] = I('get.r');
            $data['demand'] = I('get.d');

            //$data = $Model -> table('think_task') -> where('id='.I('get.id2')) -> field('time,class,room,demand') -> select();
            //$Model = new \Think\Model();//**********很关键的一步，实现model的实例化。********
            //$data = $Model ->field('time,class,room,demand') -> table('think_task task') -> where('id=13') -> select();
    
            if(M('tid') -> add($data)){
                $data = null;
                $this -> success('接单成功!','./myt');
            }else{
                $data = null;
    
                $this -> error('抱歉，接单失败！');
    
            }//-------------写入操作

            $task = M('task');
            $id = I('get.id2');
            //echo $id;
            $task->where('id='.$id)->delete();//用点来连接变量
            //$task -> delete('$id');

            //$this -> display();
            /*}
            else{
                
                $this -> display();
    
            }*/

    }



    //任务处理
    public function ret()
    {
        $tid = M('tid');
       
        $list = $tid->getField('uid',true);


       
           foreach($list as $val){//循环list数组

           
           //如果有相同的id则输出 已接受
           if($val == session('id')){
            //$a = strtoupper($val['jid']);
            echo  "已接受";
            $uid = $val;
            $this -> assign('uid',$uid);
            $this -> display();
           
            break;//找到跳出第一循环
            
           }
           
        } 
        //echo "未接受";
        $task = M('task');
        $list = $task -> getField('uid',true);

        foreach($list as $val){

            if($val == session('id')){
                echo "未接受";
                $uid = $val;
                $this -> assign('uid',$uid);
                $this -> display();
            }
        }

        
    }

    //任务处理反馈
    public function inform()
    {
        $fk = M('fk');
        
       
    }

    //接单处理
    public function myt()
    {
        $tid = M('tid');
        $list = $tid -> where('jid='.session('id')) -> select();
        
        $this -> assign('list' , $list);

        $this -> display();

        
    }

    public function finish()
    {
        $tid = M('tid');
        $id = I('get.id');
        $tid->where('id='.$id)->delete();
    }











    //发邮件
   
     public function send(){
        if(sendMail('vsiryxm@qq.com','你好!邮件标题','这是一篇测试邮件正文！')){
                  echo '发送成功！';
            } else{
                   echo '发送失败！';
                  }
        }
         

    //上传图片
    public function upimg()
    {
       



                if(IS_POST){
                    $config = array(
                        'maxSize'    =>    3145728,
                        'rootPath'   =>    './Uploads/',
                        'savePath'   =>    '',
                        'saveName'   =>    array('uniqid', mt_rand(1,999999).'_'.md5(uniqid())),
                        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                        'autoSub'    =>    true,
                        'subName'    =>    array('date','Ymd'),
                    );
                    $upload = new \Think\Upload($config);// 实例化上传类
                    $info   =   $upload->upload();
                    if(!$info) {
                        $this->error($upload->getError());
                    }else{
                        foreach($info as $file){
                            
                            $this -> success('上传成功!');

                            //$image -> open($file['savepath'].$file['savename']);
                           // echo $file['savepath'].$file['savename'];
                           //$_path1 = C('ROOT_PATH').'/Uploads/'.$file['savepath'].$file['savename'];
                           //$_path =  __ROOT__.'/Uploads/'.$file['savepath'].$file['savename'];
                        }
                    }
                    
                }
                
                $img = M('img');
                $data['img'] = $file['savepath'].$file['savename'];
                //$data['tc'] = session('id');
                $data['tc'] = 1;
                $img -> add($data);

                $list = $img -> limit(100) -> select();
                
                $this -> assign('list' , $list);
        
                $this -> display();

    }
    
	//下载
	public function download(){
		$this -> display();
	}

}
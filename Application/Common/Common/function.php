<?php

  /* 功能：邮件发送函数
 3  * @param string $to 目标邮箱
 4  * @param string $subject 邮件主题（标题）
 5  * @param string $to 邮件内容
 6  * @return bool true
 7  */
   function sendMail($to, $subject, $content) {
     vendor('PHPMailer.class#smtp');
    vendor('PHPMailer.class#phpmailer');    //注意这里的大小写哦，不然会出现找不到类，PHPMailer是文件夹名字，class#phpmailer就代表class.phpmailer.php文件名
    $mail = new PHPMailer();
   // 装配邮件服务器
    if (C('MAIL_SMTP')) {
         $mail->IsSMTP();
     }
    $mail->Host = C('MAIL_HOST');  //这里的参数解释见下面的配置信息注释
     $mail->SMTPAuth = C('MAIL_SMTPAUTH'); 
    $mail->Username = C('MAIL_USERNAME');
     $mail->Password = C('MAIL_PASSWORD');
     $mail->SMTPSecure = C('MAIL_SECURE');
     $mail->CharSet = C('MAIL_CHARSET');
    // 装配邮件头信息
     $mail->From = C('MAIL_USERNAME');
     $mail->AddAddress($to);
     $mail->FromName = C('MAIL_FROMNAME');
     $mail->IsHTML(C('MAIL_ISHTML'));
     // 装配邮件正文信息
     $mail->Subject = $subject;
     $mail->Body = $content;
     // 发送邮件
     if (!$mail->Send()) {
         return FALSE;
     } else {
         return TRUE;
     }
  }
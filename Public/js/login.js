(function () {
	

	'use strict';

	// Placeholder 
	var placeholderFunction = function() {
		$('input, textarea').placeholder({ customClass: 'my-placeholder' });
	}
	
	// Placeholder 
	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};
	// On load
	$(function(){
		placeholderFunction();
		contentWayPoint();

	});


//注册时头像的响应式移动
	window.onload=function(){ 
		
		var wid_form_group = $(".form-group").width();
		if(wid_form_group >= 627){
			$(".form-group .head-img").css({"margin-left":wid_form_group/3+30});
		}else if(wid_form_group < 627 && wid_form_group >=372) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/3+10});
		}else if(wid_form_group < 372 && wid_form_group >=267) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/4+10});
		}else if(wid_form_group < 267 && wid_form_group >=261) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/4});
		}else if(wid_form_group <261) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/6+20});
		}
		if(wid_form_group <230) {
			$(".form-group .head-img").css({"display":none});
		}else{
			$(".form-group .head-img").css({"display":"block"});
		}
		// alert(wid_form_group);
	} 


	window.onresize = function(){
		
		var wid_form_group = $(".form-group").width();
		if(wid_form_group >= 627){
			$(".form-group .head-img").css({"margin-left":wid_form_group/3+30});
		}else if(wid_form_group < 627 && wid_form_group >=372) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/3+10});
		}else if(wid_form_group < 372 && wid_form_group >=267) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/4+10});
		}else if(wid_form_group < 267 && wid_form_group >=261) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/4});
		}else if(wid_form_group <261) {
			$(".form-group .head-img").css({"margin-left":wid_form_group/6+20});
		}
		if(wid_form_group <230) {
			$(".form-group img").css({"display":"none"});
		}else{
			$(".form-group img").css({"display":"block"});
		}
	}
	//只显示一个头像
	$(".form-group #imgor").parent().css({"display":"block"});
	$(".form-group #imgshow").parent().css({"display":"none"});
	//展示上传的头像
		//在input file内容改变的时候触发事件
		$('#filed').change(function(){
		//获取input file的files文件数组;
		//$('#filed')获取的是jQuery对象，.get(0)转为原生对象;
		//这边默认只能选一个，但是存放形式仍然是数组，所以取第一个元素使用[0];
		var file = $('#filed').get(0).files[0];
		//创建用来读取此文件的对象
		var reader = new FileReader();
		//使用该对象读取file文件
		reader.readAsDataURL(file);
		//读取文件成功后执行的方法函数
		reader.onload=function(e){
		//读取成功后返回的一个参数e，整个的一个进度事件
			console.log(e);
		//选择所要显示图片的img，要赋值给img的src就是e中target下result里面
		//的base64编码格式的地址
			$('#imgshow').get(0).src = e.target.result;
		}
		$(".form-group #imgor").parent().css({"display":"none"});
		$(".form-group #imgshow").parent().css({"display":"block"});
		})
		        
		
		
		$(".form-group #name").blur(function(){  
			//获取id对应的元素的值，去掉其左右的空格  
			var name = $.trim($('.form-group #name').val());  
			//验证格式的js正则表达式  
			var isName = /^[a-zA-Z0-9_]{3,16}$/  ;  
			//清空显示层中的数据      
			$("#NameMess").html("");  
			if(name == ""){  
				$("#NameMess").html("<font color='red'>"+"姓名不能为空"+"</font>");  
			}  
			else if(!(isName.test(name))){  
				$("#NameMess").html("<font color='red'>"+"姓名至少三位数字或字符"+"</font>");  
			}  
			else{  
					var username = $(this).val();	//h获取用户输入的用户名
					$.ajax({
						type: "post",
						url: "check.php",
						data: {"username": username},	//参数
						success: function(msg) {	//服务器响应成功之后调用的回调函数
							if(msg == 1) {

							}else {
								$("#NameMess").html("<font color='red'>"+"用户名已存在"+"</font>");
							}
						}

					});
						//此处可以操作向后台发送json数据，然后返回验证结果  
				}
		});  
		
		$(".form-group #password").blur(function(){  
			//获取id对应的元素的值，去掉其左右的空格  
			var password = $.trim($('.form-group #password').val());  
			//验证格式的js正则表达式  
			var isPassword = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,21}$/;  
			//清空显示层中的数据      
			$("#PasswordMess").html("");  
			if(password == ""){  
				$("#PasswordMess").html("<font color='red'>"+"密码不能为空"+"</font>");  
			}  
			else if(!(isPassword.test(password))){  
				$("#PasswordMess").html("<font color='red'>"+"密码由6-21字母和数字组成"+"</font>");  
			}  
			else{  
						//此处可以操作向后台发送json数据，然后返回验证结果  
				}
		});  
		//两次输入的密码要一致
		$(".form-group #re-password").blur(function(){  
			var str = $('.form-group #password').val();    
			var str1 = $('.form-group #re-password').val();
			$("#Re-passwordMess").html("");
			if(str!=str1){
				$("#Re-passwordMess").html("<font color='red'>"+"两次输入不一致"+"</font>");
			}
		});

		// function myCheck(){
        // 	for(var i=0;i<document.form1.elements.length-1;i++)
        // 	{
        //  		if(document.form1.elements[i].value=="")
        // 		{
        //    			alert("当前表单不能有空项");
        //    			document.form1.elements[i].focus();
        //    			return false;
        //  		}
        // 	}
        // 	return true;
        
      //}
	

}());
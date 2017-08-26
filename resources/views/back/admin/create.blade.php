@extends('back.layout.common')
@section('title')添加管理员@endsection
@section('content')
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" action="{{url('admin/admin')}}" method="post">
  {{ csrf_field() }}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录账号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{ old('username') }}" placeholder="登录账号" id="username" name="username">
		</div>
	</div>
  <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="adminRole" size="1">
				<option value="0">超级管理员</option>
				<option value="1">总编</option>
				<option value="2">栏目主辑</option>
				<option value="3">栏目编辑</option>
			</select>
			</span> </div>
	</div>
  <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>昵称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{ old('nickname') }}" placeholder="昵称" id="nickname" name="nickname">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="登录密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认登录密码" id="password2" name="password2">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="sex" type="radio" id="sex-1" checked value="1">
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="sex" value="1">
				<label for="sex-2">女</label>
			</div>
      <div class="radio-box">
				<input type="radio" id="sex-3" name="sex" value="3">
				<label for="sex-3">保密</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{old('mobile')}}" placeholder="手机号" id="mobile" name="mobile">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="email" id="email" value="{{old('email')}}">
		</div>
	</div>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">状态：</label>
    <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
      <select class="select" name="disabled_at" size="1">
        <option value="0">启用</option>
        <option value="1">禁用</option>
      </select>
      </span> </div>
  </div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" id="btnSub">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script src="{{asset('back')}}/lib/layer/2.1/layer.js"></script>
<script src="{{asset('back')}}/lib/icheck/jquery.icheck.min.js"></script>
<script src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.min.js">
</script>
<script src="{{asset('back')}}/lib/jquery.validation/1.14.0/validate-methods.js">
</script>
<script src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js">
</script>
<script src="{{asset('back')}}/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script src="{{asset('back')}}/lib/jquery.form.js"></script>
<script>
  $('#btnSub').click(function(){
    $("#form-admin-add").validate({
  		rules:{
  			username:{
  				required:true,
  				minlength:4,
  				maxlength:16
  			},
        nickname:{
          required:true,
          minlength:2,
          maxlength:16
        },
  			password:{
  				required:true,
  			},
  			password2:{
  				required:true,
  				equalTo: "#password" //判断是否制定ID元素的value值
  			},
  			sex:{
  				required:true,
  			},
  			mobile:{
  				required:true,
  				isPhone:true,
  			},
  			email:{
  				required:true,
  				email:true,
  			},
  			disabled_at:{
  				required:true,
  			},
  		},
  		onkeyup:false,
  		focusCleanup:true,
  		success:"valid",
  		submitHandler:function(form){
        //可以直接调用jQueryform插件
  			$(form).ajaxSubmit(function(msg){
          // console.log(msg);
					//判断如果验证结果是false,返回错误信息
					if ( !msg.status ) {
						var error = "";
						for( attr in msg.errormessage ){ //for in 用来循环对象
							error += msg.errormessage[attr][0] + '<br/>';
						}
						layer.alert(error,{icon:5,time:3000});
					}else{
						layer.alert('添加成功!',{icon:1,time:3000},function(){
							//下面三行代码是关闭当前弹出层
							var index = parent.layer.getFrameIndex(window.name);
							parent.$('.btn-refresh').click();
							parent.layer.close(index);
						})
					}
        });
  		}
  	});
  });
</script>

@endsection

@extends('back.layout.common')
@section('title')添加角色@endsection
@section('content')
<style>
.permission-list > dd > dl > dd {
  margin-left: 0px;
}
.permission-list2 label:nth-child(5n+5):after{
	content: "";
	display: block;
}
</style>
<body>
<article class="page-container">
	<form action="{{ url('admin/role') }}" method="post" class="form form-horizontal" id="form-admin-role-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="role_name" name="role_name" datatype="*4-16" nullmsg="角色名称不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">角色描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder=" 请填写角色的描述信息" id="" name="note">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">权限列表：</label>
			<div class="formControls col-xs-8 col-sm-9">
        @foreach($topAuth as $top)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="{{ $top->id }}" name="role_auth_ids[]" id="user-Character-0">
							{{$top->auth_name}}</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dd>
                @foreach($sonAuth as $son)
                @if($son->auth_pid==$top->id)
								<label class="">
									<input type="checkbox" value="{{$son->id}}" name="role_auth_ids[]" id="user-Character-0-0-0">
									{{$son->auth_name}}
                </label>
                @endif
                @endforeach
							</dd>
						</dl>
					</dd>
				</dl>
        @endforeach
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
<script src="{{ asset('back') }}/lib/jquery.form.js"></script>
<!--请在下方写此页面业务相关的脚本-->
<script>
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});

	$("#form-admin-role-add").validate({
		rules:{
			role_name:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			// 我们可以直接在这里调用jQueryFrom插件的 ajaxSubmit
			$(form).ajaxSubmit(function(msg){
				if(!msg.status){ // 判断如果验证结果是false，则显示错误信息
					var error = '';
					for( attr in msg.errormessage ){ // for-in 专门用来循环对象的
						error += msg.errormessage[attr][0] + '<br>';
					}
					layer.alert(error,{icon:5,time:3000});
				}else{
					layer.msg('添加成功！',{icon:1,time:3000},function(){
						// 下面三句代码就是关闭当前弹出层
						var index = parent.layer.getFrameIndex(window.name);
						parent.$('.btn-refresh').click();
						parent.layer.close(index);
					});
				}
			});
		}
	});

});
</script>
@endsection

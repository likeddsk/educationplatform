@extends('back.layout.common')
@section('title')角色列表@endsection
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 角色管理 <span class="c-gray en">&gt;</span> 角色列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入角色名称" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="role_add('添加角色','{{ url('admin/role/create') }}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg datatables">
		<thead>
			<tr>
				<th scope="col" colspan="9">角色列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="30">ID</th>
				<th width="30">角色名称</th>
				<th width="80">角色描述</th>
				<th width="30">角色权限ID</th>
				<th width="50">角色的权限列表</th>
				<th width="70">添加时间</th>
				<th width="70">修改时间</th>
				<th width="30">操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script src="{{asset('back')}}/lib/layer/2.1/layer.js"></script>
<script src="{{asset('back')}}/lib/laypage/1.2/laypage.js"></script>
<!-- datatables插件 -->
<script src="{{asset('back')}}/lib/datatables/1.10.0/jquery.dataTables.min.js">
</script>
<script src="{{asset('back')}}/lib/My97DatePicker/WdatePicker.js"></script>
<script src="{{asset('back')}}/static/h-ui.admin/js/H-ui.admin.js"></script>
<script>
/**
 * 配置datatables插件
 */
$('.datatables').DataTable({
	// 配置下拉框显示的数据量
	"lengthMenu": [ [5, 10, 20, 40, -1],[5, 10, 20, 40,'全部'] ], // -1表示全部
	"paging": true, // 是否显示分页
	"info": true, // 是否显示分页辅助信息
	"searching": true, // 是否启用搜索框
	"ordering": true, // 是否启用排序功能
	"order": [[ 1, "asc" ]], // 设置默认排序的字段列，从左往右下标从0开始
	"columnDefs": [{  // 设置不启用排序功能的字段列
	     "targets": [0,2,3,4,-1],  // -1 表示从右算起第一列
	     "orderable": false
	}],
	"stateSave": true,  // 是否在刷新页面以后还要记录排序的状态
	"serverSide": true, //开启提交请求给服务器的功能
	"ajax":{ //ajax请求,datatables自动帮我们发起请求
		"url":"{{ url('admin/role/ajax') }}", //请求地址,如果是get就不需要csrf_token
		"type":"POST", //请求方法
		"headers":{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, //附带参数,这段代码是固定的
	},
	"columns":[ //使用columns 接受服务器返回数据
		//{'data':'字段名','defaultContent':'默认值','className':'如果有外观样式要求,写上css类名'}
		{'data':'a',"defaultContent":""}, //一个字段对应一个json值
		{'data':'id',"defaultContent":""},
		{'data':'role_name',"defaultContent":""},
		{'data':'note',"defaultContent":""},
		{'data':'role_auth_ids',"defaultContent":""},
		{'data':'role_auth_ac',"defaultContent":""},
		{'data':'created_at',"defaultContent":""},
		{'data':'updated_at',"defaultContent":""},
		{'data':'id',"defaultContent":"",'calssName':'td-manage'},
	],
	"createdRow":function(row,data,dataIndex){
		$(row).children().css('text-align','center');
		//row当前行的tr标签
		//data当前行的data标签
		//dataIndex当前行的data数据的下标
		$(row).children().eq(0).html('<input type="checkbox" value="'+data.id+'" name="del[]">');

		$(row).children().eq(-1).html('<a title="编辑" href="javascript:;" onclick="role_edit(\'角色编辑\',\'/admin/role/'+data.id+'/edit\',\'1\',\'800\',\'500\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="role_del(this,\''+data.id+'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
	}
});

/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*角色-增加*/
function role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*角色-删除*/
function role_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		data = {
      '_token': '{{ csrf_token() }}',
      '_method': 'delete',
    };
    $.post('/admin/role/'+id,data,function(msg){
      if( msg.status ){
        $(obj).parents("tr").remove();
        layer.msg('已删除!',{icon:1,time:3000});
      }else{
        layer.msg('删除失败!',{icon:5,time:3000});
      }
    });
	});
}
/*角色-编辑*/
function role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

</script>
@endsection

@extends('back.layout.common')
@section('content')
<link href="{{ asset('back') }}/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" />
<script src="{{ asset('back' )}}\lib\layer\2.1\layer.js"></script>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="{{ url('admin/login') }}" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          {{ csrf_field() }}
          <input id="" name="username" value="{{ old('username') }}" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" name="verify" type="text" placeholder="验证码" style="width:150px;">
          <img class="captcha" src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}' + Math.random()" > <a onclick="$('.captcha').attr('src','{{ captcha_src() }}'+Math.random())" id="kanbuq" href="javascript:;">看不清，换一张</a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="1">
            保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin.v2.5</div>
<script>
  @if ( $errors->count() )
      layer.alert('{{ $errors->first() }}',{icon:5});
  @endif
</script>
@endsection

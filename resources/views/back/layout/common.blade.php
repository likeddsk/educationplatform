<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" href="{{ asset('back') }}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="{{ asset('back') }}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="{{ asset('back') }}/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" href="{{ asset('back') }}/lib/icheck/icheck.css" />
<link rel="stylesheet" href="{{ asset('back') }}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="{{ asset('back') }}/static/h-ui.admin/css/style.css" />
<title>@yield('title')</title>
</head>
<body>
<script src="{{ asset('back') }}/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('back') }}/static/h-ui/js/H-ui.js"></script>
@yield('content')
</body>
</html>

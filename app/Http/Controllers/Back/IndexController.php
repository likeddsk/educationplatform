<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //后台首页
    public function index(){
      return view('back.index.index');
    }
    //欢迎页面
    public function welcome(){
      return view('back.index.welcome');
    }
    //后台登陆
    public function login( Request $request ){
      //判断是否有post数据
      if ( $request->isMethod('post') ) {
        //接受post数据,only()接受指定数据
        $data = $request->only('username','password','verify');
        //验证接受的数据,验证规则
        $role = [
          'username' => 'required',
          'password' => 'required',
          'verify'   => 'required|captcha'
        ];
        $message = [
          'username.required' => '账号不能为空!',
          'password.required' => '密码不能为空!',
          'verify.required'   => '验证码不能为空!',
          'verify.captcha'    => '验证码错误!',
        ];
        $validator = Validator::make( $data,$role,$message );
        //判断验证是否失败
        if ( $validator->fails() ) {  //如果验证失败
          $request->flash();  //把提交过来的数据保存到一次性session中
          return redirect()->back()  //返回上一页
                           ->withErrors( $validator ); //返回错误信息
        }
        // 判断用户账户和密码是否正确
        $res1 = Auth::guard('admin')->attempt(['username'=>$data['username'],'password'=>$data['password']]);
        $res2 = Auth::guard('admin')->attempt(['email'=>$data['username'],'password'=>$data['password']]);
        $res3 = Auth::guard('admin')->attempt(['mobile'=>$data['username'],'password'=>$data['password']]);

        if ($res1||$res2||$res3) {
          //登陆成功
          //attempt()已经帮我们记录了登陆状态
          return redirect()->to('/admin/index');
        }else{
          //登陆失败
          //把提交过来的数据保存在一次性session中
          $request->flash();
          //返回上一页并输出错误信息
          return redirect()->back()->withErrors('用户名或密码错误');
        }
      }
      return view('back.index.login');
    }
    //后台退出
    public function logout(){
      //使用Auth授权类进行管理员退出
      Auth::guard('admin')->logout();
      //退出后跳转登录页
      return redirect()->to('admin/login');
    }
}

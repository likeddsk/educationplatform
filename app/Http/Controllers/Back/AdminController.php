<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  /**
   * 显示管理员列表   通过get请求
   *
   * @return \Illuminate\Http\Response
   */
  public function index( Admin $admin )
  {
    // $data['adminList'] = $admin->get();
    // dump($data['adminList']);
    // return view('back.admin.index',$data);
    return view('back.admin.index');
  }

  /**
   * 显示添加管理员的表单   通过get请求
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('back.admin.create');
  }

  /**
   * 保存由create表单提交的数据[提交数据、保存数据]   通过post请求
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //判断是否有ajax请求
    if( $request->ajax() ){
      //接受前台数据
      $data = $request->only('username','nickname','password','password2',
      'sex','mobile','email','disabled_at');
      //验证规则
      $role = [
        'username' => 'required|unique:admin',
        'password' => 'required|between:6,16|same:password2',
        'sex'      => 'numeric',
        'mobile'   => 'regex:/\d{11}/',
        'email'    => 'email',
      ];
      //错误返回数据
      $message = [
        'username.required'     => '账号不能为空',
        'username.unique:admin' => '账号已存在',
        'password.required'     => '密码不能为空',
        'password.between'      => '密码必须6至16位',
        'password.same'         => '两次密码不一致',
        'mobile.regex'          => '手机号不正确',
        'email.email'           => '邮箱不正确',
      ];
      //验证
      $validator = Validator::make($data,$role,$message);
      //验证不通过
      if ( $validator->fails() ) {
        //验证错误返回错误信息
        return [
          'status'       => false,
          'errormessage' => $validator->messages(),
        ];
      }
    }
  }

  /**
   * 显示一条数据   通过get请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * 显示编辑管理员的表单   通过get请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * 接受保存由edit表单提交过来的数据[接收数据、保存编辑数据]   通过put请求
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * 移除指定ID的一条/多条数据   http的delete请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
  /**
   * datatable的Ajax获取列表数据
   */
  public function ajaxGetList( Request $request,Admin $admin ){
    if ( $request->ajax() ){  //判断有没有ajax请求,有的话返回true
      //返回数据有两种方法,一种一次性返回所有数据,另一种就是一次性返回一页数据
      //1.返回所有数据给datatables
      /*
      $data = $admin->get(); //获取数据
      $cnt = count($data); //获取返回数据的总数
      $info = [
        'draw' => $request->get('draw'), //datatables通过ajax请求服务器次数
        'recordsTotal' => $cnt, //返回数据的总数
        'recordsFiltered' => $cnt, //返回数据的数量[没做筛选,所以和上面一样]
        'data' => $data,
      ];
      return $info; //默认,laravel使用return ,返回的数据会自动转成json
      */

      //2.返回分页页码对应的数据
      $length = $request->input('length'); //回去一页的数据量
      $start  = $request->input('start'); //查询开始的下标
      $column = $request->input('columns');
      $order  = $request->input('order');
      //$order[0]['column'] //排序的字段下表
      $order_field = $column[ $order[0]['column'] ]['data'];
      $order_status= $order[0]['dir'];
      $data = $admin->orderby($order_field,$order_status)->offset($start)
                    ->limit($length)->get(); //获取数据
      $cnt = $admin->count(); //获取返回数据的总数
      $info = [
        'draw' => $request->get('draw'), //datatables通过ajax请求服务器次数
        'recordsTotal' => $cnt, //返回数据的总数
        'recordsFiltered' => $cnt, //返回数据的数量[没做筛选,所以和上面一样]
        'data' => $data,
      ];
      return $info; //默认,laravel使用return ,返回的数据会自动转成json
    }
  }
}

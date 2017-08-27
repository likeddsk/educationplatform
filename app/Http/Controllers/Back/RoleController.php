<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * 显示角色列表   通过get请求
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('back.role.index');
    }

    /**
     * 显示添加角色表单   通过get请求
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('back.role.create');
    }

    /**
     * 保存create提交的数据   通过post请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Role $roleModel)
    {
      if ( $request->ajax() ) {
        $data = $request->only('role_name','note');
        // dump($data);
        //验证数据
        $role = [
          'role_name' => 'required|unique:role',
        ];
        $message = [
          'role_name.required'  =>  '角色名不能为空!',
          'role_name.unique'    =>  '角色名已存在!',
        ];
        $validator = Validator::make($data,$role,$message);
        //验证结果
        if ( $validator->fails() ) {
          return [
            'status'        => false,
            'errormessage'  => $validator->message(), //返回所有的错误信息
          ];
        }
        //验证成功,保存数据
        //create添加成功以后返回一条数据,否则返回false;
        $res = $roleModel->create($data);
        if ($res) {
          return['status'  =>  true];
        }else {
          return[
            'status'        => false,
            'errormessage'  => ['添加失败!'] //返回所有的错误信息
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
     * 显示编辑角色的表单   通过get请求
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


    public function ajaxGetList( Request $request,Role $role ){
      if ( $request->ajax() ){  //判断有没有ajax请求,有的话返回true
        $length = $request->input('length'); //回去一页的数据量
        $start  = $request->input('start'); //查询开始的下标
        $column = $request->input('columns');
        $order  = $request->input('order');
        //$order[0]['column'] //排序的字段下表
        $order_field = $column[ $order[0]['column'] ]['data'];
        $order_status= $order[0]['dir'];
        $data = $role->orderby($order_field,$order_status)->offset($start)
                      ->limit($length)->get(); //获取数据
        $cnt = $role->count(); //获取返回数据的总数
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

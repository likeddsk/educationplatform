<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('back.auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('back.auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Auth $auth)
    {
      if( $request->ajax() ){
        $data = $request->only('auth_name','note');
        // 验证数据
        $role = [
          'auth_name'    =>'required|unique:auth',
        ];
        $message = [
          'auth_name.required'=> '权限名称不能为空！',
          'auth_name.unique'=> '权限名称已存在！',
        ];
        $validator = Validator::make($data,$role,$message);
        // 验证结果
        if( $validator->fails() ){
          return [
            'status'       => false,
            'errormessage' => $validator->messages(), // 返回所有的错误信息
          ];
        }
        // 验证成功，保存数据
        $res = $Auth->create($data); // create添加成功以后返回一条数据，否则返回false
        if($res){
          return ['status'=>true];
        }else{
          return [
            'status'       => false,
            'errormessage' => ['添加失败！'], // 返回所有的错误信息
          ];
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auth $auth)
    {
        //
    }
    public function ajaxGetList(Request $request,Auth $auth){
      if( $request->ajax() ){ // 判断是否ajax请求，是则返回值为true

        // 返回分页页码对应的数据
        $length = $request->input('length');  // 获取一页的数据量
        $start = $request->input('start');    // 查询开始的下标
        $column = $request->input('columns');
        $order = $request->input('order');
        // $order[0]['column'] // 排序的字段下标
        $order_field = $column[ $order[0]['column'] ]['data'];
        $order_status = $order[0]['dir'];
        $data = $auth->orderby($order_field,$order_status)->offset($start)->limit($length)->get();  // 获取数据
        $cnt  = $auth->count();   // 获取返回数据的总数
        $info = [
           'draw'=>$request->get('draw'), // datatables通过ajax请求服务器的次数
           'recordsTotal'=>$cnt,          // 返回数据的总数
           'recordsFiltered'=>$cnt,       // 返回数据的数量[没做筛选，所以数量和上面总数一致]
           'data'=>$data,                 // 实际返回的数据
        ];
        return $info; // 默认，Laravel使用return 返回的数据会自动转成json
      }

}

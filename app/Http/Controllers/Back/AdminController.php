<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * 显示管理员列表   通过get请求
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Admin $admin )
    {
      $data['adminList'] = $admin->get();
      // dump($data['adminList']);
      return view('back.admin.index',$data);
    }

    /**
     * 显示添加管理员的表单   通过get请求
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存由create表单提交的数据[提交数据、保存数据]   通过post请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}

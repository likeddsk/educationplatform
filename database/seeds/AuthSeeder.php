<?php

use Illuminate\Database\Seeder;
use  App\Models\Auth;
class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Auth $auth)
    {
      $auth->truncate(); // 清空表中所有的数据
      // 顶级权限
      $auth->create(['id'=>1,'auth_pid'=>0,'auth_name'=>'专业管理','is_menu'=>1]);
      $auth->create(['id'=>2,'auth_pid'=>0,'auth_name'=>'专业分类','is_menu'=>1]);
      $auth->create(['id'=>3,'auth_pid'=>0,'auth_name'=>'课程管理','is_menu'=>1]);
      $auth->create(['id'=>4,'auth_pid'=>0,'auth_name'=>'课时管理','is_menu'=>1]);
      $auth->create(['id'=>5,'auth_pid'=>0,'auth_name'=>'会员管理','is_menu'=>1]);
      $auth->create(['id'=>6,'auth_pid'=>0,'auth_name'=>'直播管理','is_menu'=>1]);
      $auth->create(['id'=>7,'auth_pid'=>0,'auth_name'=>'试卷管理','is_menu'=>1]);
      $auth->create(['id'=>8,'auth_pid'=>0,'auth_name'=>'试题管理','is_menu'=>1]);
      $auth->create(['id'=>9,'auth_pid'=>0,'auth_name'=>'管理员','is_menu'=>1]);

      // 管理员的子权限
      $auth->create(['auth_pid'=>9,'auth_name'=>'管理员列表','auth_action'=>'index','auth_controller'=>'Admin','auth_address'=>'admin/admin','is_menu'=>1]);
      $auth->create(['auth_pid'=>9,'auth_name'=>'添加管理员','auth_action'=>'create','auth_controller'=>'Admin','auth_address'=>'admin/admin/create','is_menu'=>1]);
      $auth->create(['auth_pid'=>9,'auth_name'=>'保存管理员','auth_action'=>'store','auth_controller'=>'Admin','auth_address'=>'']);
      $auth->create(['auth_pid'=>9,'auth_name'=>'编辑管理员','auth_action'=>'edit','auth_controller'=>'Admin','auth_address'=>'']);
      $auth->create(['auth_pid'=>9,'auth_name'=>'更新管理员','auth_action'=>'update','auth_controller'=>'Admin','auth_address'=>'']);
      $auth->create(['auth_pid'=>9,'auth_name'=>'删除管理员','auth_action'=>'destory','auth_controller'=>'Admin','auth_address'=>'']);
    }
}

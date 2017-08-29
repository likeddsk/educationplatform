<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class Admin extends Authenticatable
{
  //重新定义表名
  protected $table = 'admin';
  //重新定义主键
  protected $primaryKey = 'id';

  //定义允许编辑的字段
  protected $fillable = ['id', 'username', 'nickname', 'avatar', 'sex', 'password', 'email', 'mobile', 'created_at', 'updated_at', 'login_rec', 'login_ip', 'disabled_at', 'deleted_at', 'remember_token'];

  //关联那个模型,就写上那个模型的表名
  public function role(){
    // 因为一个管理员对应一个角色，而一个角色对应着多个管理员，
    // 所以管理员和角色之间的关系是 多 对 1 ，在关联模型的关系时，使用 belongsTo
    return $this->belongsTo(\App\Models\Role::class, 'role_id', 'id');
  }
  // 添加管理员时的数据校验
  public function create_validator($data){
    // 验证数据
    $role = [
      'username'    =>'required|unique:admin',
      'password'    =>'required|between:6,16|same:password2',
      'sex'         =>'numeric',
      'mobile'      =>'regex:/\d{11}/',
      'email'       =>'email',
    ];
    $message = [
      'username.required'=> '帐号不能为空！',
      'username.unique'  => '帐号已存在！',
      'password.required'=> '密码不能为空！',
      'password.between' => '密码长度有误！',
      'password.same'    => '密码和确认密码必须一致！',
      'mobile.regex'     => '手机号码不正确！',
      'email.email'      => '邮箱格式不正确',
    ];
    return Validator::make($data,$role,$message);
  }

  // 编辑管理员时的数据校验
  public function edit_validator($data,$admin,$request){
    // 验证数据
    $role = [
      // 表示验证时忽略掉 指定表名下id = id值 的 字段
      // unique:表名,字段,id值'
      'username'    =>'required|unique:admin,username,' . $admin->id,
      'sex'         =>'numeric',
      'mobile'      =>'regex:/\d{11}/',
      'email'       =>'email',
    ];

    $message = [
      'username.required'=> '帐号不能为空！',
      'username.unique'  => '帐号已存在！',
      'mobile.regex'     => '手机号码不正确！',
      'email.email'      => '邮箱格式不正确',
    ];

    // 单独校验密码
    if( $password = $request->input('password') ){
      // 验证密码长度
      if( strlen($password) < 6 || strlen($password) > 16 ){
        return [
        'status'       => false,
        'errormessage' => ['密码长度有误！'], // 返回所有的错误信息
        ];
      }
      // 验证确认密码和密码
      $password2 = $request->input('password2');
      if( $password != $password2 ){
        return [
        'status'       => false,
        'errormessage' => ['密码和确认密码不一致！'], // 返回所有的错误信息
        ];
      }

      $data['password'] = bcrypt($password);

    }
    // 判断如果没有头像上传
    if( $avatar = $request->input('avatar') ){
      $data['avatar'] = $avatar;
    }

    $validator = Validator::make($data,$role,$message);

    // 验证结果
    if( $validator->fails() ){
      return [
        'status'       => false,
        'errormessage' => $validator->messages(), // 返回所有的错误信息
      ];
    }
    // 返回验证结果给控制器
    return [
      'status'=> true,
      'data'  => $data,
    ];
  }
}

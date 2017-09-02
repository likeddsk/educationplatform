<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  //重定义表名
  protected $table = 'role';
  //重定义主键
  protected $primaryKey = 'id';
  //定义允许编辑的字段
  protected $fillable = [ 'role_name', 'note', 'role_auth_ids', 'role_auth_ac','role_auth_addr'];
  // 确定管理员模型和角色模型的关系  1对多
  public function admin(){ // 要和哪个模型关联关系，那么这里函数名就是那个模型对应的表名
    return $this->hasMany(\App\Models\Admin::class, 'role_id', 'id');
  }
}

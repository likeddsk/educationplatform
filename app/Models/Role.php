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
  protected $fillable = [ 'role_name', 'note', 'role_auth_ids', 'role_auth_ac'];
}

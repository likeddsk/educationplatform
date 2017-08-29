<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
  // 重新定义表名
  protected $table = 'auth';
  // 重新定义主键
  protected $primaryKey = 'id';
  // 定义允许编辑的字段
  protected $fillable = ['auth_pid', 'auth_name', 'auth_action', 'auth_controller', 'auth_address', 'created_at', 'updated_at', 'deleted_at', 'is_menu'];
}

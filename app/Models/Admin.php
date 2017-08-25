<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //重新定义表名
    protected $table = 'admin';
    //重新定义主键
    protected $primaryKey = 'id';
    //定义允许编辑的字段
    /*
    pretected $fillable = ['id', 'username', 'nickname', 'avatar', 'sex', 'password', 'email', 'mobile', 'created_at', 'updated_at', 'login_rec', 'login_ip', 'disabled_at', 'deleted_at', 'remember_token'];
    */
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Role $role)
    {
      $role->truncate(); // 清空表中所有的数据
      $role->insert([
        ['role_name'=>'超级管理员'],
        ['role_name'=>'经理'],
        ['role_name'=>'主管'],
        ['role_name'=>'组长'],
        ['role_name'=>'职员'],
        ['role_name'=>'实习生'],
      ]);
    }
}

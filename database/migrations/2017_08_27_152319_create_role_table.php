<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // 新增字段
      Schema::create('role',function(Blueprint $table){
        $table->smallincrements('id')->comment('主键ID');
        $table->string('role_name','50')->unique()->comment('角色名称');
        $table->text('note')->nullable()->comment('角色描述');
        $table->text('role_auth_ids')->nullable()->comment('权限ID值');
        $table->text('role_auth_ac')->nullable()->comment('权限控制器名称和方法');
        $table->string('role_auth_addr',200)->nullable()->comment('菜单地址');
        $table->timestamps();
        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('role');
    }
}

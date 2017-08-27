<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // 权限表
      Schema::create('auth',function(Blueprint $table){
        $table->increments('id')->comment('主键ID');
        $table->integer('auth_pid')->default(0)->comment('父级ID');
        $table->string('auth_name',50)->comment('权限名称');
        $table->string('auth_action',50)->nullable()->comment('权限所属方法');
        $table->string('auth_controller',50)->nullable()->comment('权限所属控制器');
        $table->string('auth_address',100)->nullable()->comment('权限路由地址');
        $table->timestamps();
        $table->softDeletes();
        $table->unsignedTinyInteger('is_menu')->default(0)->comment('是否显示左侧菜单');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('auth');
    }
}

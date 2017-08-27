<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminColumn2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // 新增字段
      Schema::table('admin',function(Blueprint $table){
        $table->unsignedSmallInteger('role_id')->default(0)->comment('角色ID')->after('id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //删除字段
      Schema::table('admin',function(Blueprint $table){
        $table->dropColumn([role_id]);
      });
    }
}

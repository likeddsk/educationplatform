<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminColumn extends Migration
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
           $table->string('avatar',255)->nullable()->comment('头像')->after('nickname');
           $table->string('mobile',50)->nullable()->unique()->comment('手机号码')->after('email');
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
             $table->dropColumn(['avatar','mobile']);
      });
    }
}

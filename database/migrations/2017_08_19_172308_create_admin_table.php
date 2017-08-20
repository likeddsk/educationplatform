<?php
//Laravel提供给我们操作表的工具类
use Illuminate\Support\Facades\Schema;
//Laravel提供给我们声明/操作表结构的工具类
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // Schema::create('表名','回调函数(声明表结构)');
      Schema::create('admin',function(Blueprint $table){
        $table->engine = 'innoDB'; //声明表的类型

        // int unsigned not null auto_increment primary key
        $table->increments('id')->comment('主键ID');

        // varchar(150) unique key not null
        $table->string('username',150)->unique()->comment('帐号');

        // varchar(150)  null
        $table->string('nickname',150)->nullable()->comment('昵称');

        // tinyint  default 1
        $table->tinyInteger('sex')->default(1)->comment('性别(1:男;2:女;3:保密)');

        // varchar(255) not null
        $table->string('password',255)->comment('密码');

        // varchar(150) unique key null
        $table->string('email',150)->unique()->nullable()->comment('邮箱');

        // Laravel提供了timestamps() 方法，可以帮我们自动生成 created_at 和 updated_at
        $table->timestamps();

        // int unsigned default 0
        $table->unsignedInteger('login_rec')->default(0)->comment('登录次数');

        // char(30) null
        $table->char('login_ip',30)->nullable()->comment('登录IP');

        // timestamp null
        $table->timestamp('disabled_at')->nullable()->comment('启用状态(null:启用;有时间戳表示禁用)');


        $table->softDeletes()->comment('软删除时间');

        // VARCHAR(100) NULL.
        $table->rememberToken();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //Schema::dropIfExists('表名');
      Schema::dropIfExists('admin');
    }
}

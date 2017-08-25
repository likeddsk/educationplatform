<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //第一种方式,自定义生成测试数据
      /*
      for ($i=0; $i < 21; $i++) {
        DB::table('admin')->insert([
          //随机生成指定长度的字符串,是laravel的辅助函数
          'username' => str_random(5), //随机生成5个字符串
          //加密函数bcrypt是laravel的辅助函数,是hash::make方法的简写
          'password' => bcrypt('123456'),
        ]);
      }
      */

      //第二种方式,运用faker生成仿真数据
      $faker = Factory::create('zh_CN'); //生成的数据是中文
      for ($i=1 ; $i <=20 ; $i++) {
        DB::table('admin')->insert([
          'username' => $faker->userName,
          'password' => bcrypt('123456'),
          'nickname' => $faker->name,
          'email'    => $faker->email,
          'mobile'   => $faker->phoneNumber,
          'login_ip' => $faker->ipv4,
        ]);
      }
    }
}

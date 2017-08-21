<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//注释掉自带的
/*
$factory->define(App\User::class, function (Faker\Generator $faker) {
  static $password;

  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
  ];
});
*/

//生成Admin模型的数据
$factory->define( App\Models\Admin::class,function (Faker\Generator $faker){
  $faker = Faker\Factory::create('zh_CN');
  static $password;

  return [
    'username' => $faker->userName,
    'password' => $password?:$password = bcrypt('123456'),
    'nickname' => $faker->name,
    'email'    => $faker->email,
    'mobile'   => $faker->phoneNumber,
    'login_ip' => $faker->ipv4,
  ];
});

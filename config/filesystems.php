<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [  //disks磁盘空间[存储文件不同设备]

        'local' => [ //使用 store 方法保存文件 ,不指定第三个参数时,则默认保存本地
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            //这里表示可以通过域名/public/直接访问到这里的文件中
            'visibility' => 'public',
        ],

        's3' => [ // s3是亚马逊云存储服务器的存储空间,类似我们前面提到的七牛云
            'driver' => 's3',
            'key' => env('AWS_KEY'),        //APPID
            'secret' => env('AWS_SECRET'),  //APP密钥
            'region' => env('AWS_REGION'),  //当前项目所在地区Asia/Beijing
            'bucket' => env('AWS_BUCKET'),  //空间名,创建存储空间时自定义的
        ],
        //七牛云存储
        'qiniu' => [
            'driver' => 'qiniu',
            //七牛云ak ID
            'access_key' => env('QINIU_ACCESS_KEY','Mu_t_2fKChW79w5fmzG-94wUzvbg-HFcAjTpHjev'),
            //七牛云sk ID
            'secret_key' => env('QINIU_SECRET_KEY','mruXNzbnQ0HIXlqv9LDwGHrm8RPKB4QQSihcfZDV'),
            //存储空间名称
            'bucket' => env('QINIU_BUCKET','educationplatform'),
            //存储空间对应的访问域名
            'domain' => env('QINIU_DOMAIN','http://ova8eshot.bkt.clouddn.com'),
        ],
    ],

];

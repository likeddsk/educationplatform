<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Filesystem;
use Overtrue\Flysystem\Qiniu\QiniuAdapter;

class AdminController extends Controller
{
  /**
   * 显示管理员列表   通过get请求
   *
   * @return \Illuminate\Http\Response
   */
  public function index( Admin $admin )
  {
    // $data['adminList'] = $admin->get();
    // dump($data['adminList']);
    // return view('back.admin.index',$data);
    return view('back.admin.index');
  }

  /**
   * 显示添加管理员的表单   通过get请求
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('back.admin.create');
  }

  /**
   * 保存由create表单提交的数据[提交数据、保存数据]   通过post请求
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request,Admin $admin)
  {
    //判断是否有ajax请求
    if( $request->ajax() ){
      //接受前台数据
      $data = $request->only('username','nickname','password','password2',
      'sex','mobile','email','disabled_at','avatar');

      // 可以把验证的规则和代码转义到模型中
       $validator = $admin->create_validator($data);
       // 验证结果
       if( $validator->fails() ){
         return [
           'status'       => false,
           'errormessage' => $validator->messages(), // 返回所有的错误信息
         ];
      }

      // 数据调整
      $data['disabled_at'] = $data['disabled_at']?date('Y-m-d H:i:s'):null;
      $data['password']    = bcrypt( $data['password'] );

      // 验证成功，保存数据
      $res = $admin->create($data); // create添加成功以后返回一条数据，否则返回false
      if($res){
        return ['status'=>true];
      }else{
        return [
          'status'       => false,
          'errormessage' => ['添加失败！'], // 返回所有的错误信息
        ];
      }
    }
  }

  /**
   * 显示一条数据   通过get请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * 显示编辑管理员的表单   通过get请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Admin $admin,Request $request)
  {
    // 当我们把id参数发送给控制器的参数列表中，
    // 声明必须是一个模型的时候，
    // 则Laravel会自动帮我们查询对应id的数据
    $data['adminInfo'] = $admin;
    return view('back.admin.edit', $data);
  }

  /**
   * 接受保存由edit表单提交过来的数据[接收数据、保存编辑数据]   通过put请求
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Admin $admin)
  {
    //判断是都有ajax数据
    if ( $request->ajax() ) {
      //接收数据
      $data = $request->only('username','nickname','sex',
      'mobile','email','disabled_at');

      // 这里的 edit_validator 是我们自定义的验证数据的方法
      $result = $admin->edit_validator($data,$admin,$request);
      if( $result['status'] ){ // 如果验证成功，则结果返回$data数据

        $data = $result['data'];
      }else{                 // 如果验证失败！则结果返回给前端ajax
        return $result;
      }

      // 数据调整
      $data['disabled_at'] = $data['disabled_at']?date('Y-m-d H:i:s'):null;

      // 验证成功，保存数据
      $res = $admin->update($data); // create添加成功以后返回一条数据，否则返回false

      if($res){
        return ['status'=>true];
      }else{
        return [
          'status'       => false,
          'errormessage' => ['编辑失败！'], // 返回所有的错误信息
        ];
      }
    }
  }

  /**
   * 移除指定ID的一条/多条数据   http的delete请求
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Admin $admin,Request $request)
  {
    //判断有ajax传过来的数据
    if( $request->ajax() ){
      // 如果有图片地址，则直接调用七牛云扩展包对象把删除删除
      $domain = config('filesystems.disks.qiniu.domain') .'/';
      // dump($admin->avatar);
      $res = explode($domain,$admin->avatar);

      $avatar = isset($res[1])?$res[1]:'';

      $accessKey = config('filesystems.disks.qiniu.accessKey');
      $secretKey = config('filesystems.disks.qiniu.secretKey');
      $bucket = config('filesystems.disks.qiniu.bucket');
      $domain = config('filesystems.disks.qiniu.domain');
      // or with protocol: https://xxxx.bkt.clouddn.com

      $adapter = new QiniuAdapter($accessKey, $secretKey, $bucket, $domain);
      $flysystem = new Filesystem($adapter);

      if( $flysystem->has($avatar) ){ // 判断七牛云上面是否存在该图片
        $flysystem->delete($avatar);
      }

      $res = $admin->delete();
      if( $res ){
        return ['status'=>true];
      }else{
        return ['status'=>false];
      }
    }
  }
  /**
   * datatable的Ajax获取列表数据
   */
  public function ajaxGetList( Request $request,Admin $admin ){
    if ( $request->ajax() ){  //判断有没有ajax请求,有的话返回true
      //返回数据有两种方法,一种一次性返回所有数据,另一种就是一次性返回一页数据
      //1.返回所有数据给datatables
      /*
      $data = $admin->get(); //获取数据
      $cnt = count($data); //获取返回数据的总数
      $info = [
        'draw' => $request->get('draw'), //datatables通过ajax请求服务器次数
        'recordsTotal' => $cnt, //返回数据的总数
        'recordsFiltered' => $cnt, //返回数据的数量[没做筛选,所以和上面一样]
        'data' => $data,
      ];
      return $info; //默认,laravel使用return ,返回的数据会自动转成json
      */

      //2.返回分页页码对应的数据
      $length = $request->input('length'); //回去一页的数据量
      $start  = $request->input('start'); //查询开始的下标
      $column = $request->input('columns');
      $order  = $request->input('order');
      //$order[0]['column'] //排序的字段下表
      $order_field = $column[ $order[0]['column'] ]['data'];
      $order_status= $order[0]['dir'];
      $data = $admin->orderby($order_field,$order_status)->offset($start)
                    ->limit($length)->get(); //获取数据
      $cnt = $admin->count(); //获取返回数据的总数
      $info = [
        'draw' => $request->get('draw'), //datatables通过ajax请求服务器次数
        'recordsTotal' => $cnt, //返回数据的总数
        'recordsFiltered' => $cnt, //返回数据的数量[没做筛选,所以和上面一样]
        'data' => $data,
      ];
      return $info; //默认,laravel使用return ,返回的数据会自动转成json
    }
  }
  /**
   * ajax上传头像的方法
   * 在这个方法中上传文件到七牛云中
   */
  public function uploadImage(Request $request){
    //接受上传
    //判断是都有文件上传
    if ( $request->hasFile('avatar') ) {
      //file表示的form表单中的name值
      $file = $request->file('avatar');
      // dump($file);

      // $file->store('目录','文件名','磁盘');
      // 目录     指代的就是文件要分目录存储所以需要定义目录名称
      // 文件名   必须以时间戳为主生成为一个文件，否则文件出现覆盖
      // 磁盘     存储设备[我们可以通过config/filesystem.php文件来定义我们存储文件的不同磁盘]
      $path     = 'avatar/' . date('Y-m-d'); // 文件保存目录
      $filename =  date('YmdHis') . str_random(12) .'.'. $file->extension();
      $disk     = 'qiniu'; // 设置成public，可以直接通过通过域名来访问
      // store 和 storeAs
      // store 会自动帮我们生成文件名
      // storeAs 需要我们自己定义文件名
      $res = $file->storeAs($path, $filename, $disk );
      if ($res) {
        return [
          'status' => true,
          'file'   => config('filesystems.disks.qiniu.domain').'/'.$res,
        ];
      }else{
        return ['status' => false];
      }
    }
  }
}

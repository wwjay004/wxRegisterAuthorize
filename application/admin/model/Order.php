<?php


namespace app\admin\model;


use think\Model;

class Order extends Model
{
    protected $hidden = [
        'update_time', 'delete_time'
    ];

    public $autoWriteTimestamp = true;

    // 查询订单
    public static function getSummaryByPage($page = 1, $size = 20){
        $self =new Order();
        return $self->order('create_time desc')->paginate($size,true,['page'=>$page]);
    }
}
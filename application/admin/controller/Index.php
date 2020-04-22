<?php


namespace app\admin\controller;


use think\Controller;
use app\admin\model\Order as OrderModel;
use think\Db;

class Index extends Controller
{
    // 首页
    public function index(){
        return $this->fetch('window');
    }

    // 自助订单
    public function orders() {
        if(request() -> isPost()){
            $pagingOrders = OrderModel::getSummaryByPage(1, 15);
            if($pagingOrders -> isEmpty()){
                return [
                    'data' => [],
                    'current_page' =>$pagingOrders::getCurrentPage(),
                ];
            }
            $count = Db::name('order')->count("id");
            $data = $pagingOrders->hidden(['snap_items'])->toArray();
            $res = array(
                'code' => 1,
                'msg'  => '',
                'total'  => $count,
                'list'   => $data
            );
            return json($res);
        }
        return $this->fetch('orders');
    }

    // 自助填写
    public function settings(){
        return $this->fetch('settings');
    }

    // 自助填写
    public function tips(){

        return $this->fetch('tips');
    }

    // 小程序列表
    public function wxapp() {
        return $this->fetch('wxapp');
    }
}
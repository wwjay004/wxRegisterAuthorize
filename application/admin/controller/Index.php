<?php


namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    // 首页
    public function index(){
        return $this->fetch('window');
    }

    // 自助订单
    public function orders() {
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
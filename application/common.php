<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * http传输数据
 * @param $url string
 * @param $data_string string
 * @return bool|string
 */
function http_post_data($url, $data_string) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl,CURLOPT_POST,1);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data_string);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string)
        )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}


function getMessageStatus($content = array(), $isPush = false){
    if($content['errcode'] == '86004'){
        $content['errmsg'] = "无效微信号";
    }elseif($content['errcode'] == '89249'){
        $content['errmsg'] = "该主体已有任务执行中，距上次任务24h后再试";
    }elseif($content['errcode'] == '89247'){
        $content['errmsg'] = "内部错误";
    }elseif($content['errcode'] == '61070'){
        $content['errmsg'] = "内部法人姓名与微信号不一致";
    }elseif($content['errcode'] == '89248'){
        $content['errmsg'] = "企业代码类型无效，请选择正确类型填写";
    }elseif($content['errcode'] == '89250'){
        $content['errmsg'] = "未找到该任务";
    }elseif($content['errcode'] == '89251'){
        $content['errmsg'] = "待法人人脸核身校验";
    }elseif($content['errcode'] == '89252'){
        $content['errmsg'] = "法人&企业信息一致性校验中";
    }elseif($content['errcode'] == '89253'){
        $content['errmsg'] = "缺少参数";
    }elseif($content['errcode'] == '89254'){
        $content['errmsg'] = "第三方权限集不全，补全权限集全网发布后生效";
    }elseif($content['errcode'] == '0'){
        $content['errmsg'] = "成功";
    }elseif($content['errcode'] == '-1' && $isPush){
        $content['errmsg'] = "企业与法人姓名不一致";
    }elseif($content['errcode'] == '1000'){
        $content['errmsg'] = "工商数据返回：“企业信息或法定代表人信息不一致”";
    }elseif($content['errcode'] == '105'){
        $content['errmsg'] = "法定代表人身份证号码，工商数据未更新，请5-15个工作日之后尝试";
    }elseif($content['errcode'] == '104'){
        $content['errmsg'] = "工商数据返回：“企业法定代表人身份证号码不一致”";
    }elseif($content['errcode'] == '103'){
        $content['errmsg'] = "工商数据返回：“企业法定代表人姓名不一致”";
    }elseif($content['errcode'] == '102'){
        $content['errmsg'] = "工商数据返回：“企业不存在或企业信息未更新”";
    }elseif($content['errcode'] == '101'){
        $content['errmsg'] = "工商数据返回：“企业已注销”";
    }elseif($content['errcode'] == '100003'){
        $content['errmsg'] = "已下发的模板消息法人并未确认且已超时（24h）";
    }elseif($content['errcode'] == '100002'){
        $content['errmsg'] = "已下发的模板消息法人并未确认且已超时（24h），未进行人脸识别校验";
    }elseif($content['errcode'] == '100001'){
        $content['errmsg'] = "已下发的模板消息法人并未确认且已超时（24h），未进行身份证校验";
    }elseif(!empty($content['errmsg'])){
        $content['errmsg'] = $content['errmsg'];
    }else{
        $content['errmsg'] = "未知错误";
    }
    return $content['errmsg'];
}
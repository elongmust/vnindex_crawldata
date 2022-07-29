<?php

function setCurl(&$ch, array $header)
{ // 批处理 curl
    $a = curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 忽略证书
    $b = curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 不检查证书与域名是否匹配（2为检查）
    $c = curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 以字符串返回结果而非输出
    $d = curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // 请求头
    return ($a && $b && $c && $d);
}
function post(string $url, $data, array $header)
{ // POST 发送数据
    $ch = curl_init($url);
    setCurl($ch, $header);
    curl_setopt($ch, CURLOPT_POST, true); // POST 方法
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST 的数据
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function get(string $url, array $header)
{ // GET 请求数据
    $ch = curl_init($url);
    setCurl($ch, $header);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function head(string $url, array $header)
{ // 获取响应头
    $ch = curl_init($url);
    setCurl($ch, $header);
    curl_setopt($ch, CURLOPT_HEADER, true); // 返回响应头
    curl_setopt($ch, CURLOPT_NOBODY, true); // 只要响应头
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE); // 获得响应头大小
    $result = substr($response, 0, $header_size); // 根据头大小获取头信息
    curl_close($ch);
    //echo $result; die();
    return $result;
}

function getStockValueFromDivString($str)
{
    $str = preg_replace("/(<([^>]+)>)/i", "", $str);
    // $str = preg_replace("/<\/?td[^>]*\>/i", "", $str);
    $str = str_replace('&nbsp;', '', $str);
    $str = str_replace(',', '', $str);
    return $str;
}
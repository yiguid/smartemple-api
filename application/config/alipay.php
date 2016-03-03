<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['partner']      = '2088811758301594';
$config['key']          = 'vqsuv6ctvz92b4dj0h9menqavwkfpp97';
$config['seller_email'] = 'irockwill@163.com';
$config['payment_type'] = 1;
$config['transport'] = 'http';
$config['input_charset'] = 'utf-8';
$config['sign_type'] = 'MD5';
$config['notify_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/order/callback/notify';
$config['return_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/order/callback/return';
$config['cacert'] = APPPATH.'third_party/alipay/cacert.pem';
<?php
/**
 * Created by PhpStorm.
 * mysql数据库连接配置文件
 * User: break
 * Date: 12/03/17
 * Time: 下午 09:54
 */
use Workerman\Worker;

//ip地址
$ip='192.168.2.128';
//端口
$port='3306';
//用户名
$user='root';
//密码
$password='Admin123';
//数据库
$database='workerman';
//new一个数据库连接的实例
$db = new Workerman\MySQL\Connection($ip,$port,$user,$password,$database);
// 将db实例存储在全局变量中
global $db;
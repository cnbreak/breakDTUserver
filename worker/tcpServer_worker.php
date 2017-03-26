<?php
/**
 * Created by PhpStorm.
 * $tcpServer_worker相关函数
 * User: break
 * Date: 12/03/17
 * Time: 下午 10:05
 */
use Workerman\Worker;

// 创建一个tcp协议的Worker监听6001端口，不使用任何应用层协议
$tcpServer_worker = new Worker("tcp://0.0.0.0:6001");
// 启动4个进程对外提供服务
$tcpServer_worker->count = 4;
//当前$tcpServer_worker的名字
$tcpServer_worker->name = 'tcpServer';

require_once __DIR__ . '/Event/tcpServer_worke/onWorkerStart.php';
require_once __DIR__ . '/Event/tcpServer_worke/onConnect.php';
require_once __DIR__ . '/Event/tcpServer_worke/onMessage.php';
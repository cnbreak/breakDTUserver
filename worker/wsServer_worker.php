<?php
/**
 * Created by PhpStorm.
 * $channel_server相关函数
 * User: break
 * Date: 12/03/17
 * Time: 下午 10:21
 */
use Workerman\Worker;

// 创建一个websocket协议的Worker监听6003端口，不使用任何应用层协议
$wsServer_worker = new Worker('websocket://0.0.0.0:6003');
// 启动几个进程对外提供服务
//$wsServer_worker->count=2;
//当前$wsServer_worker的名字
$wsServer_worker->name = 'wsServer';

require_once __DIR__ . '/Event/wsServer_worker/onWorkerStart.php';
require_once __DIR__ . '/Event/wsServer_worker/onMessage.php';



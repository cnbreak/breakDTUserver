<?php
/**
 * Created by PhpStorm.
 * $httpServer_worker相关函数
 * User: break
 * Date: 12/03/17
 * Time: 下午 10:20
 */
use Workerman\Worker;

// 创建一个http协议的Worker监听6002端口，不使用任何应用层协议
$httpServer_worker = new Worker('http://0.0.0.0:6002');
//当前$httpServer_worker的名字
$httpServer_worker->name = 'httpServer';
// 设置此实例收到reload信号后是否reload重启
$httpServer_worker->reloadable = false;

require_once __DIR__ . '/Event/httpServer_worker/onWorkerStart.php';
require_once __DIR__ . '/Event/httpServer_worker/onMessage.php';






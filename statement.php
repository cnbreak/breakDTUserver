<?php
/**
 * Created by PhpStorm.
 * 所有的Worker类及配置类
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:30
 */

//自己开发的
//$tcpServer_worker文件
require_once __DIR__ . '/worker/tcpServer_worker.php';
//$httpServer_worker文件
require_once __DIR__ . '/worker/httpServer_worker.php';
//$wsServer_worker文件
require_once __DIR__ . '/worker/wsServer_worker.php';
//$channel_server文件
require_once __DIR__ . '/worker/channel_server.php';
//$DBConnection文件 mysql数据库配置文件
require_once __DIR__ . '/config/dbConnection.php';
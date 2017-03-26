<?php
/**
 * Created by PhpStorm.
 * $channel_server相关函数
 * User: break
 * Date: 12/03/17
 * Time: 下午 10:18
 */
use Workerman\Worker;

// 初始化一个Channel服务端
$channel_server = new Channel\Server('0.0.0.0', 6000);

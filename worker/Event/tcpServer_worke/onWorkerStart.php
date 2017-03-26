<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:50
 */
use Workerman\Lib\Timer;

// 心跳间隔时间，单位秒
define('HEARTBEAT_TIME', 25);

//$tcpServer_worker启动时
$tcpServer_worker->onWorkerStart = function($tcpServer_worker)
{
    // 进程启动后设置一个每秒运行一次的定时器，判断心跳间隔
    Timer::add(1, function()use($tcpServer_worker){
        $time_now = time();
        foreach($tcpServer_worker->connections as $connection) {
            // 有可能该connection还没收到过消息，则lastMessageTime设置为当前时间
            if (empty($connection->lastMessageTime)) {
                $connection->lastMessageTime = $time_now;
                continue;
            }
            // 上次通讯时间间隔大于心跳间隔，则认为客户端已经下线，关闭连接
            if ($time_now - $connection->lastMessageTime > HEARTBEAT_TIME) {
                $connection->close();
            }
        }
    });

    Channel\Client::connect('0.0.0.0', 6000);// Channel客户端连接到Channel服务端

    $event_name = $tcpServer_worker->id;// 以自己的进程id为事件名称
    // 订阅worker->id事件并注册事件处理函数
    Channel\Client::on($event_name, function($event_data)use($tcpServer_worker){
        $to_connection_id = $event_data['to_connection_id'];
        $message = $event_data['content'];
        if(!isset($tcpServer_worker->connections[$to_connection_id]))
        {
            echo "connection not exists\n";
            return;
        }
        $to_connection = $tcpServer_worker->connections[$to_connection_id];
        $to_connection->send($message);
    });

    // 订阅广播事件
    $event_name = '广播';
    // 收到广播事件后向当前进程内所有客户端连接发送广播数据
    Channel\Client::on($event_name, function($event_data)use($tcpServer_worker){
        $message = $event_data['content'];
        foreach($tcpServer_worker->connections as $connection)
        {
            $connection->send($message,false);
        }
    });
};
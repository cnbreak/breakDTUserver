<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:53
 */

//$wsServer_worker启动时
$wsServer_worker->onWorkerStart = function($wsServer_worker)
{
    Channel\Client::connect('0.0.0.0', 6000);// Channel客户端连接到Channel服务端

    $event_name = $wsServer_worker->id;// 以自己的进程id为事件名称
    // 订阅worker->id事件并注册事件处理函数
    Channel\Client::on($event_name, function($event_data)use($wsServer_worker){
        $to_connection_id = $event_data['to_connection_id'];
        $message = $event_data['content'];
        if(!isset($wsServer_worker->connections[$to_connection_id]))
        {
            echo "connection not exists\n";
            return;
        }
        $to_connection = $wsServer_worker->connections[$to_connection_id];
        $to_connection->send($message);
    });

    // 订阅广播事件
    $event_name = '广播';
    // 收到广播事件后向当前进程内所有客户端连接发送广播数据
    Channel\Client::on($event_name, function($event_data)use($wsServer_worker){
        $message = $event_data['content'];
        foreach($wsServer_worker->connections as $connection)
        {
            $connection->send($message);
        }
    });
};
<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:54
 */
require_once dirname(__FILE__).'/'.'../../../config/instructions.php';

// 当客户端发来数据时
$wsServer_worker->onMessage = function($connection, $data)
{
    //$connection->send('ok');

    $cmd=substr($data,0,strcspn($data,"|"));
    $worker_id=substr($data,strlen($cmd)+1,strcspn($data,"&")-strlen($cmd)-1);
    $connection_id=substr($data,strlen($cmd)+strlen($worker_id)+2,strcspn($data,"$")-(strlen($cmd)+strlen($worker_id))-2);
    //echo $cmd."|".$worker_id."|".$connection_id;

    if(empty($cmd)) return;
    // 是向某个worker进程中某个连接推送数据
    if(isset($worker_id) && isset($connection_id))
    {
        $event_name = $worker_id;
        $to_connection_id = $connection_id;
        $content=convertCode($cmd);
        Channel\Client::publish($event_name, array(
            'to_connection_id' => $to_connection_id,
            'content'          => $content
        ));
        $connection->send('命令已发送');
    }
    // 是全局广播数据
    else
    {
        $event_name = '广播';
        $content=convertCode($cmd);
        Channel\Client::publish($event_name, array(
            'content'          => $content
        ));
        $connection->send('命令已发送');
    }
};
<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:54
 */
//设备的指令的文件
require_once dirname(__FILE__).'/'.'../../../config/instructions.php';
// 当客户端发来数据时
$httpServer_worker->onMessage = function($connection, $data)
{

    if(empty($_GET['content']))
    {
        $connection->send('无指令！');
        return;
    }

    $content=convertCode($_GET['content']);
    echo $content;
    //echo $content;

    // 是向某个worker进程中某个连接推送数据
    if(isset($_GET['to_worker_id']) && isset($_GET['to_connection_id']))
    {
        $event_name = $_GET['to_worker_id'];
        $to_connection_id = $_GET['to_connection_id'];
        //$content = $_GET['content'];
        //$content = "\xAA\x55\x00\x01\x01\x00\x00";
        Channel\Client::publish($event_name, array(
            'to_connection_id' => $to_connection_id,
            'content'          => $content
        ));
    }
    // 是全局广播数据
    else
    {
        $event_name = '广播';
        Channel\Client::publish($event_name, array(
            'content'          => $content
        ));
    }
    $connection->send("指令已发送！：".$content);
};

function convertCode($content)
{
    //根据内容长度生成相应的指令
    switch(strlen ( $content ))
    {
        case 11://锁孔板相关指令
            return getcmd($content);
            break;

    }

}
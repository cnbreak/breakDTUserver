<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:50
 */

//当有连接时
$tcpServer_worker->onConnect = function($connection)use($tcpServer_worker)
{
//    global $db;// 通过全局变量获得db实例
//    // 执行SQL
//    //$all_tables = $db->query('show tables');
//    // 插入
//    $insert_id = $db->insert('device')->cols(array(
//        'workerId' => $tcpServer_worker->id,
//        'connectionId' => $connection->id,
//        'connectionIp' => $connection->getRemoteIp(),
//        'lastConnectionTime' => date("Y-m-d H:i:s")
//    ))->query();
//    //$connection->send(json_encode($all_tables));
//    $msg = "workerID:{$tcpServer_worker->id},connectionID:{$connection->id},connectionIp:{$connection->getRemoteIp()} connected \n";
//    echo $msg;

};
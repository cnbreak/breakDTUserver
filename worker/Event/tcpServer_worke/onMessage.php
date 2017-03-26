<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:51
 */

date_default_timezone_set('Asia/Shanghai');//设置时区为上海，防止数据库插入时间时错误

// 当客户端发来数据时
$tcpServer_worker->onMessage = function($connection, $data)use($tcpServer_worker)
{
    // 给connection临时设置一个lastMessageTime属性，用来记录上次收到消息的时间
    $connection->lastMessageTime = time();

    //echo strlen($data);
    //根据DTU发送内容的长度决定执行什么函数
    switch(strlen($data))
    {
        case 4: Heartbeat($tcpServer_worker,$connection,$data); break;//当message接收到DTU心跳包时，心跳包数据长度为4位

        default: break;
    }

};

//接收到长度为5的数据时
function Heartbeat($tcpServer_worker,$connection,$data)
{
    // 通过全局变量获得db实例
    global $db;
    //1.先判断数据库是否有此设备信息，没有的话添加：根据设备发送的唯一标识判断，数据长度为5位
    $select_deviceId = $db->select('deviceId')->from('device')->where("deviceIdNo={$data}")->single();
    //echo "id={$select_id}";
    //echo "time:".date("Y-m-d H:i:s");
    //当此DTU唯一标识在数据库中不存在时：创建
    if($select_deviceId==null)
    {
        //echo 'create|';
        global $db;// 通过全局变量获得db实例
        // 插入
        $insert_id = $db->insert('device')->cols(array(
            'deviceWorkerId' => $tcpServer_worker->id,
            'deviceConnectionId' => $connection->id,
            'deviceConnectionIp' => $connection->getRemoteIp(),
            'deviceIdNo' => $data,
            'deviceLastConnectionTime' => date("Y-m-d H:i:s")
        ))->query();
        //获取刚插入的自增长id的值
        //判断数据库是否有此设备信息，没有的话添加：根据设备发送的唯一标识判断，数据长度为5位
        $select_deviceInfoId = $db->select('deviceInfoId')->from('deviceinfo')->where("deviceId={$insert_id}")->single();

        if($select_deviceInfoId==null) {
            $select_deviceId = $db->select('deviceId')->from('device')->where("deviceIdNo={$data}")->single();
            $insert_ida = $db->insert('deviceinfo')->cols(array(
                'deviceId' => $select_deviceId,
                'deviceInfoType' => 'NULL',
                'deviceInfoAddress' => 'NULL',
                'deviceInfoCity' => 'NULL',
                'deviceInfoInstallTime' => 'NULL'
             ))->query();
        }
        //$connection->send(json_encode($all_tables));
        //$msg = "{$last_insert_id},workerID:{$tcpServer_worker->id},cID:{$connection->id},cIp:{$connection->getRemoteIp()}|";
        //echo $msg;
    }
    //当此DTU唯一标识在数据库中存在时：根据设备唯一标识更新
    else
    {
        //echo 'update|';
        //更新
        $row_count = $db->query("UPDATE device SET deviceWorkerId={$tcpServer_worker->id},deviceConnectionId = {$connection->id},deviceConnectionIp='{$connection->getRemoteIp()}',deviceLastConnectionTime='".date("Y-m-d H:i:s")."' WHERE deviceIdNo = {$data}");
        $msg = "更新了几行：{$row_count}";
        //echo $msg;
    }

}
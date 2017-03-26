<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 12/03/17
 * Time: 下午 11:53
 */

//$httpServer_worker启动时
$httpServer_worker->onWorkerStart = function()
{
    Channel\Client::connect('0.0.0.0', 6000);
};
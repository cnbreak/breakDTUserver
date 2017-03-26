<?php
/**
 * Created by PhpStorm.
 * User: break
 * Date: 15/03/17
 * Time: 上午 09:02
 */
function getcmd($content)
{
    return getdeviceType($content);

}

function getdeviceType($content)
{
    switch(substr($content,0,1))//首先判断内容的第一位是什么设备
    {
        case 's'://开锁指令
            return getScmd($content);
            break;

    }
}

function getScmd($content)
{
    switch(substr($content,1,10))
    {
        //板子拨码开关设定地址为00的命令begin
        //开锁命令begin
        case '0001010000': return $cmd = "\xAA\x55\x00\x01\x01\x00\x00";break;//AA 55 00 01 01 00 00
        case '0001020000': return $cmd = "\xAA\x55\x00\x01\x02\x00\x00";break;//AA 55 00 01 02 00 00
        case '0001040000': return $cmd = "\xAA\x55\x00\x01\x04\x00\x00";break;//AA 55 00 01 04 00 00
        case '0001080000': return $cmd = "\xAA\x55\x00\x01\x08\x00\x00";break;//AA 55 00 01 08 00 00
        case '0001100000': return $cmd = "\xAA\x55\x00\x01\x10\x00\x00";break;//AA 55 00 01 10 00 00
        case '0001200000': return $cmd = "\xAA\x55\x00\x01\x20\x00\x00";break;//AA 55 00 01 20 00 00
        case '0001400000': return $cmd = "\xAA\x55\x00\x01\x40\x00\x00";break;//AA 55 00 01 40 00 00
        case '0001800000': return $cmd = "\xAA\x55\x00\x01\x80\x00\x00";break;//AA 55 00 01 80 00 00--
        case '0001000100': return $cmd = "\xAA\x55\x00\x01\x00\x01\x00";break;//AA 55 00 01 00 01 00
        case '0001000200': return $cmd = "\xAA\x55\x00\x01\x00\x02\x00";break;//AA 55 00 01 00 02 00
        case '0001000400': return $cmd = "\xAA\x55\x00\x01\x00\x04\x00";break;//AA 55 00 01 00 04 00
        case '0001000800': return $cmd = "\xAA\x55\x00\x01\x00\x08\x00";break;//AA 55 00 01 00 08 00
        case '0001001000': return $cmd = "\xAA\x55\x00\x01\x00\x10\x00";break;//AA 55 00 01 00 10 00
        case '0001002000': return $cmd = "\xAA\x55\x00\x01\x00\x20\x00";break;//AA 55 00 01 00 20 00
        case '0001004000': return $cmd = "\xAA\x55\x00\x01\x00\x40\x00";break;//AA 55 00 01 00 40 00
        case '0001008000': return $cmd = "\xAA\x55\x00\x01\x00\x80\x00";break;//AA 55 00 01 00 80 00--
        case '0001000001': return $cmd = "\xAA\x55\x00\x01\x00\x00\x01";break;//AA 55 00 01 00 00 01
        case '0001000002': return $cmd = "\xAA\x55\x00\x01\x00\x00\x02";break;//AA 55 00 01 00 00 02
        case '0001000004': return $cmd = "\xAA\x55\x00\x01\x00\x00\x04";break;//AA 55 00 01 00 00 04
        case '0001000008': return $cmd = "\xAA\x55\x00\x01\x00\x00\x08";break;//AA 55 00 01 00 00 08
        case '0001000010': return $cmd = "\xAA\x55\x00\x01\x00\x00\x10";break;//AA 55 00 01 00 00 10
        case '0001000020': return $cmd = "\xAA\x55\x00\x01\x00\x00\x20";break;//AA 55 00 01 00 00 20
        case '0001000040': return $cmd = "\xAA\x55\x00\x01\x00\x00\x40";break;//AA 55 00 01 00 00 40
        case '0001000080': return $cmd = "\xAA\x55\x00\x01\x00\x00\x80";break;//AA 55 00 01 00 00 80--
        //开锁命令end
        //获取反馈begin
        case '0000010000': return $cmd = "\xAA\x55\x00\x00\x01\x00\x00";break;//AA 55 00 00 01 00 00
        case '0000020000': return $cmd = "\xAA\x55\x00\x00\x02\x00\x00";break;//AA 55 00 00 02 00 00
        case '0000040000': return $cmd = "\xAA\x55\x00\x00\x04\x00\x00";break;//AA 55 00 00 04 00 00
        case '0000080000': return $cmd = "\xAA\x55\x00\x00\x08\x00\x00";break;//AA 55 00 00 08 00 00
        case '0000100000': return $cmd = "\xAA\x55\x00\x00\x10\x00\x00";break;//AA 55 00 00 10 00 00
        case '0000200000': return $cmd = "\xAA\x55\x00\x00\x20\x00\x00";break;//AA 55 00 00 20 00 00
        case '0000400000': return $cmd = "\xAA\x55\x00\x00\x40\x00\x00";break;//AA 55 00 00 40 00 00
        case '0000800000': return $cmd = "\xAA\x55\x00\x00\x80\x00\x00";break;//AA 55 00 00 80 00 00--
        case '0000000100': return $cmd = "\xAA\x55\x00\x00\x00\x01\x00";break;//AA 55 00 00 00 01 00
        case '0000000200': return $cmd = "\xAA\x55\x00\x00\x00\x02\x00";break;//AA 55 00 00 00 02 00
        case '0000000400': return $cmd = "\xAA\x55\x00\x00\x00\x04\x00";break;//AA 55 00 00 00 04 00
        case '0000000800': return $cmd = "\xAA\x55\x00\x00\x00\x08\x00";break;//AA 55 00 00 00 08 00
        case '0000001000': return $cmd = "\xAA\x55\x00\x00\x00\x10\x00";break;//AA 55 00 00 00 10 00
        case '0000002000': return $cmd = "\xAA\x55\x00\x00\x00\x20\x00";break;//AA 55 00 00 00 20 00
        case '0000004000': return $cmd = "\xAA\x55\x00\x00\x00\x40\x00";break;//AA 55 00 00 00 40 00
        case '0000008000': return $cmd = "\xAA\x55\x00\x00\x00\x80\x00";break;//AA 55 00 00 00 80 00--
        case '0000000001': return $cmd = "\xAA\x55\x00\x00\x00\x00\x01";break;//AA 55 00 00 00 00 01
        case '0000000002': return $cmd = "\xAA\x55\x00\x00\x00\x00\x02";break;//AA 55 00 00 00 00 02
        case '0000000004': return $cmd = "\xAA\x55\x00\x00\x00\x00\x04";break;//AA 55 00 00 00 00 04
        case '0000000008': return $cmd = "\xAA\x55\x00\x00\x00\x00\x08";break;//AA 55 00 00 00 00 08
        case '0000000010': return $cmd = "\xAA\x55\x00\x00\x00\x00\x10";break;//AA 55 00 00 00 00 10
        case '0000000020': return $cmd = "\xAA\x55\x00\x00\x00\x00\x20";break;//AA 55 00 00 00 00 20
        case '0000000040': return $cmd = "\xAA\x55\x00\x00\x00\x00\x40";break;//AA 55 00 00 00 00 40
        case '0000000080': return $cmd = "\xAA\x55\x00\x00\x00\x00\x80";break;//AA 55 00 00 00 00 80--
        //获取反馈end
        //板子拨码开关设定地址为00的命令end

        default: return $cmd = 'cmd error';break;
    }
}
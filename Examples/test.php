<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sileno Brito
 * Date: 17/03/2018
 * Time: 19:46
 */

$dir = __DIR__;
require_once $dir . '/../Model/Event.php';
require_once $dir . '/../Model/Parameter.php';
require_once $dir . '/../Service/NotificationService.php';
require_once $dir . '/../Service/PabxNotificationService.php';

use I9Corp\HookPabxBundle\Service\PabxNotificationService;

$hookApiSecret = '79Bu40eb8eGMp5PJ3y3dUJWhLFM61ldq9jP1x8eBT26loTnUgVB1Y2PI+yae9+O6mSEkba9F9TdBw/0Guf2HtQ==';
$channel = 'vQ5cdYjMr2QCBElN26MqS+Qup4sX1PAEYTXjWiggYATEN1p1GDN3y4hkJ7s1nP2LLEhBQ5cyRdWo7lx8KRIc5g==';
$date = date('Y-m-d H:i:s');
$uniqueId = '12456789.0032';
$tmp = new PabxNotificationService();
$meta = 12;
echo $tmp->notifyInternalDial($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', $date, $meta) . "\r\n";
echo $tmp->notifyOutgoingDial($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', $date, $meta) . "\r\n";
echo $tmp->notifyAnswer($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', $date, 10, $meta, PabxNotificationService::TYPE_INCOMING) . "\r\n";
echo $tmp->notifyHangup($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', $date, 15, $meta) . "\r\n";
echo $tmp->notifyIncoming($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', $date, $meta, 11) . "\r\n";
echo $tmp->notifyTransfer($hookApiSecret, $channel, $uniqueId, '8867', '199987654321', '700', $date, $meta) . "\r\n";
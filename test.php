<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sileno Brito
 * Date: 17/03/2018
 * Time: 19:46
 */

$dir = __DIR__;
require_once $dir . '/Model/Event.php';
require_once $dir . '/Model/Parameter.php';
require_once $dir . '/Service/NotificationService.php';
require_once $dir . '/Service/PabxNotificationService.php';

use I9Corp\HookPabxBundle\Service\PabxNotificationService;

$hookApiSecret = '123';
$channel = '13';
$date = date('Y-m-d H:i:s');
$tmp = new PabxNotificationService();
$tmp->notifyAnswer($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, 10, null, PabxNotificationService::TYPE_INCOMING);
$tmp->notifyBusy($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, 11, null, PabxNotificationService::TYPE_INCOMING);
$tmp->notifyHangup($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, 15, null);
$tmp->notifyIncoming($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, null, 11);
$tmp->notifyInternalDial($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, 10);
$tmp->notifyOutgoingDial($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', $date, 10);
$tmp->notifyTransfer($hookApiSecret, $channel, '123456789.0009', '8867', '199987654321', '700', $date, null);
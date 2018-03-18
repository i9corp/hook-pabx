<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sileno Brito
 * Date: 17/03/2018
 * Time: 18:39
 */

namespace I9Corp\HookPabxBundle\Service;


use I9Corp\HookPabxBundle\Model\Event;
use I9Corp\HookPabxBundle\Model\Parameter;

class PabxNotificationService extends NotificationService
{
    const TYPE_INCOMING = 'incoming';
    const TYPE_INTERNAL = 'internal';
    const TYPE_OUTGOING = 'outgoing';


    public function notifyInternalDial($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta)
    {
        return $this->notifyDial($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta, self::TYPE_INTERNAL);
    }

    public function notifyOutgoingDial($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta)
    {
        return $this->notifyDial($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta, self::TYPE_OUTGOING);
    }

    private function notifyDial($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta, $type)
    {
        $parameters = array(
            new Parameter('unique_id', $uniqueId),
            new Parameter('source', $source),
            new Parameter('destination', $destination),
            new Parameter('date', $dateStart),
            new Parameter('type', $type),
            new Parameter('meta', $meta)
        );
        $event = new Event('dial', $parameters);
        return $this->send($hookApiSecret, $channel, $event);
    }

    public function notifyIncoming($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateStart, $meta, $trunk)
    {
        $parameters = array(
            new Parameter('unique_id', $uniqueId),
            new Parameter('source', $source),
            new Parameter('destination', $destination),
            new Parameter('date', $dateStart),
            new Parameter('type', self::TYPE_INCOMING),
            new Parameter('trunk', $trunk),
            new Parameter('meta', $meta)
        );
        $event = new Event('incoming', $parameters);
        return $this->send($hookApiSecret, $channel, $event);
    }

    public function notifyAnswer($hookApiSecret, $channel, $uniqueId, $source, $destination, $dateAnswer, $wait, $meta, $type)
    {
        $parameters = array(
            new Parameter('unique_id', $uniqueId),
            new Parameter('source', $source),
            new Parameter('destination', $destination),
            new Parameter('date', $dateAnswer),
            new Parameter('wait', $wait),
            new Parameter('type', $type),
            new Parameter('meta', $meta)
        );
        $event = new Event('answer', $parameters);
        return $this->send($hookApiSecret, $channel, $event);
    }

    public function notifyTransfer($hookApiSecret, $channel, $uniqueId, $source, $destination, $newDestination, $date, $meta)
    {
        $parameters = array(
            new Parameter('unique_id', $uniqueId),
            new Parameter('source', $source),
            new Parameter('destination', $destination),
            new Parameter('new_destination', $newDestination),
            new Parameter('date', $date),
            new Parameter('meta', $meta)
        );
        $event = new Event('transfer', $parameters);
        return $this->send($hookApiSecret, $channel, $event);
    }

    public function notifyHangup($hookApiSecret, $channel, $uniqueId, $source, $destination, $date, $reason, $meta)
    {
        $parameters = array(
            new Parameter('unique_id', $uniqueId),
            new Parameter('source', $source),
            new Parameter('destination', $destination),
            new Parameter('date', $date),
            new Parameter('reason', $reason),
            new Parameter('meta', $meta)
        );
        $event = new Event('hangup', $parameters);
        return $this->send($hookApiSecret, $channel, $event);
    }
}

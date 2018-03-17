<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sileno Brito
 * Date: 17/03/2018
 * Time: 18:30
 */

namespace I9Corp\HookPabxBundle\Service;


use I9Corp\HookPabxBundle\Model\Event;
use Exception;
use I9Corp\HookPabxBundle\Model\Parameter;

abstract class NotificationService
{
    const HOOK_URI = 'http://hook.i9corp.com.br/service/v1/handler/pabx';

    /**
     * @var string
     */
    private $lastResponse;
    /**
     * @var string
     */
    private $lastError;

    /**
     * @return string
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @return string
     */
    public function getLastError()
    {
        return $this->lastError;
    }

    final protected function send($hookApiSecret, $channel, Event $event)
    {
        try {
            $data = $this->prepare($channel, $event);
            $payload = json_encode($data);

            echo $payload. "\r\n\r\n";

            $ch = curl_init(self::HOOK_URI);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type:application/json',
                    'Authorization: Bearer ' . $hookApiSecret
                )
            );
            $this->lastResponse = curl_exec($ch);

            if ($this->lastResponse === false) {
                $this->lastError = curl_error($ch);
                curl_close($ch);
                return false;
            }

            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($http_status != '200') {
                return false;
            }
            return true;
        } catch (Exception $ex) {
            $this->lastError = $ex->getMessage();
            return false;
        }
    }

    /**
     * @param $token
     * @param Event $event
     * @return array
     * @throws Exception
     */

    final private function prepare($token, Event $event)
    {

        if (empty($token) || !$event->isValid()) {
            throw new Exception('Token is empty or event is invalid (check if name is empty or if no has parameters)');
        }
        $parameters = array();
        foreach ($event->getParameters() as $p) {
            if (!$p instanceof Parameter) {
                continue;
            }
            $parameters[$p->getName()] = $p->getValue();
        }

        $out = array(
            'token' => $token,
            'name' => $event->getName(),
            'parameters' => $parameters
        );
        return $out;
    }

}
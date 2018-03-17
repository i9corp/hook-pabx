<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sileno Brito
 * Date: 17/03/2018
 * Time: 18:31
 */

namespace I9Corp\HookPabxBundle\Model;


class Event
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $parameters;

    /**
     * Event constructor.
     * @param string $name
     * @param array $parameters
     */
    public function __construct($name = null, $parameters = array())
    {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Event
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function isValid()
    {
        if (empty($this->name) || !is_array($this->parameters) || empty($this->parameters)) {
            return false;
        }
        return true;
    }
}
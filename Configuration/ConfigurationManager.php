<?php

namespace Coo\FriendshipBundle\Configuration;

/**
* @author Florent Mondoloni
*/
class ConfigurationManager
{
    private $configs;

    /**
    * __construct
    *
    * @param array $configs
    */
    public function __construct($configs = array())
    {
        $this->configs = $configs;
    }

    /**
    * getValue
    *
    * @param string $configurationName
    */
    public function getValue($configurationName)
    {
        return $this->configs[$configurationName];
    }
}
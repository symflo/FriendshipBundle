<?php

namespace Coo\FriendshipBundle\Decorator;

use Coo\FriendshipBundle\Configuration\ConfigurationManager;
use Coo\FriendshipBundle\Provider\ShipProviderInterface;
use Coo\FriendshipBundle\Manager\WorkflowInterface;

/**
 * EntityDecorator
 *
 * @author Florent Mondoloni
 */
class EntityDecorator
{
    private $entityClassFrom;
    private $entityClassTo;
    private $entity;
    private $provider;
    private $fallback;
    private $workflow;

    /**
     * __construct
     * @param ShipProviderInterface $provider define in config (compilerpass?)
     * @param ShipProviderInterface $fallback define in config (compilerpass?)
     */
    public function __construct(ShipProviderInterface $provider, ShipProviderInterface $fallback, WorkflowInterface $workflow)
    {
        $this->provider = $provider;
        $this->fallback = $fallback;
        $this->workflow = $workflow;
    }

    /**
     * setter Entity
     * 
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        if (!$entity instanceof $this->entityClassFrom) {
            throw new Exception(sprintf("The %s is not supported for this relation"), 1);
        }

        $this->entity = $entity;
        return $this;
    }

    /**
     * getter Entity
     * maybe serve when you are conflict with __call method of 
     * this decorator and of your entity 
     * 
     * @return mixed $entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * setter EntityClassFrom
     * 
     * @param string $class
     */
    public function setEntityClassFrom($class)
    {
        $this->entityClassFrom = $class;
    }

    /**
     * setter EntityClassTo
     * 
     * @param string $class
     */
    public function setEntityClassTo($class)
    {
        $this->entityClassTo = $class;
    }

    /**
     * setter Provider
     * 
     * @param ShipProviderInterface $provider
     */
    public function setProvider(ShipProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * setter fallback
     * 
     * @param ShipProviderInterface $fallback
     */
    public function setFallback(ShipProviderInterface $fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * getProvider
     *
     * @return ShipProviderInterface
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * getWorkflow
     *
     * @return WorkflowInterface
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * callFromProvider
     * 
     * @param  ShipProviderInterface $provider
     * @param  string $method
     * @param  array $arguments
     * 
     * @return mixed
     */
    public static function callFromProvider($provider, $method, $arguments)
    {
        return call_user_func_array(array($provider, $method), $arguments);
    }

    /**
     * callFromEntity
     * 
     * @param  string $method
     * @param  array $arguments
     * 
     * @return mixed
     */
    public function callFromEntity($method, $arguments)
    {
        return call_user_func_array(array($this->entity, $method), $arguments);
    }

    /**
     * __call
     *
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, $arguments)
    {
        try {
            return $this->callFromEntity($name, $arguments);
        } catch (\Exception $e) {
            try {
                return self::callFromProvider($provider, $method, $arguments);
            } catch(\Exception $e) {
                return self::callFromProvider($fallback, $method, $arguments);

                throw $e;
            }
        }
    }
}
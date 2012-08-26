<?php

namespace Coo\FriendshipBundle\Manager;

use Coo\FriendshipBundle\Configuration\ConfigurationManager;
use Coo\FriendshipBundle\Decorator\EntityDecorator;

/**
 * RelationShipManager
 *
 * @author Florent Mondoloni
 */
class RelationShipManager
{
    private $cm;
    private $decorator;
    private $relation;

    /**
    * __construct
    *
    * @param array $configs
    */
    public function __construct(ConfigurationManager $configurationManager, EntityDecorator $decorator)
    {
        $this->cm = $configurationManager;
        $this->decorator = $decorator;
    }

    /**
     * getter Decorator
     * 
     * @return Decorator
     */
    public function getDecorator()
    {
        return $this->decorator;
    }

    /**
     * setter Relation
     * 
     * @param string $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
        $relations = $this->cm->getValue('relation');

        $this->decorator->setEntityClassFrom($relations[$relation]['entityFrom']);
        $this->decorator->setEntityClassTo($relations[$relation]['entityTo']);
    }

    /**
     * decorateCollection
     * 
     * @param Collection $coll
     */
    public function decorateCollection($coll)
    {
        return array_walk($coll, function($entity) use ($this->decorator) {
            $decoratorCopy = clone $this->decorator;
            return $decoratorCopy->setEntityFrom($entity);
        });
    }
}

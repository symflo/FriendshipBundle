<?php

namespace Coo\FriendshipBundle\Provider;

/**
 * ShipProviderInterface
 *
 * @author Florent Mondoloni
 */
interface ShipProviderInterface
{
    public function setEntity($entity);
    public function hasBeenRefusedBy($entity_id);
    public function hasRefused($entity_id);
    public function hasRelationWith($entity_id);
}
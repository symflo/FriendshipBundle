<?php

namespace Coo\FriendshipBundle\Manager;

/**
 * WorkflowInterface
 *
 * @author Florent Mondoloni
 */
interface WorkflowInterface
{
    public function createRelationTo($entity, $message);
    public function declineRelationFrom($entity);
    public function acceptRelationFrom($entity);
    public function deleteRelationFrom($entity);
}
<?php

namespace Coo\FriendshipBundle\Provider;

/**
 * FriendsProviderInterface
 *
 * @author Florent Mondoloni
 */
interface FriendsProviderInterface extends ShipProviderInterface
{
    public function getFriends();
    public function getFriendsIds();
    public function getFriendsOfFriendsIds($friends_ids = null);
    public function getFriendsPending();
    public function getFriendsIdsPending($with_sender = false);
    public function getFriendsIdsRefused($with_sender = false);
    public function getIsFriendWith($user_id);
    public function getIsFriendPendingWith($user_id);
    public function getPotentialContactsIds();
}
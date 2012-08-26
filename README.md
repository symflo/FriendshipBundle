CooFriendshipBundle
====================

# NOT USABLE, WORK IN PROGRESS.
====================

[![Continuous Integration status](https://secure.travis-ci.org/Coodit/FriendshipBundle.png)](http://travis-ci.org/Coodit/FriendshipBundle)

This bundle allows you to build and manage friendships between your project users.

**You are of course invited to [contribute](https://github.com/Coodit/FriendshipBundle/contributors) to this bundle! :)**

## Documentation

- **[Read Documentation](https://github.com/Coodit/FriendshipBundle/blob/master/Resources/doc/index.markdown)** (soon)

## License

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE


## Installation 


### Step 1: Add FriendshipBundle to your composer.json

```json
{
    "require": {
        "coo/friendship-bundle": "dev-master"
    }
}
```

### Step 2: Enable the bundle

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Coo\FriendshipBundle\CooFriendshipBundle(),
    );
}
?>
```

### Step 3: Configure the bundle

An example configuration:
```yml
coo_friendship:
	settings:
		storage: 'redis' 
		fallback: 'doctrine'
  	relation_ship:
		friends: 
			entityFrom: Entity/User
			entityTo: Entity/User
		partner: 
			entityFrom: Entity/User
			entityTo: Entity/Company
```

### Step4: Usage

```php
<?php
$rsm = $this->get('relation_ship_manager');
$rsm->setRelation('friends');
$user = $fm->getDecorator()->setEntity($user);

$user->hasRelationWith();
$friends = $user->getFriends();
?>
```

To transform your collection object with decorator you just have to:

```php
<?php
$rsm = $this->get('relation_ship_manager');
$rsm->setRelation('partner');
$usersDecorated = $rsm->decorateCollection($users);

foreach ($usersDecorated as $user) {
	$user->hasRelationWith($company);
}
?>
```

You can manage workflow ship like this:

```php
<?php
$rsm = $this->get('relation_ship_manager');
$rsm->setRelation('friends');
$fm->getDecorator()->setEntity($user);
$rsm->getWorkflow()->acceptRelationFrom($user);
?>
```
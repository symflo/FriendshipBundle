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


## Step 1: Add TrsteelCkeditorBundle to your composer.json

```json
{
    "require": {
        "coo/friendship-bundle": "dev-master"
    }
}
```

## Step 2: Enable the bundle

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

## Step 3: Configure the bundle

An example configuration:
```yml
coo_friendship:
	settings:
		base: 'redis' 
		fallback: 'doctrine'
  	relation_ship:
		friends: 
			entityFrom: ENtity/User
			entityTo: ENtity/User
		partner: 
			entityFrom: ENtity/User
			entityTo: ENtity/Company
```

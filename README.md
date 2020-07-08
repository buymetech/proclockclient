# Process lock client
## Usage
After installing:

 **1.** Create a Service provider for Laravel 4 like:

```php
<?php

namespace App\Providers;

use BuyMe\ProcLockClient\LockFactory;
use Illuminate\Support\ServiceProvider;

class ProcLockServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bindShared('proc-lock', function($app) {
            return new LockFactory($app['config']['app.procLockUrl']);
        });
    }
}
```
*Note: This library does not contain a service provider because of differences in syntax between Laravel 4 and newer versions* 

 **2.** Create a config for Process Lock server URL in accordance to the service provider. In our case it's `procLockUrl` inside `app/config/app.php`.
The format for url is `tcp://<ip>:<port>`. The default port is `30100`.

 **3.** Register the service provider in the `providers` array inside `app/config/app.php`:
```php
	'providers' => array(

         ...

        'App\Providers\ProcLockServiceProvider',
	),
```

 **4.** Add an alias for the ProcLock facade in the `aliases` array inside `app/config/app.php`:
```php
	'aliases' => array(

        ...

        'ProcLock' => 'BuyMe\ProcLockClient\Facade\ProcLock'
	),
```

 **5.** Use in the code:
```php
$lock = ProcLock::create('resource_to_lock');
$lock->lock();
/*
do work
*/
$lock->unlock();
```
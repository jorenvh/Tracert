# Tracert

Tracert is a package for Laravel to log actions of your users to your database.

## Installation

### Composer
You can require this package through composer, just run the following line in your terminal.

```php
composer require jorenvanhocht/tracert 1.3-beta
```

### Service Provider
Add the following line to the providers array in config/app.php

```php
'jorenvanhocht\Tracert\TracertServiceProvider',
```

If you want you can also add the facade to the aliases array in config/app.php

>**Note**: this is not required, you can make use of available helper method wich is faster.

```php
'Tracert'   => 'jorenvanhocht\Blogify\Facades\Tracert',
```

### Composer update
To be sure everything is loaded properly run ```composer update``` from your terminal.

### Publish config file
If you want you can publish the config file by running the following command from your terminal

```php
php artisan vendor:publish --tag="config"
```

### Migrations
This package contains a migration file to create the table where all actions will be logged into. Run it by the following command:

```php
php artisan migrate --path="vendor/jorenvanhocht/Tracert/database/Migrations"
```

## Configuration
When you have published the config file you can change the name of the database table where all actions will be logged into. 

The config file is located at config/Tracert.php.

## Usage

### Log an action

```php
tracert()->log('Model', 'row', 'user_id', 'Action');
```

### Retrieve actions for your activity feed
This package contains a model so you can just retrieve data like you would always do using Eloquent.

```php
use jorenvanhocht\Tracert\Models\History;

History::all();
History::whereUserId(1);
History::whereTable('table_name');

...

```
 
 ## Issues

 If you find any issues pleas report them so I can fix them.



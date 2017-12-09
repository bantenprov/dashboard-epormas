# Dashboard Epormas

[![Join the chat at https://gitter.im/dashboard-epormas/Lobby](https://badges.gitter.im/dashboard-epormas/Lobby.svg)](https://gitter.im/dashboard-epormas/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/dashboard-epormas/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/dashboard-epormas/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/bantenprov/dashboard-epormas/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
Epormas dashboard repository

## TO DO :
Package for Dashboard Pimpinan
==============================

## Install
Via composer
``` bash
$ composer require bantenprov/dashboard-epormas "1.0.0"
```

## 1. In your config/app.php add for laravel 5.4:

``` php
'providers' => array(
    ...
    Bantenprov\DashboardEpormas\EpormasServiceProvider::class,
),
```

## 2. php artisan
``` bash
$ php artisan dashboard:epormas
$ php artisan vendor:publish --tag=views
$ php artisan vendor:publish --tag=migrations
```

in your `database/seeds/DatabaseSeeder.php` add this code in `run` function
``` php
$this->call('EpormasCounterTableSeeder');
$this->command->info('EpormasCounter table seeded!');

$this->call('EpormasCityTableSeeder');
$this->command->info('EpormasCity table seeded!');

$this->call('EpormasCategoryTableSeeder');
$this->command->info('EpormasCategory table seeded!');
```

in your `resources/assets/routes.js` add this code in `const routes`
``` php

const routes = [{
  path: '/',
  component: resolve => require(['./layout.vue'], resolve),
  children: [
  ....  
  {
      path: 'dashboard/epormas',
      component: resolve => require(['./components/dashboard_epormas.vue'], resolve),
      meta: {
          title: "Dashboard Epormas",
      }
  }, {
      path: 'epormas',
      component: resolve => require(['./components/epormas_list.vue'], resolve),
      meta: {
          title: "Epormas",
      }
  },  {
      path: 'epormas/create',
      component: resolve => require(['./components/add_epormas.vue'], resolve),
      meta: {
          title: "Epormas",
      }
  },  {
      path: 'epormas/:id/edit',
      component: resolve => require(['./components/edit_epormas.vue'], resolve),
      meta: {
          title: "Epormas",
      }
  }, {
      path: 'epormas/:id/destroy',
      component: resolve => require(['./components/destroy.vue'], resolve),
      meta: {
          title: "Destroy",
      }
  },
  ....  
  ]
]},
....
```

in your `resources/assets/menu.js` add this code
``` php

{
    name: 'Dashboard',
    icon: 'ti-bar-chart',
    child: [
    ....
    {
        name: 'Epormas',
        link: '/dashboard/epormas',
        icon: 'ti-angle-double-right'
    },
    ....
  ]
},
....
{
    name: "Data Epormas",
    icon: "ti-files",
    child: [{
        name: 'list Epormas',
        link: '/epormas',
        icon: 'ti-angle-double-right'
    }]
},
....
```

## 3. Migrate Database and npm run dev
``` bash
$ composer dump-autoload
$ php artisan migrate --seed
$ npm run dev
```
## DEMO :
## CHANGELOG :

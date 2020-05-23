# PHP iiko biz API

A simple Object Oriented wrapper for iiko API, written with PHP.

Uses [iiko API v0](https://ru.iiko.help/articles/#!api-documentations/iiko-biz).

## Features

* Light and fast thanks to lazy loading of API classes

## Requirements

* PHP >= 7.2

## Install

Via Composer:

```bash
$ composer require andriymiz/iiko-biz-api
```

In Laravel:

Publish config file
```bash
$ php artisan vendor:publish --provider="Iiko\Biz\IikoBizServiceProvider"
```

Or in .env file
```env
IIKO_BIZ_API_BASE_URI=https://iiko.biz:9900/api/0/
IIKO_BIZ_USER_ID=demoDelivery
IIKO_BIZ_USER_SECRET=PI1yFaKFCGvvJKi
```

## Basic usage of `iiko-biz-api` client

```php
<?php

use Iiko\Biz\Client as IikoClient;

$iiko = new IikoClient([
    'user_id' => 'demoDelivery',
    'user_secret' => 'PI1yFaKFCGvvJKi',
]);

// In Laravel
$iiko = app('iiko');

$organization = $iiko->OrganizationsApi()->getList()[0];

$menu = $iiko->NomenclatureApi()->getMenu($organization['id']);
$canCreateOrder = $iiko->OrdersApi()->checkAddress($organization['id'], [
    "city" => "Москва",
    "street" => "Планетарная",
    "home" => "1"
]);
$cities = $iiko->CitiesApi()->getCitiesWithStreets($organization['id']);
$order = $iiko->OrdersApi()->addOrder([
    'organization' => $organization['id'],
    'customer' => ['name' => 'test', 'phone' => 'Phone'],
    'order' => ['phone' => 'Phone'],
    'items' => ['id' => 'uuid', 'amount' => 1],
]);
$deliveryOrders = $iiko->OrdersApi()->getDeliveryOrders($organization['id'], [
    'dateFrom' => '2020-04-09',
    'dateTo' => '2020-04-09',
]);
$protocols = $iiko->SettingsApi()->getSupportedProtocols($organization['id']);
$discounts = $iiko->DeliverySettingsApi()->getDeliveryDiscounts($organization['id']);

```

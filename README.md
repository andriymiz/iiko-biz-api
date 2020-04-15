# PHP iiko biz API

A simple Object Oriented wrapper for iiko API, written with PHP.

Uses [iiko API v0](https://ru.iiko.help/articles/#!api-documentations/iiko-biz).

## Features

* Light and fast thanks to lazy loading of API classes

## Requirements

* PHP >= 7.3

## Install

Via Composer:

```bash
$ composer require andriymiz/iiko-biz-api
```

## Basic usage of `iiko-biz-api` client

```php
<?php

use Iiko\Biz\Client as IikoClient;

$iiko = new IikoClient([
    'user_id' => 'demoDelivery',
    'user_secret' => 'PI1yFaKFCGvvJKi',
]);

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
]);
$deliveryOrders = $iiko->OrdersApi()->getDeliveryOrders($organization['id'], [
    'dateFrom' => '2020-04-09',
    'dateTo' => '2020-04-09',
]);
$protocols = $iiko->SettingsApi()->getSupportedProtocols($organization['id']);
$discounts = $iiko->DeliverySettingsApi()->getDeliveryDiscounts($organization['id']);

```

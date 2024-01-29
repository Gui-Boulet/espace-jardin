<?php

use App\Router;

# Inclu le fichier autoload.php
require  dirname(__DIR__) . '/vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__) . '/views');
$router
  #->get('/fill', 'command/fill', 'fill')
  ->get('/', 'access/index', 'home')
  ->post('/actions-insert', 'access/actions/insert', 'actions_insert')
  ->getAndPost('/login', 'access/login', 'login')
  ->post('/logout', 'access/logout', 'logout')
  ->get('/account', 'user/account', 'account')
  ->get('/admin-interventions', 'admin/interventions', 'admin_interventions')
  ->get('/admin-customers', 'admin/customers', 'admin_customers')
  ->get('/admin-services', 'admin/services', 'admin_services')
  ->post('/admin-actions-create', 'admin/actions/create', 'admin_actions_create')
  ->post('/admin-actions-delete', 'admin/actions/delete', 'admin_actions_delete')
  ->post('/admin-actions-update', 'admin/actions/update', 'admin_actions_update')
  ->run();
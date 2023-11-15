<?php

use App\Router;

# Inclu le fichier autoload.php
require  dirname(__DIR__) . '/vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__) . '/views');
$router
  ->get('/', 'access/index', 'home')
  ->get('/login', 'access/login', 'login')
  ->get('/account', 'user/account', 'account')
  ->get('/admin-interventions', 'admin/interventions', 'admin_interventions')
  ->get('/admin-customers', 'admin/customers', 'admin_customers')
  ->get('/admin-services', 'admin/services', 'admin_services')
  ->post('/admin-actions-delete', 'admin/actions/delete', 'admin_actions_delete')
  ->post('/admin-actions-edit', 'admin/actions/edit', 'admin_actions_edit')
  ->run();
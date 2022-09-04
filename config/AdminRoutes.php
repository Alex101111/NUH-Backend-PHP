<?php

use App\Controller\UserController\QuoteController;
use App\Controller\AdminController\CommandesController;
use App\Controller\AdminController\UserController;
use App\Controller\{TrackingController, ContactController};



$router->map('GET|POST', '/contact-us', function() {
  $ContactController= new ContactController();
  $ContactController->contactUs();
});


$router->map('GET|POST', '/check-user-status', function() {
  $TrackingController= new TrackingController();
  $TrackingController->checkUserInfo();
});


$router->map('GET|POST', '/set-quote', function() {
    $QuoteController= new QuoteController();
    $QuoteController->setQuote();
  });

  $router->map('GET|POST', '/admin/users/all', function() {
    $UserController= new UserController();
    $UserController->showAll();
  });

  $router->map('GET|POST', '/admin/users/[:id]', function(int $id) {
    $UserController= new UserController();
    $UserController->showById($id);
  });

  $router->map('GET|PUT', '/admin/users/edit/[:id]', function(int $id) {
    $UserController= new UserController();
    $UserController->editUser($id);
  });

  $router->map('GET|POST', '/admin/users/delete/[:id]', function(int $id) {
    $UserController= new UserController();
    $UserController->delete($id);
  });

  // $router->map('GET|POST', '/admin/users/edit/[:id]', function(int $id) {
  //   $UserController= new UserController();
  //   $UserController->showById($id);
  // });


  $router->map('GET|POST', '/admin/orders/all', function() {
    $CommandesController= new CommandesController();
    $CommandesController->showAllCommandes();
  });

  $router->map('GET|POST', '/admin/orders/[:id]', function(int $id) {
    $CommandesController= new CommandesController();
    $CommandesController->showCommandById($id);
  });

  $router->map('GET|PUT', '/admin/orders/edit/[:id]', function(int $id) {
    $CommandesController= new CommandesController();
    $CommandesController->editCommand($id);
  });

  $router->map('GET|POST', '/admin/orders/delete/[:id]', function(int $id) {
    $CommandesController= new CommandesController();
    $CommandesController->deleteCommand($id);
  });
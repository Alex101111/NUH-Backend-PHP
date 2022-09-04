<?php

use App\Controller\{TrackingController, ContactController};
use App\Controller\UserController\QuoteController;


$router->map('GET|POST', '/contact-us', function() {
  $ContactController= new ContactController();
  $ContactController->contactUs();
});

$router->map('GET|POST', '/set-quote', function() {
  $QuoteController= new QuoteController();
  $QuoteController->setQuote();
});

$router->map('GET|POST', '/check-user-status', function() {
  $TrackingController= new TrackingController();
  $TrackingController->checkUserInfo();
});



// $router->map('GET', '/visitor/blog', function() {
//   $articleController = new ArticleController();
//   $articleController->index();
// });
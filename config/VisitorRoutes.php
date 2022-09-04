<?php

use App\Controller\AuthController\{SigninController, SignupController, ValidationController, ResetPasswordController };
use App\Controller\{TrackingController, ContactController}   ;


$router->map('GET|POST', '/contact-us', function() {
  $ContactController= new ContactController();
  $ContactController->contactUs();
});

  $router->map('GET|POST', '/user/signin', function() {
    $signinController= new SigninController();
    $signinController->signIn();
});

$router->map('GET|POST', '/signup', function() {
  $signupController= new SignupController();
  $signupController->signUp();
});

$router->map('GET|POST', '/validation', function() {
  $ValidationController= new ValidationController();
  $ValidationController->ValidateEmail();
});

$router->map('GET|POST', '/Password-reset', function() {
  $ForgetPassword= new ForgetPassword();
  $ForgetPassword->SendResetLink();
});


$router->map('GET|POST', '/Password-reset', function() {
  $ResetPasswordController= new ResetPasswordController();
  $ResetPasswordController->PasswordReset();
});


$router->map('GET|POST', '/check-user-status', function() {
  $TrackingController= new TrackingController();
  $TrackingController->checkUserInfo();
});


$router->map('GET|POST', '/sendLink', function() {
  $ResetPasswordController= new ResetPasswordController();
  $ResetPasswordController->SendResetLink();
});

$router->map('GET|POST', '/resetPassword', function() {
  $ResetPasswordController= new ResetPasswordController();
  $ResetPasswordController->PasswordReset();
});


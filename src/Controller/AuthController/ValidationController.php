<?php

namespace App\Controller\AuthController;

use App\Dao\UserDao;

class ValidationController
{

    public function ValidateEmail()
    {

        $data = json_decode(file_get_contents("php://input"), true);
        if($data){
        $activeCode = $data['activeCode'];

        $userDao = new UserDao;

        if (!empty($userDao->checkUserStatus($activeCode))) {

            $userDao->activateUser($activeCode);

            echo json_encode(['success' => 'Thank You For Validating Your Email']);
        } else {

            echo json_encode(['error' => 'Something Went Wrong']);
        }

    }else{
        echo json_encode(['error' => 'Something Went Wrong']);
    }
}
}

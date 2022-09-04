<?php

namespace App\Controller\AuthController;

use App\Dao\UserDao;
use Core\JsonWebToken;

// use Firebase\JWT\Key;

class SigninController
{
    public function signIn()
    {
        // echo json_encode(var_dump(session_id()));

        $args = [
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL
            ],
            'password' => [],
        ];

        // getting the data from the front part
        $data = json_decode(file_get_contents("php://input"), true);

        $user_input = filter_var_array($data, $args);
        $userDao = new UserDao();
        $user = $userDao->getUserByEmail($user_input['email']);

        if (!isset($user)) {
            $error_messages = 'the email does not exist, please create an account to be able to log in ';
        } else {

            if (!$user->verifyPwd($user_input['password'])) {
                $error_messages = 'you have inserted a wrong password, check your password and try again ';

            } else {

                if (!$user->getActive()) {
                    $error_messages = 'please activate your account before you sign in ';
                } else {

                    $user->erasePwd();
                    $headers = array('alg' => 'HS256', 'typ' => 'JWT');

                    $username = $user->getName();
                    $userId = $user->getIdUser();
                    $userIsAdmin = $user->getIsAdmin();
                    $email = $user->getEmail();
                    $active = $user->getActive();
                    $date = time();

                    $payload = array('sub' => '248289761001', 'iat' => $date, 'exp' => (time() + 60 * 60),
                        'data' => array(
                            "username" => $username,
                            "user_id" => $userId,
                            "user_role" => $userIsAdmin,
                            "email" => $email,
                            "is_active" =>$active
                        ));

                    $token = new JsonWebToken();

                    $jwt = $token->generate_jwt($headers, $payload);

                }
            }

        }

        if (!isset($error_messages)) {
            echo json_encode(

                [
                    "message" => "Successful login.",
                    "token" => $jwt,
                    "ussername" => $username,

                ]

            );
        } else {

            echo json_encode([
                "error_messages" => array(
                    "danger" => $error_messages,
                ),
            ]);
        }
    }

}

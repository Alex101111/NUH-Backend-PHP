<?php

namespace App\Controller\AuthController;

use App\Dao\UserDao;
use App\Model\User;

class ResetPasswordController
{

    public function SendResetLink()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data['email'];

        $userDao = new UserDao();

        $user = $userDao->getUserByEmail($email);
        $id = $user->getIdUser();
        $password_reset = $userDao->getPasswordId($id);
        $password_id = $password_reset['password_reset_id'];


        if (isset($id) && isset($password_id)) {
            $message = nl2br("
                        Hello \n
                        Here is the link to reset your password . \n  :<a href='http://nuhlogistics.com/Password-reset?id=$password_id' title='My Page'>My Page</a>");
            mail($email, "Password Reset Link", $message, 'From: info@nuhlogistics.com');
            echo json_encode($password_id . 'Check Your Inbox For The Link To Reset Your Password');
        } else {

            echo json_encode('This Acount does not exist');
        }

    }

    public function PasswordReset()
    {
        $args = [

            'password' => [],
            'password2' => [],
        ];

        $data = json_decode(file_get_contents("php://input"), true);

        $user_input = filter_var_array($data, $args);

        $password_id = $_GET['id'];

    
        if (empty($user_input['password']) || empty($user_input['password2'])) {

            $error_messages[] = 'please fill in all the required champs to reset your password';

        } else {
            if (($user_input['password']) === ($user_input['password2'])) {

                $userDao = new UserDao();
                $user_id = $userDao->getUserByPasswordId($password_id);
                if (isset($user_id)) {
                    $user = new User();
                    $id_user =$user_id['id_user'];
                    $pass=$user_input['password'];
                $user->setHashPwd($pass);
                
          
                    $userDao->updatePassword($id_user, $user);

                    $success_message = 'Your Password Has Been Reset';
                } else {
                    $error_messages = 'Failed Password Reset';
                }
            }else{
                $error_messages = 'Password and Password confitmation should be identical';
            }
        }

        if (!isset($error_messages)) {

            echo json_encode([
                $success_message
            ]);
        } else {

            echo json_encode([
                $error_messages
            ]);

        }

    }
}

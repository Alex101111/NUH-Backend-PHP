<?php
namespace App\Controller\AuthController;

use App\Dao\UserDao;
use App\Model\Password_reset;
use App\Model\User;

class SignupController
{
    public function SignUp()
    {
        $args = [
            'name' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            ],
            'surname' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            ],
            'email' => [
                'filter' => FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL,
            ],
            'phone_number' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_INT,
            ],
            'country_code' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_INT,
            ],
            'password' => [],
            'password2' => [],
        ];

        // getting the data from the front part
        $data = json_decode(file_get_contents("php://input"), true);
        // function filter input array used aplicate the args variale to sanatize and filter the encoded json data
        $user_input = filter_var_array($data, $args);
        if (empty($user_input['name']) || empty($user_input['surname']) || empty($user_input['email'])
            || empty($user_input['password']) || empty($user_input['password2'])
            || empty($user_input['phone_number']) || empty($user_input['country_code'])) {

            $error_messages[] = 'please fill in all the required champs to complete registeration';

        } else {
            $userDao = new UserDao();

            // check if the email already exist in the database ;
            $userEmail = $userDao->getUserByEmail($user_input['email']);
            if (!empty($userEmail)) {
                $error_messages[] = 'this email already exist , please sign in';
            } else {
                $user = new User();
                $user->setName($user_input['name'])
                    ->setSurname($user_input['surname'])
                    ->setEmail($user_input['email'])
                    ->setPhoneNumber($user_input['phone_number'])
                    ->setCountry_code($user_input['country_code'])
                    ->setHashPwd($user_input['password'])
                // using this function to set a random activation code
                    ->setActivationCode()
                    ->setActive(0);

                $password_reset = new Password_reset();
                $Password_reset_id = substr(md5(time()), 0, 11);
                $password_reset->setPassword_reset_id($Password_reset_id);
                $regersterUser = $userDao->regersterUser($user, $password_reset);
                if ($regersterUser) {
                    $user->erasePwd();
                    $activeCode = $user->getActivationCode();

                    $status = $user->getActive();
                    $message = nl2br("
                        Hello" . $user_input['name'] . " \n
                        welcome to our website and thank you for joining NUH family.\n Here is your validation link  :<a href='http://nuhlogistics.com/validation?activeCode=$activeCode' title='My Page'>My Page</a>");

                    // after registering user we send an email to the user with the activation code in the link so he would validate the account
                    mail($user_input['email'], "verification Code", $message, 'From: info@nuhlogistics.com');
                    $success_message = 'thank you for registering in our website, a validation Email has been sent to ' . $user_input['email'] . '';
                    echo json_encode([
                        $success_message,
                    ]);
                } else {
                    $error_messages = 'user sign up failed ';
                    echo json_encode([
                        $regersterUser,
                    ]);
                }
            }

        }

        if (isset($error_messages)) {

            echo json_encode([
                "error_messages" => array(
                    "danger" => $error_messages,
                ),
            ]);

        }

    }

}

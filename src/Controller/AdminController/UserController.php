<?php
namespace App\Controller\AdminController;

use App\Dao\AdminUserDao;
use App\Model\User;

class UserController {


    public function showAll()
    {
        try {
            $AdminUserDao = new AdminUserDao();
            $users = $AdminUserDao->getAll();

            for ($i = 0; $i < count($users); $i++) {
                $users[$i] = $users[$i]->toArray();
            }

            header("Content-Type: application/json");
            echo json_encode($users);
        } catch (PDOException $e) {
            // TODO
        }
    }   

    public function showById($id)
    {
    
        $AdminUserDao = new AdminUserDao();
        $user = $AdminUserDao->getById($id);

        if (!is_null($user)) {
            $user = $user->toArray();
        }

        header("Content-Type: application/json");
        echo json_encode($user);
    }


    public function editUser(int $id){
        $args = [
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL
            ],

            'phone_number' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'country_code' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'is_admin' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'active' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'name' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'surname' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
        ];

        $data = json_decode(file_get_contents('php://input'), true);
        $user_input = filter_var_array($data, $args);
        if (empty($user_input['email']) || empty($user_input['phone_number'])
        || empty($user_input['country_code']) || empty($user_input['name'])
        || empty($user_input['surname']) ) {
            
        $error_messages[] = 'please fill in all the required champs';
        }

        if (!isset($error_messages)) {
            $User = new User;

            $User ->setName($user_input['name'])
            ->setSurname($user_input['surname'])
            ->setEmail($user_input['email'])
            ->setPhoneNumber($user_input['phone_number'])
            ->setIsAdmin($user_input['is_admin'])
            ->setActive($user_input['active'])
            ->setCountry_code($user_input['country_code']);
        
            $AdminUserDao = new AdminUserDao();
            $AdminUserDao->editUser($User, $id);


            echo json_encode([
                'the User information has been updated successfully ',
            ]);
        } else {
            echo json_encode([
                "error_messages" => array(
                    "danger" => $error_messages,
                ),
            ]);

        }
    }
    
    public function delete($id)
    {


        $data = json_decode(file_get_contents('php://input'), true);
        $AdminUserDao = new AdminUserDao();
        $AdminUserDao->deleteUser($id);
        echo json_encode([
            'the User account has been deleted successfully ',
        ]);
    }
}
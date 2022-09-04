<?php
namespace App\Dao;

use App\Model\Password_reset;
use App\Model\User;
use Core\AbstractDao;
use PDO;

class UserDao extends AbstractDao
{
    public function regersterUser(User $user, Password_reset $password_reset)
    {
        try {

            $sth = $this->dbh->prepare("INSERT INTO `user` (name, surname, email, phone_number, password, activation_code, country_code) VALUES
                                               (:name, :surname, :email, :phone_number, :password, :activation_code, :country_code)");

            $sth->execute([':name' => $user->getName(),
                ':surname' => $user->getSurname(),
                ':email' => $user->getEmail(),
                ':phone_number' => $user->getPhoneNumber(),
                ':password' => $user->getPassword(),
                ':activation_code' => $user->getActivationCode(),
                'country_code' => $user->getCountry_code()]);

            $user_Id = $this->dbh->lastInsertId();

            $sth = $this->dbh->prepare("INSERT INTO `password_reset` (id_user, password_reset_id) VALUES
        (:id_user, :password_reset_id)");

            $sth->execute([':id_user' => $user_Id,
                ':password_reset_id' => $user_Id . $password_reset->getPassword_reset_id()]);

                return true ;
        } catch (PDOException $e) {

            $e->getMessage();
            die($e->getMessage());
            return false;
        }
    }
    // public function regesterUserPasswordReset($user)
    // {
    //     $sth = $this->dbh->prepare("INSERT INTO `password_reset` (id_user, password_reset_id) VALUES
    //                                                            (:id_user, :password_reset_id)");

    //     $sth->execute([':id_user' => $user->getUserId(),
    //         ':password_reset_id' => $user->getPassword_reset_id()]);
    // }

    public function getUserByEmail(string $email): ?User
    {
        $sth = $this->dbh->prepare('SELECT * FROM user WHERE email = :email');
        $sth->execute([':email' => $email]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        $u = new User();
        return $u->setIdUser($result['id_user'])
            ->setName($result['name'])
            ->setSurname($result['surname'])
            ->setpassword($result['password'])
            ->setEmail($result['email'])
            ->setPhoneNumber($result['phone_number'])
            ->setIsAdmin($result['is_admin'])
            ->setActive($result['active'])
            ->setActivationCode($result['activation_code'])
            ->setCreatedAt($result['created_at'])
            ->setCountry_code($result['country_code']);

    }

    public function checkUserStatus($activeCode)
    {
        $sth = $this->dbh->prepare('SELECT * FROM `user` WHERE active = 0 AND activation_code = :activation_code');
        $sth->execute([':activation_code' => $activeCode]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return null;
        }

        return $result;

    }

    public function activateUser($activeCode): void
    {
        $sth = $this->dbh->prepare("UPDATE `user` SET active = 1 WHERE activation_code = :activation_code");
        $sth->execute([':activation_code' => $activeCode]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserHashByEmail($email)
    {
        $sth = $this->dbh->prepare("SELECT password FROM `user` WHERE email = :email");
        $sth->execute([':email' => $email]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return null;
        }

        return $result;
    }

    public function updatePassword($id_user, $user)
    {
        $sth = $this->dbh->prepare("UPDATE user SET `password` = :newPassword WHERE id_user = :id_user");
        $sth->execute([':id_user' => $id_user,
                      ':newPassword' => $user->getPassword()]);

    }

    public function getPasswordId($id_user){
        $sth = $this->dbh->prepare("SELECT * FROM `password_reset` WHERE id_user = :id_user");
        $sth->execute([':id_user' => $id_user]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return null;
        }

        return $result;
    }

    public function getUserByPasswordId($password_id){
        $sth = $this->dbh->prepare("SELECT * FROM `password_reset`
                           WHERE password_reset_id = :password_reset_id
        "); 
                $sth->execute([':password_reset_id' => $password_id]);
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                if (empty($result)) {
                    return null;
                }
        
             else   return $result;
    }
}

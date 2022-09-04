<?php

namespace App\Dao;

use PDO;
use Core\AbstractDao;
use App\Model\User;

class AdminUserDao extends AbstractDao
{


    public function getAll(): array
    {
        $sth = $this->dbh->prepare("SELECT id_user, name, surname, email, phone_number, is_admin, active, created_at, country_code FROM `user`");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $a = new User();
            $result[$i] = $a->setIdUser($result[$i]['id_user'])
                ->setName($result[$i]['name'])
                ->setSurname($result[$i]['surname'])
                ->setEmail($result[$i]['email'])
                ->setPhoneNumber($result[$i]['phone_number'])
                ->setIsAdmin($result[$i]['is_admin'])
                ->setActive($result[$i]['active'])
                ->setCreatedAt($result[$i]['created_at'])
                ->setCountry_code($result[$i]['country_code']);
        }

        return $result;
    }


    public function getById(int $id): ?User
    {
        $sth = $this->dbh->prepare("SELECT * FROM `user` WHERE id_user = :id_user");
        $sth->execute([":id_user" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return null;
    
        $a = new User();
       return $a->setIdUser($result['id_user'])
        ->setName($result['name'])
        ->setSurname($result['surname'])
        ->setEmail($result['email'])
        ->setPhoneNumber($result['phone_number'])
        ->setIsAdmin($result['is_admin'])
        ->setActive($result['active'])
        ->setCreatedAt($result['created_at'])
        ->setCountry_code($result['country_code']);

     
    }


    public function editUser($User, $id): void 
    {
        $sth = $this->dbh->prepare(
            "UPDATE `user` SET name = :name, surname = :surname, email = :email, phone_number = :phone_number, is_admin = :is_admin, active = :active, country_code = :country_code   WHERE id_user = :id_user" 
        );  
        $sth->execute([
            ":id_user" => $id,
            ':email'=>$User->getEmail(),
            ':name' =>$User->getName(),
            ':surname' =>$User->getSurname(),
            ':phone_number'=>$User->getPhoneNumber(),
            ':is_admin'=>$User->getIsAdmin(),
            ':active'=>$User->getActive(),
            ':country_code'=>$User->getCountry_code(),

        ]);
    }



    public function deleteUser(int $id): void
    {
        $sth = $this->dbh->prepare("DELETE FROM `user` WHERE id_user = :id_user");
        $sth->execute([":id_user" => $id]);
    }

}
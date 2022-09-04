<?php

namespace App\Dao;
use PDO;
use Core\AbstractDao;
use App\Model\User;


class QuoteTransactionDao extends AbstractDao

{
    public function QuoteTransaction($infos,$mesures,$user,$commande)
    {
        try {
          $this->dbh->beginTransaction();

           $sth=$this->dbh->prepare("INSERT INTO `infos`(transport_type,departure,destination,container_type,commentary)
                                        VALUES    (:transport_type,:departure,:destination,:container_type,:commentary)");
           $sth->execute([':transport_type' =>$infos->getTransportType(),
                         ':departure' =>$infos->getDeparture(),
                         ':destination'=>$infos->getDestination(),
                          ':container_type'=>$infos->getContainerType(),
                          ':commentary'=>$infos->getCommentary()
                        ]);
           $idInfos=$this->dbh->lastInsertId();
           $sth=$this->dbh->prepare("INSERT INTO `mesures`(length,height,width,net_weight,gross_weight) VALUES (:length,:height,:width,:net_weight,:gross_weight)");
           $sth->execute(['length'=>$mesures->getLength(),
                          ':height' =>$mesures->getHeight(),
                          ':width' =>$mesures->getWidth(),
                          ':net_weight'=>$mesures->getNetWeight(),
                          ':gross_weight'=>$mesures->getGrossWeight(),
        ]);
            $idMesures=$this->dbh->lastInsertId();
  
           

        $sth= $this->dbh->prepare("INSERT INTO `commandes` (tracking_number) VALUES(:tracking_number)");

        $sth->execute([":tracking_number"=> $commande->getTrackingNumber()
     ]);
        $idCommande = $this->dbh->lastInsertId();
        
        $sth= $this->dbh->prepare("INSERT INTO `quote` (id_user,id_mesures,id_infos,id_command) 
                                    VALUES(:id_user,:id_mesures,:id_infos,:id_commande)");

        $sth->execute([":id_user"=> $user->getIdUser(),
                       ":id_mesures"=>$idMesures,
                       ":id_infos"=>$idInfos,
                       ":id_commande"=>$idCommande]
                    );
                    $this->dbh->commit();
                    
                    return true;

        }
        catch (PDOException $e) {
            $this->dbh->rollBack();
            die($e->getMessage());
         }

    }
}
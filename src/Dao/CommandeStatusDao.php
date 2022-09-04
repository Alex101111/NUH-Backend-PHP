<?php

namespace App\Dao;

use App\Model\CommandeStatus;
use App\Model\Commande;
use Core\AbstractDao;
use PDO;

class CommandeStatusDao extends AbstractDao
{

    public function getStatusByTrackingNumber($surname, $tracking_number)
    {
        $sth = $this->dbh->prepare("SELECT * FROM checkstatus WHERE tracking_number = :tracking_number AND surname=:surname ");
        $sth->execute([':tracking_number' => $tracking_number,
            ':surname' => $surname]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        } else {
            return $result;
        }

    }

    public function allOrders()
    {
        $sth = $this->dbh->prepare("SELECT * FROM checkstatus");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $a = new CommandeStatus();
            $result[$i] = $a->setIdUser($result[$i]['id_user'])
                ->setIdCommande($result[$i]['id_commande'])
                ->setName($result[$i]['name'])
                ->setSurname($result[$i]['surname'])
                ->setTransportType($result[$i]['transport_type'])
                ->setDeparture($result[$i]['departure'])
                ->setDestination($result[$i]['destination'])
                ->setContainerType($result[$i]['container_type'])
                ->setLength($result[$i]['length'])
                ->setHeight($result[$i]['height'])
                ->setWidth($result[$i]['width'])
                ->setNetWeight($result[$i]['net_weight'])
                ->setGrossWeight($result[$i]['gross_weight'])
                ->setCommandeStatus($result[$i]['commande_status'])
                ->setCommandeComment($result[$i]['commande_comment'])
                ->setQuoteDate($result[$i]['quote_date'])
                ->setCommentary($result[$i]['commentary']);

        }

        return $result;

    }

    public function getById(int $id): ?CommandeStatus
    {
        $sth = $this->dbh->prepare("SELECT * FROM `checkstatus` WHERE id_commande = :id_commande");
        $sth->execute([":id_commande" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        $a = new CommandeStatus();
        return $a->setIdUser($result['id_user'])
            ->setIdCommande($result['id_commande'])
            ->setName($result['name'])
            ->setSurname($result['surname'])
            ->setTransportType($result['transport_type'])
            ->setDeparture($result['departure'])
            ->setDestination($result['destination'])
            ->setContainerType($result['container_type'])
            ->setLength($result['length'])
            ->setHeight($result['height'])
            ->setWidth($result['width'])
            ->setNetWeight($result['net_weight'])
            ->setGrossWeight($result['gross_weight'])
            ->setCommandeStatus($result['commande_status'])
            ->setCommandeComment($result['commande_comment'])
            ->setQuoteDate($result['quote_date'])
            ->setCommentary($result['commentary']);
    }


    public function editOrder($CommandeStatus, $id): void
    {

        $sth = $this->dbh->prepare(
            "UPDATE `checkstatus` SET length = :length, height = :height, width = :width, net_weight = :net_weight, gross_weight = :gross_weight   WHERE id_commande = :id_commande"
        );
        $sth->execute([
            ":id_commande" => $id,
            ':height' => $CommandeStatus->getHeight(),
            ':width' => $CommandeStatus->getWidth(),
            ':length' => $CommandeStatus->getLength(),
            ':net_weight' => $CommandeStatus->getNetWeight(),
            ':gross_weight' => $CommandeStatus->getGrossWeight(),

        ]);

        $sth = $this->dbh->prepare(
            "UPDATE `checkstatus` SET transport_type = :transport_type, container_type = :container_type, commentary = :commentary   WHERE id_commande = :id_commande"
        );
        $sth->execute([
            ':transport_type' => $CommandeStatus->getTransportType(),
            ':container_type' => $CommandeStatus->getContainerType(),
            ':commentary' => $CommandeStatus->getCommentary(),
            ":id_commande" => $id,
        ]);

        $sth = $this->dbh->prepare(
            "UPDATE `checkstatus` SET commande_status = :commande_status, commande_comment = :commande_comment   WHERE id_commande = :id_commande"
        );
        $sth->execute([
            ':commande_status' => $CommandeStatus->getCommandeStatus(),
            ':commande_comment' => $CommandeStatus->getCommandeComment(),
            ":id_commande" => $id,
        ]);

    }

    public function deleteOrder(int $id): void
    {

        $sth = $this->dbh->prepare("DELETE FROM `commandes` WHERE id_commande = :id_commande");
        $sth->execute([":id_commande" => $id]);

    }
}

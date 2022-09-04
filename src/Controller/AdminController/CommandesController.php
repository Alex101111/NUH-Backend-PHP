<?php
namespace App\Controller\AdminController;

use App\Dao\CommandeStatusDao;
use App\Model\CommandeStatus;
use App\Model\Commande;


class CommandesController {

  public function showAllCommandes(){

    try {
        $CommandeStatusDao = new CommandeStatusDao();
        $orders = $CommandeStatusDao->allOrders();

        for ($i = 0; $i < count($orders); $i++) {
            $orders[$i] = $orders[$i]->toArray();
        }

        header("Content-Type: application/json");
        echo json_encode($orders);
    } catch (PDOException $e) {
        // TODO
    }
    }



    public function showCommandById(int $id)
    {
       
        $CommandeStatusDao = new CommandeStatusDao();
        $user = $CommandeStatusDao->getById($id);
;

        if (!is_null($user)) {
            $user = $user->toArray();

        }

        header("Content-Type: application/json");
        echo json_encode($user);
    }


    public function editCommand(int $id)
    {
       
        $args = [
            'transport_type' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'length' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'height' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'width' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,
            ],

            'net_weight' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'gross_weight' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT,

            ],
            'commentary' => [
                'filter' =>  FILTER_SANITIZE_FULL_SPECIAL_CHARS

            ],
            'container_type' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'commande_status' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'commande_comment' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],

        ];

        $data = json_decode(file_get_contents('php://input'), true);
        $order_input = filter_var_array($data, $args);

        if (empty($order_input['transport_type']) || empty($order_input['container_type'])
        || empty($order_input['length']) || empty($order_input['height']) || empty($order_input['width']) || empty($order_input['net_weight'])
        || empty($order_input['gross_weight']) || empty($order_input['commande_comment']) || empty($order_input['commande_status'])) {
        $error_messages[] = 'please fill in all the required champs';
        }
        if (!isset($error_messages)) {
            $CommandeStatus = new CommandeStatus;

            $CommandeStatus ->setTransportType($order_input['transport_type'])
            ->setContainerType($order_input['container_type'])
            ->setLength($order_input['length'])
            ->setHeight($order_input['height'])
            ->setWidth($order_input['width'])
            ->setNetWeight($order_input['net_weight'])
            ->setGrossWeight($order_input['gross_weight'])
            ->setCommandeStatus($order_input['commande_status'])
            ->setCommandeComment($order_input['commande_comment'])
            ->setCommentary($order_input['commentary']);
        
            $CommandeStatusDao = new CommandeStatusDao();
            $CommandeStatusDao->editOrder($CommandeStatus, $id);


            echo json_encode([
                'the Order information has been updated successfully ',
            ]);
        } else {
            echo json_encode([
                "error_messages" => array(
                    "danger" => $error_messages,
                ),
            ]);

        }
    }



    public function deleteCommand($id)
    {

        $CommandeStatusDao = new CommandeStatusDao();
        $CommandeStatusDao->deleteOrder($id);

        echo json_encode([
            'the Order information has been Deleted successfully ',
        ]);
    }
}
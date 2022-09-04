<?php

namespace App\Controller\UserController;

use App\Dao\QuoteTransactionDao;
use App\Model\Commande;
use App\Model\Info;
use App\Model\Mesure;
use App\Model\User;
use Core\JsonWebToken;

class QuoteController
{
    public function setQuote()
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
            'departure' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'destination' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],

        ];

        $data = json_decode(file_get_contents("php://input"), true);

        $quote_input = filter_var_array($data, $args);

        if (empty($quote_input['transport_type']) || empty($quote_input['departure']) || empty($quote_input['destination']) || empty($quote_input['container_type'])
            || empty($quote_input['length']) || empty($quote_input['height']) || empty($quote_input['width']) || empty($quote_input['net_weight'])
            || empty($quote_input['gross_weight'])) {
            $error_messages[] = 'please fill in all the required champs';
        } else {

            $infos = new Info();

            $infos->setTransportType($quote_input['transport_type'])
                ->setDeparture($quote_input['departure'])
                ->setDestination($quote_input['destination'])
                ->setContainerType($quote_input['container_type'])
                ->setCommentary($quote_input['commentary']);
                
            $mesures = new Mesure();

            $mesures->setLength($quote_input['length'])
                ->setHeight($quote_input['height'])
                ->setWidth($quote_input['width'])
                ->setNetWeight($quote_input['net_weight'])
                ->setGrossWeight($quote_input['gross_weight']);

            $tracking_number = substr(md5(time()), 0, 11);
            $commande = new Commande();
            $commande->setTrackingNumber($tracking_number);
            $commande->setTrackingNumber($tracking_number);
            $JsonWebToken = new JsonWebToken();
            $jwt = $JsonWebToken->getHeaderToken();
            $user = new User();

            $id_user = $JsonWebToken->token_user_id($jwt);
            $user_email = $JsonWebToken->token_user_email($jwt);
            $user->setIdUser($id_user);
            $getquote = new QuoteTransactionDao();
            $message = nl2br("Thank you for Contacting NUH Team \n Our Team will contact you in the next 48 hours to set the specification of your command \n
you can always keep track of the updates and the status of your command using the following tracking number : $tracking_number");
            $getquote->QuoteTransaction($infos, $mesures, $user, $commande);
            mail($user_email, "Do not Respond", $message, 'From: info@nuhlogistics.com');

        };

        if (!isset($error_messages)) {

            echo json_encode(
                'Thank you for contacting NUH Team , Check your Email for infos and Traking number',
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

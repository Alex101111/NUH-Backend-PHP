<?php

namespace App\Controller;

use App\Dao\CommandeStatusDao;

class TrackingController
{

    public function checkUserInfo()
    {

        $args = [
            'tracking_number' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            ],
            'surname' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            ],
        ];
        $data = json_decode(file_get_contents("php://input"), true);
        $user_input = filter_var_array($data, $args);
        if (empty($user_input['tracking_number']) || empty($user_input['surname'])) {
            $error_messages[] = "Both Tracking Number And surname Are Required ";
        } else {
            $commandeStatusDao = new CommandeStatusDao();
            $tracking_number = $user_input['tracking_number'];
            $surname = $user_input['surname'];

            $status = $commandeStatusDao->getStatusByTrackingNumber($surname, $tracking_number);
            if ($status) {

                // if($commandeStatusDao->checkTrackingNumber($surname,$tracking_number)){
                //    $status = $commandeStatusDao->getInfoByTrackingNumber($tracking_number);

                echo json_encode(

                    $status

                );

            } else {
                $error_messages[] = 'Tracking Number Was Not Found';
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

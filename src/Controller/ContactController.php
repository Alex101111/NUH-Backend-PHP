<?php

namespace App\Controller;


class ContactController{

    public function contactUs(){

        $args = [
            'email' => [
                'filter' => FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL,

            ],
            'message' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'name' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],
            'reason' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            ],

            'surname' => [
                'surname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

            ],

        ];

        $data = json_decode(file_get_contents("php://input"), true);

        $user_input = filter_var_array($data, $args);
        if (empty($user_input['email']) || empty($user_input['message']) || empty($user_input['name'])
            || empty($user_input['reason']) || empty($user_input['surname'])) {

            $error_messages[] = 'please fill in all the required champs to send your Email';

        }else{

            $headers = 'From: '. $user_input['email'].'\r\n';
            $headers .= 'MIME-Version: 1.0';
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            $message = '
            <html>
<head>
  <title>New Message From '.$user_input['name']. $user_input['surname'].' </title>
</head>
<body>
  <p> '. $user_input['message'].'</p>

</body>
</html>
            ';
  
            mail('info@nuhlogistics.com', $user_input['reason'], $message , $headers);
            $success_message = 'Thank You for contacting us, our team will contact you soon';
            echo json_encode([
                $success_message,
            ]);

        }
    }
}
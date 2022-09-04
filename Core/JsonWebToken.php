<?php

namespace Core;

use Core\Encode;

class JsonWebToken
{

    // generate json web token
    public function generate_jwt($headers, $payload, $secret = 'zB4j4ttb6aydWg3JTqIhDK5fcDG9biQE4mJiOy4fVIMg0boVn8FeGv1SKdI8Z88')
    {
        $encode = new Encode;

        $headers_encoded = $encode->base64url_encode(json_encode($headers));

        $payload_encoded = $encode->base64url_encode(json_encode($payload));

        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $encode->base64url_encode($signature);

        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

        return $jwt;
    }

    // check if jwt is valid
    public function is_jwt_valid($jwt, $secret = 'zB4j4ttb6aydWg3JTqIhDK5fcDG9biQE4mJiOy4fVIMg0boVn8FeGv1SKdI8Z88')
    {
        $encode = new Encode;
        // split the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header = $encode->base64url_encode($header);
        $base64_url_payload = $encode->base64url_encode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = $encode->base64url_encode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);

        if ($is_token_expired || !$is_signature_valid) {
            return false;
        } else {
            return true;
        }
    }

    //check the token user's role
    public function isAdmin($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $encode = new Encode;
        $tokenData = json_decode($payload)->data;
        return $tokenData->{'user_role'};
    }
    // check the token user's id
    public function token_user_id($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $encode = new Encode;
        $tokenData = json_decode($payload)->data;
        return $tokenData->{'user_id'};
    }

    public function token_user_email($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $encode = new Encode;
        $tokenData = json_decode($payload)->data;
        return $tokenData->{'email'};
    }

    public function getHeaderToken()
    {
        if (!preg_match('/Bearer\s(\S+)/', $_SERVER["HTTP_AUTHORIZATION"], $matches)) {
            return null;

        } else {
            // echo json_encode($matches[1]);
            $jwt = $matches[1];
            if (!$jwt) {
                // No token was able to be extracted from the authorization header
                return null;

            }

            return $jwt;
        }
    }

}

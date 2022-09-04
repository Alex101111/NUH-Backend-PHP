<?php

namespace Core;
// use this class to encode the jwt info 
class Encode {

    public function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    public function base64url_decode($str) {
        return rtrim(strtr(base64_decode($str), '+/', '-_'), '=');
    }
}
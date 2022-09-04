<?php

namespace App\Model;



class Email 
{
    protected $to ;
    protected $subject;
    protected $message;
    protected $headers; 




    public function __construct($to, $subject, $message, $headers) 
    {
 mail($this->to,$this->subject,$this->message,$this->headers);
    }


}
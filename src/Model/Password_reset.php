<?php

namespace App\Model;

class Password_reset
{
protected int $user_id;
protected string $password_reset_id;




/**
 * Get the value of user_id
 *
 * @return int
 */
public function getUserId(): int
{
return $this->user_id;
}

/**
 * Set the value of user_id
 *
 * @param int $user_id
 *
 * @return self
 */
public function setUserId(int $user_id): self
{
$this->user_id = $user_id;

return $this;
}

/**
 * Get the value of password_reset_id
 */ 
public function getPassword_reset_id()
{
return $this->password_reset_id;
}

/**
 * Set the value of password_reset_id
 *
 * @return  self
 */ 
public function setPassword_reset_id($password_reset_id)
{
$this->password_reset_id = $password_reset_id;

return $this;
}
}
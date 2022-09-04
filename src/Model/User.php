<?php 

namespace App\Model;

class User 
{
    protected int $id_user;
    protected string $name;
    protected string $surname;
    protected string $email;
    protected int $phone_number;
    protected ?string $password;
    protected bool $is_admin;
    protected bool $active;
    protected ?string $activation_code;
    protected string $CreatedAt;
    protected string $country_code;






    public function toArray(): array
{
    return [
        "id_user" => $this->id_user,
        "name" => $this->name,
        "surname" => $this->surname,
        "email" => $this->email,
        "phone_number" => $this->phone_number,
        "is_admin" => $this->is_admin,
        "active" => $this->active,
        "CreatedAt" => $this->CreatedAt,
        "country_code"=>$this->country_code
    ];
}
    /**
     * hash the password object 
     * @param ?string $password to be hashed 
     */
    
    public function setHashPwd(?string $password): self
    {
     $this->password = password_hash($password,PASSWORD_BCRYPT);
     return $this;
    }
    /**
     * verify if password and hash maches 
     * @param string $Entered password
     * @return bool 
     */


    public function verifyPwd(string $password):bool 
    {
        return password_verify($password, $this->password);
    }

    public function erasePwd()
    {
        
        $this->password = null;
    }

    /**
     * verify if user is active
     * @param bool $active 
     * @return self 
     */

    public function isUserActive(bool $active):self
    {
        return $this->active===1;
    }
    
   

    /**
     * Get the value of id_user
     *
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @param int $id_user
     *
     * @return self
     */
    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @param string $surname
     *
     * @return self
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of eamil
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of eamil
     *
     * @param string $eamil
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone_number
     *
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @param int $phone_number
     *
     * @return self
     */
    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param ?string $password
     *
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of is_admin
     *
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Set the value of is_admin
     *
     * @param bool $is_admin
     *
     * @return self
     */
    public function setIsAdmin(bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * Get the value of active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of activation_code
     *
     * @return ?string
     */
    public function getActivationCode(): ?string
    {
        return $this->activation_code;
    }

    /**
     * Set the value of activation_code
     *
     * @param ?string $activation_code
     *
     * @return self
     */
    public function setActivationCode(): self
    {
        $this->activation_code = bin2hex(random_bytes(16));

        return $this;
    }

    /**
     * Get the value of CreatedAt
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->CreatedAt;
    }

    /**
     * Set the value of CreatedAt
     *
     * @param string $CreatedAt
     *
     * @return self
     */
    public function setCreatedAt(string $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    /**
     * Get the value of country_code
     */ 
    public function getCountry_code()
    {
        return $this->country_code;
    }

    /**
     * Set the value of country_code
     *
     * @return  self
     */ 
    public function setCountry_code($country_code)
    {
        $this->country_code = $country_code;

        return $this;
    }
}
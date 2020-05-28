<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern = "/[0-9]{10}/"
     * , message = "ta foiré un truc la...")
     */
    private $phone;

    /**
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     *
     * @var Property
     */
    private $property;

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname)
    {
        return $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname)
    {
        return $this->lastname = $lastname;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(?string $phone)
    {
        return $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        return $this->email = $email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(?string $message)
    {
        return $this->message = $message;
    }

    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty(?Property $property)
    {
        return $this->property = $property;
    }
}
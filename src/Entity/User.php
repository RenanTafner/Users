<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

     /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O nome do usuário é obrigatório")
     * )
     */
    private string $nome;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O email do usuário é obrigatório")
     * )
     */
    private string $email;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}

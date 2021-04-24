<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_phone")
 */
class UserPhone
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

     /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O DDD é obrigatório")
     * )
     */
    private string $ddd;

     /**
     * @ORM\Column(type="string", length=14)
     * @Assert\NotBlank(message="O número é obrigatório")
     * )
     */
    private string $number;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="phones",  cascade={"persist"})
     */
    private $user;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }
  
    public function getDDD(): string
    {
        return $this->ddd;
    }

    public function setDDD(string $ddd): void
    {
        $this->ddd = $ddd;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    //public function getUser(): ?User
    //{
    //    return $this->user;
    //}

}

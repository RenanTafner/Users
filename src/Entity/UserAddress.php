<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_address")
 */
class UserAddress
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

     /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank(message="O Estado é obrigatório")
     * )
     */
    private string $estado;

     /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank(message="A Cidade é obrigatório")
     * )
     */
    private string $cidade;


     /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank(message="O Bairro é obrigatório")
     * )
     */
    private string $bairro;


     /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="A Rua é obrigatório")
     * )
     */
    private string $rua;


     /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="O Número é obrigatório")
     * )
     */
    private string $numero;
   

      /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="O Complemento é obrigatório")
     * )
     */
    private string $complemento;


     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="phonesCollection",  cascade={"persist"})
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
  
    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }


    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getRua(): string
    {
        return $this->rua;
    }

    public function setRua(string $rua): void
    {
        $this->rua = $rua;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function setComplemento(string $complemento): void
    {
        $this->complemento = $complemento;
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

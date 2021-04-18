<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\UserPhone;
use App\Entity\UserAddress;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
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
     * @Assert\NotBlank(message="O sobre nome do usuário é obrigatório")
     * )
     */
    private string $sobreNome;


    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O email do usuário é obrigatório")
     * )
     */
    private string $email;


    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\UserPhone",  mappedBy="user", cascade={"persist"})
     *  
     */
    private $phonesCollection;


     /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\UserAddress",  mappedBy="user", cascade={"persist"})
     *  
     */
    private $addressCollection;   


    public function __construct()
    {
        $this->createdAt         = new \DateTime();
        $this->phonesCollection  = new ArrayCollection();
        $this->addressCollection = new ArrayCollection();
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

    public function getSobreNome(): string
    {
        return $this->sobreNome;
    }

    public function setSobreNome(string $sobreNome): void
    {
        $this->sobreNome = $sobreNome;
    }   

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Collection|UserPhone[]
     */
    public function getPhonesCollection(): Collection
    {
        return $this->phonesCollection;
    }

    public function addPhonesCollection(UserPhone $phonesCollection): self
    {
        if (!$this->phonesCollection->contains($phonesCollection)) {
            $this->phonesCollection[] = $phonesCollection;
            $phonesCollection->setUser($this);
        }

        return $this;
    }

    public function removePhonesCollection(UserPhone $phonesCollection): self
    {
        if ($this->phonesCollection->removeElement($phonesCollection)) {
            // set the owning side to null (unless already changed)
            if ($phonesCollection->getUser() === $this) {
                $phonesCollection->setUser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|UserAddress[]
     */
    public function getAddressCollection(): Collection
    {
        return $this->addressCollection;
    }

    public function addAddressCollection(UserAddress $addressCollection): self
    {
        if (!$this->addressCollection->contains($addressCollection)) {
            $this->addressCollection[] = $addressCollection;
            $addressCollection->setUser($this);
        }

        return $this;
    }

    public function removeAddressCollection(UserAddress $addressCollection): self
    {
        if ($this->addressCollection->removeElement($addressCollection)) {
            // set the owning side to null (unless already changed)
            if ($addressCollection->getUser() === $this) {
                $addressCollection->setUser(null);
            }
        }

        return $this;
    }



}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChecklistRepository")
 */
class Checklist
{
    const SERVICE =  array("Pression","Bouteille","Canette");

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Biere")
     * @ORM\JoinColumn(nullable=false)
     */
    private $biere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Revendeur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $revendeur;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 10,
     * )
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;


    public function __construct()
    {
        $this->setDateCreation(new \DateTime('now'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiere(): ?Biere
    {
        return $this->biere;
    }

    public function setBiere(?Biere $biere): self
    {
        $this->biere = $biere;

        return $this;
    }

    public function getRevendeur(): ?Revendeur
    {
        return $this->revendeur;
    }

    public function setRevendeur(?Revendeur $revendeur): self
    {
        $this->revendeur = $revendeur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}

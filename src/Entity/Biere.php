<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BiereRepository")
 * @UniqueEntity(
 *     fields={"nom", "id_brasserie"}
 * )
 */
class Biere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $robe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ibu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $abv;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brasserie", inversedBy="bieres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_brasserie;


    public function __construct()
    {
        $this->setDateCreation(new \DateTime('now'));
    }

    public function __toString()
    {
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): string {

         return (new Slugify())->slugify($this->nom);
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRobe(): ?string
    {
        return $this->robe;
    }

    public function setRobe(?string $robe): self
    {
        $this->robe = $robe;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIbu(): ?int
    {
        return $this->ibu;
    }

    public function setIbu(?int $ibu): self
    {
        $this->ibu = $ibu;

        return $this;
    }

    public function getAbv(): ?string
    {
        return $this->abv;
    }

    public function setAbv(?string $abv): self
    {
        $this->abv = $abv;

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

    public function getIdBrasserie(): ?Brasserie
    {
        return $this->id_brasserie;
    }

    public function setIdBrasserie(?Brasserie $id_brasserie): self
    {
        $this->id_brasserie = $id_brasserie;

        return $this;
    }

}

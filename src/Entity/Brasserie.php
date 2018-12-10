<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrasserieRepository")
 * @UniqueEntity("nom")
 * @UniqueEntity(
 *     fields={"numero_rue", "rue","code_postale"}
 * )
 */
class Brasserie
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero_rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code_postale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Biere", mappedBy="id_brasserie")
     */
    private $bieres;


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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNumeroRue(): ?int
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(?int $numero_rue): self
    {
        $this->numero_rue = $numero_rue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostale(): ?int
    {
        return $this->code_postale;
    }

    public function setCodePostale(?int $code_postale): self
    {
        $this->code_postale = $code_postale;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

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

    /**
     * @return Collection|Biere[]
     */
    public function getBieres(): Collection
    {
        return $this->bieres;
    }

    public function addBiere(Biere $biere): self
    {
        if (!$this->bieres->contains($biere)) {
            $this->bieres[] = $biere;
            $biere->setIdBrasserie($this);
        }

        return $this;
    }

    public function removeBiere(Biere $biere): self
    {
        if ($this->bieres->contains($biere)) {
            $this->bieres->removeElement($biere);
            // set the owning side to null (unless already changed)
            if ($biere->getIdBrasserie() === $this) {
                $biere->setIdBrasserie(null);
            }
        }

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}

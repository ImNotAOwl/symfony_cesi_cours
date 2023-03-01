<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StructureRepository;

#[ORM\Table(name: 'structure')]
#[ORM\UniqueConstraint(name: 'structure_lieu_uq', columns: ['RUE', 'CP', 'VILLE'])]
#[ORM\Entity(repositoryClass: StructureRepository::class, readOnly: false)]
class Structure
{
   
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    
    #[ORM\Column(name: 'NOM', type: 'string', length: 100, nullable: false)]
    private $nom;

    
    #[ORM\Column(name: 'RUE', type: 'string', length: 200, nullable: false)]
    private $rue;

    
    #[ORM\Column(name: 'CP', type: 'string', length: 5, nullable: false, options: ['fixed' => true])]
    private $cp;

    
    #[ORM\Column(name: 'VILLE', type: 'string', length: 100, nullable: false)]
    private $ville;

    
    #[ORM\Column(name: 'ESTASSO', type: 'boolean', nullable: false)]
    private $estasso;

    
    #[ORM\Column(name: 'NB_DONATEURS', type: 'integer', nullable: true)]
    private $nbDonateurs;

   
    #[ORM\Column(name: 'NB_ACTIONNAIRES', type: 'integer', nullable: true)]
    private $nbActionnaires;

    #[ORM\ManyToMany(targetEntity: Dirigeant::class, inversedBy: 'structures')]
    #[ORM\JoinTable(name: 'dirig_struct')]
    private $dirigeants;

    #[ORM\Column(name: 'LOGO', type: 'string', nullable: true)]
    private $logo;

    public function __construct()
    {
        $this->dirigeants = new ArrayCollection();
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

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

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

    public function isEstasso(): ?bool
    {
        return $this->estasso;
    }

    public function setEstasso(bool $estasso): self
    {
        $this->estasso = $estasso;

        return $this;
    }

    public function getNbDonateurs(): ?int
    {
        return $this->nbDonateurs;
    }

    public function setNbDonateurs(?int $nbDonateurs): self
    {
        $this->nbDonateurs = $nbDonateurs;

        return $this;
    }

    public function getNbActionnaires(): ?int
    {
        return $this->nbActionnaires;
    }

    public function setNbActionnaires(?int $nbActionnaires): self
    {
        $this->nbActionnaires = $nbActionnaires;

        return $this;
    }

    /**
     * @return Collection<int, Dirigeant>
     */
    public function getdirigeants(): Collection
    {
        return $this->dirigeants;
    }

    public function addDirgeant(Dirigeant $dirgeant): self
    {
        if (!$this->dirigeants->contains($dirgeant)) {
            $this->dirigeants->add($dirgeant);
        }

        return $this;
    }

    public function removeDirgeant(Dirigeant $dirgeant): self
    {
        $this->dirigeants->removeElement($dirgeant);

        return $this;
    }

    public function addDirigeant(Dirigeant $dirigeant): self
    {
        if (!$this->dirigeants->contains($dirigeant)) {
            $this->dirigeants->add($dirigeant);
        }

        return $this;
    }

    public function removeDirigeant(Dirigeant $dirigeant): self
    {
        $this->dirigeants->removeElement($dirigeant);

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function __toString(): string 
    {
        return "$this->id"."$this->nom";
    }
}

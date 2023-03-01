<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'secteurs_structures')]
#[ORM\Index(name: 'secteurs_structures_secteur_fk', columns: ['ID_SECTEUR'])]
#[ORM\Index(name: 'IDX_ECF28C16355BC10D', columns: ['ID_STRUCTURE'])]
#[ORM\UniqueConstraint(name: 'secteurs_structures_uq', columns: ['ID_STRUCTURE', 'ID_SECTEUR'])]
#[ORM\Entity]
class SecteursStructures
{
    
    #[ORM\Column(name: 'ID', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    #[ORM\JoinColumn(name: 'ID_STRUCTURE', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Structure')]
    private $idStructure;

    #[ORM\JoinColumn(name: 'ID_SECTEUR', referencedColumnName: 'ID')]
    #[ORM\ManyToOne(targetEntity: 'Secteur')]
    private $idSecteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdStructure(): ?Structure
    {
        return $this->idStructure;
    }

    public function setIdStructure(?Structure $idStructure): self
    {
        $this->idStructure = $idStructure;

        return $this;
    }

    public function getIdSecteur(): ?Secteur
    {
        return $this->idSecteur;
    }

    public function setIdSecteur(?Secteur $idSecteur): self
    {
        $this->idSecteur = $idSecteur;

        return $this;
    }


}

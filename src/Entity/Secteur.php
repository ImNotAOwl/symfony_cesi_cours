<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'secteur')]
#[ORM\UniqueConstraint(name: 'secteur_uq', columns: ['LIBELLE'])]
#[ORM\Entity]
class Secteur
{
    #[ORM\Column(name: 'ID', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    #[ORM\Column(name: 'LIBELLE', type: 'string', length: 100, nullable: false)]
    private $libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString(): string 
    {
        return "$this->id"."$this->libelle";
    }
}

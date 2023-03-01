<?php

namespace App\UtilsClass;

class Search
{
    private string $nom;
    private bool $isAsso;

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIsAsso(): ?bool
    {
        return $this->isAsso;
    }

    public function setIsAsso(bool $isAsso): self
    {
        $this->isAsso = $isAsso;

        return $this;
    }

    public function __toString(): string
    {
        return "$this->nom"."$this->isAsso";
    }

}

<?php

namespace App\Entity;

use App\Repository\PoudreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoudreRepository::class)]
class Poudre extends Medicament
{
  
    public function __construct()
    {
        $this->type = "poudre";
    }
}

<?php

namespace App\Entity;

use App\Repository\ComprimeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComprimeRepository::class)]
class Comprime extends Medicament
{
    public function __construct()
    {
        $this->type = "comprime";
    }
   
}

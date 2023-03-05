<?php

namespace App\Entity;

use App\Repository\SiropRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiropRepository::class)]
class Sirop extends Medicament
{
    public function __construct()
    {
        $this->type = "sirop";
    }
}

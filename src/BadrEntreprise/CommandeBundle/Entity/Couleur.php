<?php

namespace BadrEntreprise\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couleur
 *
 * @ORM\Table(name="couleur")
 * @ORM\Entity(repositoryClass="BadrEntreprise\CommandeBundle\Repository\CouleurRepository")
 */
class Couleur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="namecouleur", type="string", length=255)
     */
    private $namecouleur;

   


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

   
    /**
     * Set namecouleur
     *
     * @param string $namecouleur
     *
     * @return Couleur
     */
    public function setNamecouleur($namecouleur)
    {
        $this->namecouleur = $namecouleur;

        return $this;
    }

    /**
     * Get namecouleur
     *
     * @return string
     */
    public function getNamecouleur()
    {
        return $this->namecouleur;
    }
}

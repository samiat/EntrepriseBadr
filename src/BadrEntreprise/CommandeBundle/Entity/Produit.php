<?php

namespace BadrEntreprise\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="BadrEntreprise\CommandeBundle\Repository\ProduitRepository")
 */
class Produit
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
     *
     * @ORM\ManyToMany(targetEntity="BadrEntreprise\CommandeBundle\Entity\Couleur", cascade={"persist"})
     */
    private $couleurs;

 /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255 )
     */
    private $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=0)
     */
    private $prix;
	
	/**
     * @var string
     *
     * @ORM\Column(name="description", type="string",length=255 )
     */
	
	private $description;
	
	
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Produit
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }
 
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->couleurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add couleur
     *
     * @param \BadrEntreprise\CommandeBundle\Entity\Couleur $couleur
     *
     * @return Produit
     */
    public function addCouleur(\BadrEntreprise\CommandeBundle\Entity\Couleur $couleur)
    {
        $this->couleurs->add($couleur);

        return $this;
    }

    /**
     * Remove couleur
     *
     * @param \BadrEntreprise\CommandeBundle\Entity\Couleur $couleur
     */
    public function removeCouleur(\BadrEntreprise\CommandeBundle\Entity\Couleur $couleur)
    {
        $this->couleurs->removeElement($couleur);
    }

    /**
     * Get couleurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCouleurs()
    {
        return $this->couleurs;
    }
}

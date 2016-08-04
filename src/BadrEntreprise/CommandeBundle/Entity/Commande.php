<?php

namespace BadrEntreprise\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BadrEntreprise\CommandeBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var array
     *
     * @ORM\Column(name="listeProduits", type="array")
     */
    private $listeProduits;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseLivraison", type="string", length=255)
     */
    private $adresseLivraison;
	
	/**
     * @var dateLivraison
     *
     * @ORM\Column(name="dateLivraison", type="date")
     */
	private $dateLivraison;
	
	
	public function getPrixTotal()
  {
    $prix = 0;
    foreach($this->getListeProduits() as $produit)
    {
      $prix += $produit->getPrix();
    }
    return $prix;
  }

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
     * Set listeProduits
     *
     * @param array $listeProduits
     *
     * @return Commande
     */
    public function setListeProduits($listeProduits)
    {
        $this->listeProduits = $listeProduits;

        return $this;
    }

    /**
     * Get listeProduits
     *
     * @return array
     */
    public function getListeProduits()
    {
        return $this->listeProduits;
    }

    /**
     * Set adresseLivraison
     *
     * @param string $adresseLivraison
     *
     * @return Commande
     */
    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    /**
     * Get adresseLivraison
     *
     * @return string
     */
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     *
     * @return Commande
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }
}

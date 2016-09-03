<?php

namespace BadrEntreprise\CommandeBundle\Form;

use BadrEntreprise\CommandeBundle\Entity\Couleur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType {
	/**
	 *
	 * @param FormBuilderInterface $builder        	
	 * @param array $options        	
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add ( 'titre' )
		->add ( 'description' )
		->add ( 'prix' )
		->add ( 'couleur')
		->add ( 'quantite')
		;

		
	}
	
	/**
	 *
	 * @param OptionsResolver $resolver        	
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'BadrEntreprise\CommandeBundle\Entity\Produit' 
		) );
	}
}

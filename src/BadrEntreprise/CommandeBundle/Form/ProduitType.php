<?php

namespace BadrEntreprise\CommandeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use BadrEntreprise\CommandeBundle\Entity\Couleur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	
	 $builder->add('couleurs', CollectionType::class, array(
            'entry_type' => CouleurType::class,
			'allow_add'  => true,
			 'by_reference' => false,
        ))
            ->add('titre')
            ->add('prix')
			->add('description')
			
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BadrEntreprise\CommandeBundle\Entity\Produit'
        ));
    }
}

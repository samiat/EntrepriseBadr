<?php

namespace BadrEntreprise\CommandeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AuthentificationForm extends AbstractType{
	
	public function buildform(FormBuilderInterface $builder,array $options )
{
$builder
->add('Email',TextType::class);
->add('Mot De Passe ',TextType::class);
->add('Se connecter',SubmitType::class);

}
	
}
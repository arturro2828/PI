<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('logInButton', SubmitType::class, array('label' => 'Zaloguj', 'attr' => array('class' => 'btn btn-large btn-info')))
            ->add('logOutButton', SubmitType::class, array('label' => 'Wyloguj', 'attr' => array('class' => 'btn btn-large btn-warning')))
            ->add('newAccount', SubmitType::class, array('label' => 'Załóż konto', 'attr' => array('class' => 'btn btn-large btn-success')));
    }
    
    public function getName() {
        return 'task';
    }
}

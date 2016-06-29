<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class EditUserType extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('username', TextType::class, array('label' => 'Nazwa Użytkownika','attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('label' => 'Adres Email','attr' => array('class' => 'form-control')))
            ->add('password', PasswordType::class, array('label' => 'Hasło','attr' => array('class' => 'form-control')))
            ->add('EditUserButton', SubmitType::class, array('label' => 'Modyfikuj konto', 'attr' => array('class' => 'btn btn-lg btn-primary btn-block')));
        
    }
             
    public function getName() {
        return 'editUser';
    }
    
    
}
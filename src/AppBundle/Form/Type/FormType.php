<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class FormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class)
            ->add('Email', TextType::class)
            ->add('save', SubmitType::class)
            ->add('saveAndAdd', SubmitType::class)
            ->add('saveAndAdd1', SubmitType::class)
                
            
            ->add('logOutButton', SubmitType::class);
       
    }
            
    public function getName() {
        return 'task';
    }
}//, array('attr' => array('class' => 'form-control'))
//, array('attr' => array('class' => 'form-control'))
//, array('label' => 'Zapisz', 'attr' => array('class' => 'btn btn-large btn-success'))
//, array('label' => 'Wyswietl', 'attr' => array('class' => 'btn btn-large btn-info'))
//, array('label' => 'Usun', 'attr' => array('class' => 'btn btn-large btn-warning'))
//, array('label' => 'Wyloguj', 'attr' => array('class' => 'btn btn-large btn-warning'))
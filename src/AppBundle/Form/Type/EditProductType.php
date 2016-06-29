<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditProductType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('username', TextType::class, array('label' => 'Nazwa Użytkownika','attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('label' => 'Adres Email','attr' => array('class' => 'form-control')))
            ->add('product', TextType::class, array('label' => 'Nazwa Produktu','attr' => array('class' => 'form-control')))
            ->add('category', ChoiceType::class, array('label' => 'Kategoria','attr' => array('class' => 'form-control'),
                 'placeholder' => 'Wybierz kategorię',
                'choices'  => array(
                'Elektronika' => 'Elektronika',
                'Moda damska' => 'Moda damska',
                'Moda męska'  => 'Moda męska',
                'Dom i ogród' => 'Dom i ogród',
                'Sport'       => 'Sport',
                'Motoryzacja' => 'Motoryzacja',
                ),))  
            ->add('description', TextareaType::class, array('label' => 'Opis produktu','attr' => array('class' => 'form-control')))
            ->add('picture', FileType::class,array('label' => 'Zmień zdjęcie', 'data_class' => null))
            ->add('EditAdvertButton', SubmitType::class, array('label' => 'Modyfikuj ogłoszenie', 'attr' => array('class' => 'btn btn-lg btn-primary btn-block')));
  
             
    }
             
    public function getName() {
        return 'editProduct';
    }
}

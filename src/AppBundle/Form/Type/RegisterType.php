<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Beelab\Recaptcha2Bundle\Validator\Constraints\Recaptcha2;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class RegisterType extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('username', TextType::class, array('label' => 'Nazwa Użytkownika','attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('label' => 'Adres Email','attr' => array('class' => 'form-control')))
            ->add('password', PasswordType::class, array('label' => 'Hasło','attr' => array('class' => 'form-control')))
            ->add('RegisterButton', SubmitType::class, array('label' => 'Utwórz konto', 'attr' => array('class' => 'btn btn-lg btn-primary btn-block')))
            ->add('captcha', 'Beelab\Recaptcha2Bundle\Form\Type\RecaptchaType', array(
                'label' => false,
                'mapped' => false,
                'constraints' => new Recaptcha2(),
            )) ;
    //     $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
    //    $userEdit = $event->getData();
     //   $form = $event->getForm();

        // check if the user object is "new"
        // If no data is passed to the form, the data is "null".
        // This should be considered a new "Product"
   //     if (!$userEdit || null === $userEdit->getId()) {
   //         $form->add('RegisterButton', SubmitType::class, array('label' => 'Utwórz konto', 'attr' => array('class' => 'btn btn-lg btn-primary btn-block')));
  //      }
 //   });
        
        
        
        
        
    }
             
    public function getName() {
        return 'register';
    }
    
    
}

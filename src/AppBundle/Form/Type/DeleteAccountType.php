<?php



namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class DeleteAccountType extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('username', TextType::class, array('label' => 'Nazwa Użytkownika','attr' => array('class' => 'form-control')))
            ->add('DeleteButton', SubmitType::class, array('label' => 'Usuń konto', 'attr' => array('class' => 'btn btn-lg btn-primary btn-block')));
                
    }
             
    public function getName() {
        return 'task';
    }
    
    
}

<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Type\AddPartyType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name','text')
            ->add('gender', 'choice', array(
                'choices' => array(
                    'm' => 'Male',
                    'f' => 'Female'
                )))
            ->add('email','email')
            ->add('phone','number')
            ->add('party', new AddPartyType())
            ->add('send', 'submit');
    }

    public function getName()
    {
        return 'AddParty';
    }
}
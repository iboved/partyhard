<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use AppBundle\Form\Type\UserType;

class AddPartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('city','text')
            ->add('description','text', array('attr' => array('maxlength' => 250)))
            ->add('count', 'number')
            ->add('donate', 'number');
    }

    public function getName()
    {
        return 'AddParty';
    }
}
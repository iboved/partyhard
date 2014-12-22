<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddPartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('city')
            ->add('gender', 'choice', array(
                'choices' => array(
                    'a' => 'Any',
                    'm' => 'Male',
                    'f' => 'Female'),
                'label' => 'Needed gender'
            ))
            ->add('members')
            ->add('donate');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Party',
        ));
    }

    public function getName()
    {
        return 'addParty';
    }
}

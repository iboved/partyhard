<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Range;

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
                    'any' => 'any',
                    'male' => 'male',
                    'female' => 'female'),
                'label' => 'Needed gender'
            ))
            ->add('members', null, array('constraints' => array(new Range(array('min'=>2)))))
            ->add('donate', null, array('constraints' => array(new Range(array('min'=>0)))));
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

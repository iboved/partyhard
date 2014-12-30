<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Range;

class EditPartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('city')
            ->add('gender', 'choice', array(
                'choices' => array(
                    $options['data']->getGender() => $options['data']->getGender()),
                'disabled' => true,
                'label' => 'Desired sex'
            ))
            ->add('members', null, array('constraints' => array(new Range(array('min' => $options['data']->getUsers()->count()+1)))))
            ->add('donate', null, array('constraints' => array(new Range(array('min' => 0)))))
            ->add('send', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Party',
        ));
    }

    public function getName()
    {
        return 'editParty';
    }
}

<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Party;

class JoinPartyType extends AbstractType
{
    private $party;

    public function __construct(Party $party)
    {
        $this->party = $party;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('gender', 'choice', array(
                'choices' => array(
                    'male' => 'Male',
                    'female' => 'Female')
            ))
            ->add('email','email')
            ->add('phone')
            ->add('send', 'submit');

        $options['data']->setParty($this->party);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'joinParty';
    }
}

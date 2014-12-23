<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Form\EventListener\AddGenderFieldSubscriber;
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
        $options['data']->setParty($this->party);

        $builder
            ->add('name');

        $builder->addEventSubscriber(new AddGenderFieldSubscriber());

        $builder
            ->add('email','email')
            ->add('phone')
            ->add('send', 'submit');
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

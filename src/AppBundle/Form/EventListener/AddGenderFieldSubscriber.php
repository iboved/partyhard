<?php

namespace AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddGenderFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $party = $event->getData()->getParty();
        $form = $event->getForm();

        if($party->getGender() == 'male') {
            $form
                ->add('gender', 'choice', array(
                    'choices' => array(
                        'male' => 'male')
                ));
        } elseif($party->getGender() == 'female') {
            $form
                ->add('gender', 'choice', array(
                    'choices' => array(
                        'female' => 'female')
                ));
        } else {
            $form
                ->add('gender', 'choice', array(
                    'choices' => array(
                        'male' => 'male',
                        'female' => 'female')
                ));
        }
    }
}

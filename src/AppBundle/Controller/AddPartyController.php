<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;

class AddPartyController extends Controller
{
    /**
     * @Route("/new/add", name="addparty")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $party = new User();
        $form = $this->createForm(new UserType(), $party);
        $form->handleRequest($request);
        if($form->isValid()){
            $manager = $this->getDoctrine()->getManager();
                $manager->persist($party);
                $manager->flush();
            return $this->generateUrl('homepage');
        }
        return $this->render('AddParty/index.html.twig',array('form'=>$form->createView()));
    }
}

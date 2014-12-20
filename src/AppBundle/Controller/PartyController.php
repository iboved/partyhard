<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\Type\AddUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PartyController extends Controller
{
    /**
     * @Route("/party", name="party")
     * @Method({"GET"})
     */
    public function partyAction(Request $request)
    {
        $active = $request->query->get('active', 'true');
        $city = $request->query->get('city');

        if(!$city) {
            $parties = $this->getDoctrine()
                ->getRepository('AppBundle:Party')
                ->findBy(
                    array('active' => $active),
                    array('id' => 'DESC')
                );
        } else {
            $parties = $this->getDoctrine()
                ->getRepository('AppBundle:Party')
                ->findBy(
                    array('active' => $active, 'city' => $city),
                    array('id' => 'DESC')
                );
        }

        return $this->render('party/party.html.twig', array("parties" => $parties));
    }

    /**
     * @Route("/party/new", name="newparty")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $party = new User();

        $form = $this->createForm(new AddUserType(), $party);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('party/new.html.twig', array('form' => $form->createView()));
    }
}

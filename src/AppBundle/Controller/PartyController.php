<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Party;
use AppBundle\Form\Type\AddUserType;
use AppBundle\Form\Type\JoinPartyType;
use AppBundle\Form\Type\EditPartyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PartyController extends Controller
{
    /**
     * @Route("/parties", name="parties")
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
                    array('city' => $city),
                    array('id' => 'DESC')
                );
        }

        return $this->render('party/party.html.twig', array("parties" => $parties));
    }

    /**
     * @Route("/parties/new", name="newparty")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new AddUserType(), $user);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('party/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/parties/{slug}", name="joinparty")
     * @Method({"GET", "POST"})
     */
    public function joinAction(Request $request, Party $party, $slug)
    {
        $user = new User();

        $form = $this->createForm(new JoinPartyType($party), $user);

        $form->handleRequest($request);

        if($form->isValid()) {
            if($party->getActive() == 'true') {
                $this->get('app.party_handler')->checkActive($party);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('joinparty', ['slug' => $slug]));
        }

        return $this->render('party/join.html.twig', array(
            'party' => $party,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/parties/{slug}/edit", name="editparty")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Party $party)
    {
        if($party->getActive() == 'false') {
            throw $this->createNotFoundException(
                'You cannot edit party ' . $party->getTitle() . ' because it is not active'
            );
        }

        $form = $this->createForm(new EditPartyType(), $party);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('party/edit.html.twig', array(
            'party' => $party,
            'form' => $form->createView(),
        ));
    }
}

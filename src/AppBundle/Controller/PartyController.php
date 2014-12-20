<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

        if ($active == 'true') {
            $parties = $this->getDoctrine()
                ->getRepository('AppBundle:Party')
                ->findBy([], ['id' => 'DESC']);
        }

        return $this->render('party/party.html.twig', array("parties" =>  $parties));
    }
}

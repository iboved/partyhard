<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $parties = $this->getDoctrine()
            ->getRepository('AppBundle:Party')
            ->findBy([], ['id' => 'DESC'], 4);

        return array("parties" =>  $parties);
    }
}

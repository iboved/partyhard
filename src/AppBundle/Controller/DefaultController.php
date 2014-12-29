<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}", name="homepage", defaults = {"_locale" = "en"}, requirements = {"_locale" = "en|ru|ua"})
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $parties = $this->getDoctrine()
            ->getRepository('AppBundle:Party')
            ->findBy(['active' => 'true'], ['id' => 'DESC'], 6);

        $cities = $this->getDoctrine()
            ->getRepository('AppBundle:Party')
            ->findUniqueCities();

        return $this->render('default/index.html.twig', array(
            "parties" =>  $parties,
            "cities" => $cities)
        );
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="default_homepage")
     * @Template("AppBundle::home.html.twig")
     */
    public function homeAction()
    {
        return [];
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return new RedirectResponse(
            $this->generateUrl('default_homepage')
        );
    }
}

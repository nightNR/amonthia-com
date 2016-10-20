<?php

namespace Night\AmonthiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AmonthiaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/auth")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authAction()
    {
        return $this->render('AmonthiaBundle:Auth:auth.html.twig');
    }
}

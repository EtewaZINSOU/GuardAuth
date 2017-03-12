<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomepageController
 *
 * @package AppBundle\Controller
 */
class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('homepage/index.html.twig', []);
    }
}

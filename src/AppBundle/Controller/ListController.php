<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListController
 * @package AppBundle\Controller
 * @Route("auth")
 */
class ListController extends Controller
{
    /**
     * @Route("/", name="welcome")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
//        $characters = [
//            'Daenerys Targaryen' => 'Emilia Clarke',
//            'Jon Snow'           => 'Kit Harington',
//            'Arya Stark'         => 'Maisie Williams',
//            'Melisandre'         => 'Carice van Houten',
//            'Khal Drogo'         => 'Jason Momoa',
//            'Tyrion Lannister'   => 'Peter Dinklage',
//            'Ramsay Bolton'      => 'Iwan Rheon',
//            'Petyr Baelish'      => 'Aidan Gillen',
//            'Brienne of Tarth'   => 'Gwendoline Christie',
//            'Lord Varys'         => 'Conleth Hill',
//        ];
//
//        echo ($request->attributes->get('_route'));
//        print_r($request->query->all());
//
//        return $this->render('auth/index.html.twig', ['characters' => $characters]);

        return new Response('ttt');
    }
}
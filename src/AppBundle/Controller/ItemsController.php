<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Form\ItemType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ItemController
 * @package AppBundle\Controller
 */
class ItemsController extends Controller
{
    /**
     * @Route("/item", name="item")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('code', TextType::class)
            ->add('collection', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $item = new Item();

            $item->setTitle($data['title']);
            $item->setDescription($data['description']);
            $item->setCode($data['code']);
            $item->setCollection($data['collection']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
        }

        // replace this example code with whatever you need
        return $this->render('item/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/item/{id}", name="oneItem")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function onItemAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Item');
        $item = $repository->find($id);
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Item $item */
            $item = $form->getData();

            if ($form->get('changeOwner')->isClicked()) {
                dump($form->get('changeOwner')->getName());

                $item->setUser(1);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            $this->get('session')->getFlashBag()->add('update', 'Mise à jour effectué');
            $this->redirectToRoute('oneItem');
        }

        return $this->render('default/item/one.html.twig', ['form' => $form->createView() ]);
    }
}

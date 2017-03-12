<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Item controller.
 *
 * @Route("linkedin")
 */
class ItemController extends Controller
{
    /**
     * Lists all item entities.
     *
     * @Route("/", name="linkedin_index")
     * @Method("GET")
     * @return Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('AppBundle:Item')->findAll();

        return $this->render('item/index.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     * Creates a new item entity.
     *
     * @Route("/new", name="linkedin_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function newAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush($item);

            return $this->redirectToRoute('linkedin_show', array('id' => $item->getId()));
        }

        return $this->render('item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a item entity.
     *
     * @Route("/{id}", name="linkedin_show")
     * @Method("GET")
     * @param Item $item
     * @return Response
     */
    public function showAction(Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);

        return $this->render('item/show.html.twig', array(
            'item' => $item,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing item entity.
     *
     * @Route("/{id}/edit", name="linkedin_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function editAction(Request $request, Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm(ItemType::class, $item);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /** @var Item $item */
            $item = $editForm->getData();

            if ($editForm->get('changeOwner')->isClicked()) {
                dump($editForm->get('changeOwner')->isClicked());
                dump($editForm->get('changeOwner')->getName());
die();
                $item->setUser(1);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('linkedin_edit', array('id' => $item->getId()));
        }

        return $this->render('item/edit.html.twig', array(
            'item' => $item,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a item entity.
     *
     * @Route("/{id}", name="linkedin_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Item $item)
    {
        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush($item);
        }

        return $this->redirectToRoute('linkedin_index');
    }

    /**
     * Creates a form to delete a item entity.
     *
     * @param Item $item The item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Item $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('linkedin_delete', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

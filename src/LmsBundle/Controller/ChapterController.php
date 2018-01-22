<?php

namespace LmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use LmsBundle\Entity\Chapter;
use LmsBundle\Form\ChapterType;

/**
 * Chapter controller.
 *
 * @Route("/chapter")
 */
class ChapterController extends Controller
{
    /**
     * Lists all Chapter entities.
     *
     * @Route("/", name="chapter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chapters = $em->getRepository('LmsBundle:Chapter')->findAll();

        return $this->render('chapter/index.html.twig', array(
            'chapters' => $chapters,
        ));
    }

    /**
     * Creates a new Chapter entity.
     *
     * @Route("/new", name="chapter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $chapter = new Chapter();
        $form = $this->createForm('LmsBundle\Form\ChapterType', $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapter);
            $em->flush();

            return $this->redirectToRoute('chapter_show', array('id' => $chapter->getId()));
        }

        return $this->render('chapter/new.html.twig', array(
            'chapter' => $chapter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Chapter entity.
     *
     * @Route("/{id}", name="chapter_show")
     * @Method("GET")
     */
    public function showAction(Chapter $chapter)
    {
        $deleteForm = $this->createDeleteForm($chapter);

        return $this->render('chapter/show.html.twig', array(
            'chapter' => $chapter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Chapter entity.
     *
     * @Route("/{id}/edit", name="chapter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Chapter $chapter)
    {
        $deleteForm = $this->createDeleteForm($chapter);
        $editForm = $this->createForm('LmsBundle\Form\ChapterType', $chapter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapter);
            $em->flush();

            return $this->redirectToRoute('chapter_edit', array('id' => $chapter->getId()));
        }

        return $this->render('chapter/edit.html.twig', array(
            'chapter' => $chapter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Chapter entity.
     *
     * @Route("/{id}", name="chapter_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Chapter $chapter)
    {
        $form = $this->createDeleteForm($chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chapter);
            $em->flush();
        }

        return $this->redirectToRoute('chapter_index');
    }

    /**
     * Creates a form to delete a Chapter entity.
     *
     * @param Chapter $chapter The Chapter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Chapter $chapter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chapter_delete', array('id' => $chapter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

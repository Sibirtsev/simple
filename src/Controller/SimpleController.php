<?php

namespace App\Controller;

use App\Entity\Simple;
use App\Form\SimpleType;
use App\Repository\SimpleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/simple")
 */
class SimpleController extends Controller
{
    /**
     * @Route("/", name="simple_index", methods="GET")
     */
    public function index(SimpleRepository $simpleRepository): Response
    {
        return $this->render('simple/index.html.twig', ['simples' => $simpleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="simple_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $simple = new Simple();
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($simple);
            $em->flush();

            return $this->redirectToRoute('simple_index');
        }

        return $this->render('simple/new.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simple_show", methods="GET")
     */
    public function show(Simple $simple): Response
    {
        return $this->render('simple/show.html.twig', ['simple' => $simple]);
    }

    /**
     * @Route("/{id}/edit", name="simple_edit", methods="GET|POST")
     */
    public function edit(Request $request, Simple $simple): Response
    {
        $form = $this->createForm(SimpleType::class, $simple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('simple_edit', ['id' => $simple->getId()]);
        }

        return $this->render('simple/edit.html.twig', [
            'simple' => $simple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="simple_delete", methods="DELETE")
     */
    public function delete(Request $request, Simple $simple): Response
    {
        if ($this->isCsrfTokenValid('delete'.$simple->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($simple);
            $em->flush();
        }

        return $this->redirectToRoute('simple_index');
    }
}

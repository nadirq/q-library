<?php
declare(strict_types=1);

namespace App\Controller;


use App\Entity\Book;
use App\Form\BookType;
use App\Form\EmailTemplateType;
use App\Repository\BookRepository;
use Doctrine\ORM\AbstractQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    /**
     * @return Response
     *
     * @Route("/", name="qlibrary_index", methods={"GET"}, )
     */
    public function index(BookRepository $bookRepository): Response
    {

        $books = $bookRepository->findAll();

        return $this->render('qlibrary/index.html.twig', ['books' => $books]);
    }

    /**
     * @Route("/new", name="qlibrary_new", methods={"GET", "POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute("qlibrary_index");
        }

        return $this->render('qlibrary\new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/edit", name="qlibrary_edit", methods={"GET", "POST"})
     *
     * @param Book    $book
     * @param Request $request
     *
     * @return Response
     */
    public function edit(Book $book, Request $request): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'all right');

            return $this->render('qlibrary/new.html.twig', ['form' => $form->createView()]);
        }

        return $this->render('qlibrary/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/show", name="qlibrary_show", methods={"GET"})
     *
     * @param Book $book
     *
     * @return Response
     */
    public function show(Book $book, Request $request): Response
    {
        return $this->render('qlibrary/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/search", name="qlibrary_search", methods={"GET"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function search(BookRepository $bookRepository, Request $request): Response
    {
        /** @var Book[] $source */
        $source = $bookRepository->searchAllByName($request->get('q'));
        $result = [];

        foreach ($source as $row) {
            $result[$row->getName()] = $this->generateUrl("qlibrary_show", ["id" => $row->getId()]);
        }

        if ($request->isXmlHttpRequest()) {
            return $this->json(
                $result
            );
        } else {
            return $this->render('qlibrary/search.html.twig', ['books' => $source]);
        }
    }

    /**
     * @Route("/{id}/delete", name="qlibrary_delete", methods={"POST"})
     *
     * @param Book $book
     *
     * @return Response
     */
    public function delete(Book $book): Response
    {
        $em =$this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('qlibrary_index');
    }
}
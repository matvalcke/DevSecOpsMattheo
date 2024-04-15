<?php

namespace App\Controller;

use App\Entity\Gift;
use App\Form\GiftType;
use App\Repository\GiftRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class GiftController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private GiftRepository $giftRepository;

    public function __construct(EntityManagerInterface $entityManager, GiftRepository $giftRepository)
    {
        $this->entityManager = $entityManager;
        $this->giftRepository = $giftRepository;
    }

    #[Route('/', name: 'gift')]
    public function index(): Response
    {
        $gifts = $this->giftRepository->findAll();
        return $this->render('gift/index.html.twig', [
            'gifts' => $gifts
        ]);
    }

    #[Route('/gift/new', name: 'gift_new')]
    public function new(Request $request): Response
    {
        $gift = new Gift();

        $form = $this->createForm(GiftType::class, $gift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($gift);
            $this->entityManager->flush();

            return $this->redirectToRoute('gift');
        }

        return $this->render('gift/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/gift/edit/{id}/{redirect}', name: 'gift_edit')]
    public function edit(Request $request, Gift $gift, string $redirect): Response
    {
        $form = $this->createForm(GiftType::class, $gift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute($redirect);
        }

        return $this->render('gift/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/gift/delete/{id}/{redirect}', name: 'gift_delete')]
    public function delete(Request $request, Gift $gift, string $redirect): Response
    {
        $this->entityManager->remove($gift);
        $this->entityManager->flush();

        return $this->redirectToRoute($redirect);
    }
}

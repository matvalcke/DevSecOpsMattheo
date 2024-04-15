<?php

namespace App\Controller;

use App\Entity\GiftList;
use App\Form\GiftListType;
use App\Repository\GiftListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class GiftListController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private GiftListRepository $giftListRepository;

    public function __construct(EntityManagerInterface $entityManager, GiftListRepository $giftListRepository)
    {
        $this->entityManager = $entityManager;
        $this->giftListRepository = $giftListRepository;
    }

    #[Route('/gift/list', name: 'gift_list')]
    public function index(): Response
    {
        $giftLists = $this->giftListRepository->findAll();
        return $this->render('gift_list/index.html.twig', [
            'giftLists' => $giftLists
        ]);
    }

    #[Route('/gift/list/new', name: 'gift_list_new')]
    public function new(Request $request): Response
    {
        $giftList = new GiftList();

        $form = $this->createForm(GiftListType::class, $giftList);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($giftList);
            $this->entityManager->flush();
            return $this->redirectToRoute('gift_list');
        }

        return $this->render('gift_list/new.html.twig',[
            'form' => $form
        ]);
    }

    #[Route('/gift/list/edit/{id}', name: 'gift_list_edit')]
    public function edit(Request $request, GiftList $giftList): Response
    {
        $form = $this->createForm(GiftListType::class, $giftList);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->flush();
            return $this->redirectToRoute('gift_list');
        }

        return $this->render('gift_list/edit.html.twig',[
            'form' => $form
        ]);
    }

    #[Route('/gift/list/delete/{id}', name: 'gift_list_delete')]
    public function delete(Request $request, GiftList $giftList): Response
    {
        $this->entityManager->remove($giftList);
        $this->entityManager->flush();
        return $this->redirectToRoute('gift_list');
    }
}

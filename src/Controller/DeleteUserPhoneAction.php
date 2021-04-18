<?php

namespace App\Controller;

use App\Entity\UserPhone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserPhoneAction
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route("/user-phone/{id}", name: "user-phone_delete", methods: ["DELETE"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(UserPhone::class);
        $telephones = $repository->find($id);

        if($telephones === null)
        return new Response(status: Response::HTTP_NOT_FOUND);

        $this->entityManager->remove($telephones);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}

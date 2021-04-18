<?php

namespace App\Controller;

use App\Entity\UserAddress;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserAddressAction
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route("/user-address/{id}", name: "user-address_delete", methods: ["DELETE"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(UserAddress::class);
        $teleAddresss = $repository->find($id);

        if($teleAddresss === null)
        return new Response(status: Response::HTTP_NOT_FOUND);

        $this->entityManager->remove($teleAddresss);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}

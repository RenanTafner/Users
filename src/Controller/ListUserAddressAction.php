<?php

namespace App\Controller;

use App\Entity\UserAddress;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListUserAddressAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/user-address", methods: ["GET"])]
    public function __invoke(): Response
    {
        
        $repository = $this->entityManager->getRepository(UserAddress::class);
        $useraddresss = $repository->findAll();
        $response = $this->serializer->serialize($useraddresss, 'json');
        return JsonResponse::fromJsonString($response);
    }
}

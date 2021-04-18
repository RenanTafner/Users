<?php

namespace App\Controller;

use App\Entity\UserPhone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListUserPhoneAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/user-phone", methods: ["GET"])]
    public function __invoke(): Response
    {
        
        $repository = $this->entityManager->getRepository(UserPhone::class);
        $userphones = $repository->findAll();
        $response = $this->serializer->serialize($userphones, 'json');
        return JsonResponse::fromJsonString($response);
    }
}

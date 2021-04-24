<?php

namespace App\Controller;

use App\Entity\UserPhone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetUserPhoneAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/user-phone/{id}", name: "user-phone_get", methods: ["GET"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(UserPhone::class);
        $userPhone = $repository->find($id);

        if (null === $userPhone) {
            return new JsonResponse([
                'error' => 'User Phone not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return JsonResponse::fromJsonString($this->serializer->serialize($userPhone, 'json'));
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserAction
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route("/users/{id}", methods: ["PUT"])]
    public function __invoke(int $id, Request $request): Response
    {
        $requestContent = json_decode($request->getContent(), true);

        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->find($id);

        $user->setNome($requestContent['nome']);
        $user->setEmail($requestContent['sobreNome']);
        $user->setEmail($requestContent['email']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}

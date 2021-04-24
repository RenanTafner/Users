<?php

namespace App\Controller;

use App\Entity\UserAddress;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserAddressAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RouterInterface $router,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route("/user-address", methods: ["POST"])]
    public function __invoke(Request $request): Response
    {

        
        $data = $request->getContent();
  
        $repository = $this->entityManager->getRepository(UserAddress::class);
        
        $conn = $this->entityManager->getConnection();

        $sql = 'SELECT * FROM user_address WHERE user_id = :user ';

        $user = $data !== null ? json_decode($data) : [];


        if(isset($user->user))
        {
          $userAddress = $conn->prepare($sql);
          $userAddress->execute(['user' => $user->user ]);
          
          $dataAddress = $userAddress->fetchAllAssociative();

          if(count($dataAddress) > 0)
          return new JsonResponse(['message' => 'Usuário ja possui endereço'], Response::HTTP_BAD_REQUEST);
        }
     
        $address = $this->serializer->deserialize($request->getContent(), UserAddress::class, 'json');
        
        $errors = $this->validator->validate($address);

        if (count($errors) > 0) {
            $violations = array_map(function(ConstraintViolationInterface $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()
                ];
            }, iterator_to_array($errors));

            $response = [
                'error' => 'As informações enviadas estão incorretas',
                'violations' => $violations
            ];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($address);
        $this->entityManager->flush();

        return new JsonResponse([
            'status' => 'ok'
        ], Response::HTTP_CREATED, [
            'Location' => $this->router->generate('user-address_get', [
                'id' => $address->getId()
            ])
        ]);
    }
}

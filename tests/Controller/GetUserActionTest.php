<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserActionTest extends TestCase
{
    public function test_get_user_should_return_200(): void
    {
        // preparando meu cenário
        $user = new User();
        $user->setNome('Nome User de teste');
        $user->setSobrenome('Sobrenome User de teste');
        $user->setEmail('Email User de teste');
        $this->em->persist($user);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'GET', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // conferindo o cenário
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_should_return_404(): void
    {
        $this->client->request(method: 'GET', uri: '/users/1000');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}

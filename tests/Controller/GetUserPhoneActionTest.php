<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Entity\UserPhone;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserPhoneActionTest extends TestCase
{
    public function test_get_user_phone_should_return_200(): void
    {
        // preparando meu cenário
        $user = new User();
        $user->setNome('Nome User de teste');
        $user->setSobrenome('Sobrenome User de teste');
        $user->setEmail('Email User de teste');
        $this->em->persist($user);
        $this->em->flush();

        $userPhone = new UserPhone();
        $userPhone->setDDD('031');
        $userPhone->setNumber('985011913');
        $userPhone->setUser($user);
        $this->em->persist($userPhone);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'GET', uri: '/user-phone/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->client->request(method: 'DELETE', uri: '/user-phone/1');
        $this->client->request(method: 'DELETE', uri: '/users/1');

        // conferindo o cenário
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_phone_should_return_404(): void
    {
        $this->client->request(method: 'GET', uri: '/user-phone/1000');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}

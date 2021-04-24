<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ListUserActionTest extends TestCase
{
    public function test_get_list_user_should_return_count_1(): void
    {
        // preparando meu cenário
        $user = new User();
        $user->setNome('Nome User de teste');
        $user->setSobrenome('Sobrenome User de teste');
        $user->setEmail('Email User de teste');
        $this->em->persist($user);
        $this->em->flush();

        // executando o cenário
        $usersJson = $this->client->request(method: 'GET', uri: '/users');

        $usersArray = json_decode($usersJson, true);

        // conferindo o cenário
        $this->assertGreaterThan(0, count($usersArray));

        $this->client->request(method: 'DELETE', uri: '/users/1');

    }

}

<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ListUserActionTest extends TestCase
{
    public function test_get_list_user_should_return_count_1(): void
    {
   
        $this->client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'nome' => 'Primeiro teste funcional de nome',
                'sobrenome' => 'Sobrenome do primeiro teste funcional',
                'email' => 'Email do primeiro teste funcional'
            ])
        );

        // executando o cenário
        $usersJson = $this->client->request(method: 'GET', uri: '/users');
        
        $body       = $this->client->getResponse()->getContent();

        $body = json_decode($body);

        // conferindo o cenário
        $this->assertGreaterThan(0, count($body));

    }

}

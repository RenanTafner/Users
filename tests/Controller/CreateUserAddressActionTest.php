<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class CreateUserAddressActionTest extends WebTestCase
{


    public function test_create_user_address(): void
    {
        $client = static::createClient();

        $client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'nome' => 'Primeiro teste funcional de nome',
                'sobrenome' => 'Sobrenome do primeiro teste funcional',
                'email' => 'Email do primeiro teste funcional'
            ])
        );

         $client->request(method: 'GET', uri: '/users');

         $user = $client->getResponse()->getContent();

         if($user !== null)
          $user = json_decode($user);
        else
          $user = [];  

         $userId = count($user) > 0 ? $user[0]->id: 0;


        $client->request(method: 'POST', uri: '/user-address',
            content: json_encode([
                "user"=>  $userId,
                "rua"=>"Rua Olimpia",
                "numero"=>"123",
                "complemento"=>"casa 1",
                "bairro"=>"centro",
                "cidade"=>"Belo Horizonte",
                "estado"=>"MG"
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        
        $this->assertSame(Response::HTTP_CREATED, $statusCode);

        $client->request(method: 'DELETE', uri: '/user-address/1');
        $client->request(method: 'DELETE', uri: '/users/'. $userId);

    }

    public function test_create_user_address_with_invalid_data(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/user-address',
            content: json_encode([
                "rua"=>"Rua Olimpia"
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
    }
}

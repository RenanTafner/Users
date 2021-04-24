<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Entity\UserAddress;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ListUserAddressActionTest extends TestCase
{
    public function test_get_list_user_address_should_return_count_1(): void
    {
   
        $this->client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'nome' => 'Primeiro teste funcional de nome',
                'sobrenome' => 'Sobrenome do primeiro teste funcional',
                'email' => 'Email do primeiro teste funcional'
            ])
        );

        $this->client->request(method: 'GET', uri: '/users');

        $user = $this->client->getResponse()->getContent();

        if($user !== null)
         $user = json_decode( $user );
       else
         $user = [];  

        
        $userId = count($user) > 0 ? $user[0]->id : 0;

        $this->client->request(method: 'POST', uri: '/user-address',
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

        // executando o cenário
        $usersJson = $this->client->request(method: 'GET', uri: '/user-address');
        
        $body       = $this->client->getResponse()->getContent();

        $body = json_decode($body);

        // conferindo o cenário
        $this->assertGreaterThan(0, count($body));

    }

}

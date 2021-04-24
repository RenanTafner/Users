<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use App\Entity\UserAddress;
use App\Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

final class DeleteUserAddressActionTest extends TestCase
{
    public function test_delete_user_address_should_return_no_content(): void
    {
        // preparando meu cenário
        $user = new User();
        $user->setNome('Nome User de teste');
        $user->setSobrenome('Sobrenome User de teste');
        $user->setEmail('Email User de teste');
        $this->em->persist($user);
        $this->em->flush();

        $userAddress = new UserAddress();
        $userAddress->setUser($user);
        $userAddress->setRua('Rua Olimpia');
        $userAddress->setNumero('123');
        $userAddress->setComplemento('casa 1');
        $userAddress->setBairro('centro');
        $userAddress->setCidade('Belo Horizonte');
        $userAddress->setEstado('MG');

        $this->em->persist($userAddress);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'DELETE', uri: '/user-address/1');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->client->request(method: 'DELETE', uri: '/users/1');
        // conferindo o cenário
        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }
}

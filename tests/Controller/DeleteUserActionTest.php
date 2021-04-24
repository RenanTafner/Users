<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

final class DeleteUserActionTest extends TestCase
{
    public function test_delete_user_should_return_no_content(): void
    {
        // preparando meu cenário
        $user = new User();
        $user->setNome('Nome User de teste');
        $user->setSobrenome('Sobrenome User de teste');
        $user->setEmail('Email User de teste');
        $this->em->persist($user);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'DELETE', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // conferindo o cenário
        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }
}

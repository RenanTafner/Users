<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use App\Entity\UserPhone;
use App\Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

final class DeleteUserPhoneActionTest extends TestCase
{
    public function test_delete_user_phone_should_return_no_content(): void
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
        $this->client->request(method: 'DELETE', uri: '/user-phone/1');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->client->request(method: 'DELETE', uri: '/users/1');
        // conferindo o cenário
        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }
}

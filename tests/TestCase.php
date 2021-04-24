<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\User;
use App\Entity\UserPhone;
use App\Entity\UserAddress;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    protected EntityManagerInterface $em;
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $tool = new SchemaTool($this->em);
        $userMetadata = $this->em->getClassMetadata(User::class);
        $userPhoneMetadata = $this->em->getClassMetadata(UserPhone::class);
        $userAddressMetadata = $this->em->getClassMetadata(UserAddress::class);
        $tool->dropDatabase();
        try {
            $tool->createSchema([$userMetadata]);
            $tool->createSchema([$userPhoneMetadata]);
            $tool->createSchema([$userAddressMetadata]);
        } catch (ToolsException $e) {
            $this->fail('Impossível criar o banco de dados: "' . $e->getMessage() . '"');
        }
    }
}

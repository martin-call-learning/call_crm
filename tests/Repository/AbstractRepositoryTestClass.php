<?php

namespace App\Tests\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractRepositoryTestClass extends KernelTestCase {

    /**
     * @var EntityManager
     */
    protected EntityManager $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }


    protected function tearDown(): void {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        unset($this->entityManager);
    }

}
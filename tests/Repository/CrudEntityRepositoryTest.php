<?php
namespace App\Tests\Repository;

use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\FundingType;

class CrudEntityRepositoryTest extends KernelTestCase {

    /**
    * @var EntityManager
    */
    private EntityManager $entityManager;

    /**
    * {@inheritDoc}
    */
    protected function setUp(): void {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
        ->get('doctrine')
        ->getManager();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws NotSupported
     */
    public function testFindNotDeleted() {

        // Adding a deleted entity.
        $entity = (new FundingType())
            ->setCreatedAt(new DateTimeImmutable())
            ->setDeletedAt(new DateTimeImmutable())
            ->setName("Funding Type deleted");

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        // Adding a not deleted entity.
        $entity = (new FundingType())
            ->setCreatedAt(new DateTimeImmutable())
            ->setName("Funding Type not deleted");

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        // Using the tested method.
        $undeletedEntities = $this->entityManager
            ->getRepository(FundingType::class)
            ->findNotDeleted();

        // Asserts.
        $this->assertCount(1, $undeletedEntities, "The 'CrudEntityRepository::findNotDeleted' function returns too much values");
        $this->assertNull($undeletedEntities[0]->getDeletedAt());
    }

    protected function tearDown(): void {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        unset($this->entityManager);
    }
}
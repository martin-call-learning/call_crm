<?php
namespace App\Tests\Repository;

use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Formation;

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
        // Test with a deleted entity, replace with your actual entity fields
        $entity = (new Formation())->setDeletedAt(new DateTimeImmutable());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        // Test with a not deleted entity
        $entity = (new Formation())->setDeletedAt(null);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $entities = $this->entityManager
            ->getRepository(Formation::class)
            ->findNotDeleted();

        $this->assertCount(1, $entities);
        $this->assertNull($entities[0]->getDeletedAt());
    }

    protected function tearDown(): void {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
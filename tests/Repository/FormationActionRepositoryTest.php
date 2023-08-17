<?php

namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Entity\FormationAction;
use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FormationActionRepositoryTest extends AbstractRepositoryTestClass {

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws NotSupported
     */
    public function testFindAllGroupedByFormation()
    {
        $repository = $this->entityManager->getRepository(FormationAction::class);

        // Creating entites.

        $formation = (new Formation())
            ->setName("Test Formation")
            ->setCode("TEST")
            ->setCreatedAt(new DateTimeImmutable());

        $this->entityManager->persist($formation);
        $this->entityManager->flush();

        $entity = (new FormationAction())
            ->setFormation($formation)
            ->setPrice(0)
            ->setDuration(new DateInterval("P1Y"))
            ->setExpectedStudentCount(0)
            ->setLevelRequired(0)
            ->setCreatedAt(new DateTimeImmutable())
            ->setDeletedAt(new DateTimeImmutable());


        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $entity = (new FormationAction())
            ->setFormation($formation)
            ->setPrice(0)
            ->setDuration(new DateInterval("P1Y"))
            ->setExpectedStudentCount(0)
            ->setLevelRequired(0)
            ->setCreatedAt(new DateTimeImmutable());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $results = $repository->findAllGroupedByFormation();

        // Your assertions here
        $this->assertIsArray($results);
        $this->assertCount(1, $results);
        foreach ($results as $action) {
            self::assertNull($action->getDeletedAt());
        }
        // Add more assertions based on your expected results
    }

}
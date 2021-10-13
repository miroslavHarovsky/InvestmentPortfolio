<?php declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\EntityManagerService;
use Nettrine\ORM\EntityManagerDecorator;

abstract class Repository
{
    use \Nette\SmartObject;

    /**
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    private EntityManagerDecorator $entityManager;

    /**
     *
     * @var \App\Model\EntityManagerService
     */
    private \App\Model\EntityManagerService $entityManagerService;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityManagerService = new EntityManagerService($entityManager);
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    protected abstract function save($entity);

    /**
     * @return \Nettrine\ORM\EntityManagerDecorator
     */
    public function getEntityManager(): EntityManagerDecorator
    {
        return $this->entityManager;
    }
    /**
     * @return \App\Model\EntityManagerService
     */
    public function getEntityManagerService(): \App\Model\EntityManagerService
    {
        return $this->entityManagerService;
    }
}
<?php declare(strict_types=1);

namespace App\Model\Repository;

use Nette\Utils\ArrayHash;
use Nettrine\ORM\EntityManagerDecorator;

abstract class Repository
{
    use \Nette\SmartObject;

    /**
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    private EntityManagerDecorator $entityManager;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Nette\Utils\ArrayHash $data
     */
    public abstract function save(ArrayHash $data);

    /**
     * @return \Nettrine\ORM\EntityManagerDecorator
     */
    public function getEntityManager(): EntityManagerDecorator
    {
        return $this->entityManager;
    }
}
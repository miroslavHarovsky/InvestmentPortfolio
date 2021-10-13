<?php declare(strict_types=1);

namespace App\Model;

use Nettrine\ORM\EntityManagerDecorator;

class EntityManagerService
{
    use \Nette\SmartObject;

    private array $arraysToSelect = [];

    private array $entitiesArray = [];

    private array $entity = [];

    /**
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    public EntityManagerDecorator $entityManager;

    public function __construct(EntityManagerDecorator $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Nettrine\ORM\EntityManagerDecorator
     */
    public function getEntityManager(): EntityManagerDecorator
    {
        return $this->entityManager;
    }

    /**
     * @param string         $groupFolderName
     * @param string         $entityName
     * @param array|false[]  $criteria
     * @param array|string[] $orderBy
     *
     * @return array
     */
    public function getArrayToSelect(
        string $groupFolderName,
        string $entityName,
        array $criteria = ['disabled' => false],
        array $orderBy = ['id' => 'desc']
    ): array {
        if (isset($this->arraysToSelect[$entityName]['result']) &&
            $this->arraysToSelect[$entityName]['criteria'] == $criteria &&
            $this->arraysToSelect[$entityName]['orderBy'] == $orderBy) {

            return $this->arraysToSelect[$entityName]['result'];
        }
        $entities = $this->entityManager->getRepository("App\Model\Entity\\$groupFolderName\\$entityName")->findBy(
            $criteria,
            $orderBy
        );

        $result = [];

        foreach ($entities as $entity) {
            $result[$entity->getId()] = $entity->getName();
        }

        $this->arraysToSelect[$entityName]['result'] = $result;
        $this->arraysToSelect[$entityName]['criteria'] = $criteria;
        $this->arraysToSelect[$entityName]['orderBy'] = $orderBy;

        return $result;
    }

    /**
     * @param string $groupFolderName
     * @param string $entityName
     * @param array  $criteria
     * @param array  $orderBy
     *
     * @return array|mixed|object[]
     */
    public function getEntities(
        string $groupFolderName,
        string $entityName,
        array $criteria = ['disabled' => false],
        array $orderBy = ['id' => 'desc']
    ) {
        if (isset($this->entitiesArray[$entityName]['result']) &&
            $this->entitiesArray[$entityName]['criteria'] == $criteria &&
            $this->entitiesArray[$entityName]['orderBy'] == $orderBy) {

            return $this->entitiesArray[$entityName]['result'];
        }
        $entities = $this->entityManager->getRepository("App\Model\Entity\\$groupFolderName\\$entityName")->findBy(
            $criteria,
            $orderBy
        );
        $this->entitiesArray[$entityName]['result'] = $entities;
        $this->entitiesArray[$entityName]['criteria'] = $criteria;
        $this->entitiesArray[$entityName]['orderBy'] = $orderBy;

        return $entities;
    }

    /**
     * @param string $groupFolderName
     * @param string $entityName
     * @param int    $entityId
     *
     * @return mixed|object
     * @throws \Exception
     */
    public function getEntity(
        string $groupFolderName,
        string $entityName,
        int $entityId
    ) {
        if (isset($this->entity[$entityName]['result']) &&
            $this->entity[$entityName]['entityId'] == $entityId) {

            return $this->entity[$entityName]['result'];
        }
        $entity = $this->entityManager->getRepository("App\Model\Entity\\$groupFolderName\\$entityName")->findBy(
            ['id' => $entityId, 'disabled' => false]
        );
        if (!$entity) {
            throw new \Exception(
                "Empty array in getEntity method, param: entityName = $entityName; entityId = $entityId", 404
            );
        }
        $this->entity[$entityName]['result'] = $entity[0];
        $this->entity[$entityName]['entityId'] = $entityId;

        return $entity[0];
    }

}
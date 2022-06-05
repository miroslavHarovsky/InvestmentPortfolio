<?php declare(strict_types=1);

namespace App\Model\Repository;

use Nette\Utils\ArrayHash;

class User extends Repository
{
    /**
     * @throws \ReflectionException
     */
    public function save(ArrayHash $data): \App\Model\Entity\User
    {
        $em = $this->getEntityManager();
        $em->getRepository(\App\Model\Entity\User::class);
        $entity = new \App\Model\Entity\User($data);
        $em->persist($entity);
        $em->flush();

        return $entity;

    }

    /**
     * @param string $email
     *
     * @return \App\Model\Entity\User|null
     */
    public function getByEmail(string $email): ?\App\Model\Entity\User
    {
        $entity = $this->getEntityManager()->getRepository(\App\Model\Entity\User::class)->findOneBy(
            ['email' => $email]
        );

        return $entity;

    }
}
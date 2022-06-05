<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
    use \Nette\SmartObject;
    /**
     *
     * @var \Nettrine\ORM\EntityManagerDecorator
     * @inject
     */
    public \Nettrine\ORM\EntityManagerDecorator $entityManager;


    /**
     * @return \Nettrine\ORM\EntityManagerDecorator
     */
    public function getEntityManager(): \Nettrine\ORM\EntityManagerDecorator
    {
        return $this->entityManager;
    }
}

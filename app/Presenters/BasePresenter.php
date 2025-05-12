<?php
declare(strict_types=1);

namespace App\Presenters;

use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
	public function __construct(
		private readonly EntityManagerInterface $entityManager,
	) {
		parent::__construct();
	}

	protected function getEntityManager(): EntityManagerInterface
	{
		return $this->entityManager;
	}
}

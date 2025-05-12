<?php declare(strict_types=1);

namespace App\Model\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Nette\Utils\ArrayHash;

abstract class Repository
{
	use \Nette\SmartObject;

	public function __construct(
		protected readonly EntityManagerInterface $entityManager,
	) {}

	abstract public function save(ArrayHash $data);

	protected function getEntityManager(): EntityManagerInterface
	{
		return $this->entityManager;
	}
}

<?php declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Utils\ArrayHash;
use Nette\Utils\Strings;
use Doctrine\ORM\Mapping as ORM;
#[ORM\MappedSuperclass]
abstract class Entity
{
    use \Nette\SmartObject;

	/**
	 * @param \Nette\Utils\ArrayHash $data
	 *
	 * @throws \ReflectionException
	 */
    public function __construct(ArrayHash $data)
    {
        $this->setData($data);

    }

    /**
     * @param \Nette\Utils\ArrayHash $data
     *
     * @return \App\Model\Entity\Entity
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function setData(ArrayHash $data): Entity
    {
        $className = get_class($this);
        $reflectionClass = new \ReflectionClass($className);
        $entity = new $className;
        foreach ($data as $key => $value) {
            $method = 'set' . Strings::firstUpper($key);
            if ($reflectionClass->hasMethod($method)) {
                if ($value instanceof \DateTime) {
                    $value = new \Nette\Utils\DateTime($value->format(DATE_ATOM));
                }
                call_user_func(array($entity, $method), $value);
            }
        }

        return $entity;

    }
}
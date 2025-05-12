<?php

namespace App\Model\Service;

use App\Model\Repository\User;
use Nette\Http\IResponse;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class Authenticator implements \Nette\Security\Authenticator
{

    public function __construct(private readonly User $userRepository, private readonly Passwords $passwords)
    {
    }

	/**
	 * @param string $username
	 * @param string $password
	 *
	 * @return \Nette\Security\IIdentity
	 * @throws \Exception
	 */
    function authenticate(string $username, string $password): IIdentity
    {
        $user = $this->userRepository->getByEmail($username);

        if (!$user) {
            throw new \Exception('User not found.', IResponse::S403_FORBIDDEN);
        }
        if (!$this->passwords->verify($password, $user->getHash())) {
            throw new \Exception('Invalid password.', IResponse::S403_FORBIDDEN);
        }

        return new SimpleIdentity(
            $user->getId(),
            $user->getRole(),
            ['name' => $user->getName()]
        );
    }
}
<?php

namespace App\AdminModule\Components\forms;

use App\Model\Service\Authenticator;
use JetBrains\PhpStorm\NoReturn;
use Nette\Security\AuthenticationException;
use Nette\Utils\ArrayHash;


class SignIn extends \Nette\Application\UI\Form
{

    /**
     * @inject
     * @var Authenticator
     */

    function __construct()
    {
        parent::__construct();
        $this->populate();
    }

    protected function populate(): SignIn
    {
        $this->addEmail('email', 'Email')
            ->setRequired();

        $this->addPassword('password', 'Password')
            ->setRequired();

        $this->addSubmit("send", 'Uložit');

        $this->onSuccess[] = array($this, 'process');

        return $this;
    }


    /**
     * @param \App\AdminModule\Components\forms\SignIn $form
     * @param \Nette\Utils\ArrayHash                   $values
     *
     * @return void
     * @throws \Nette\Application\AbortException
     */
    #[NoReturn]
    public function process(SignIn $form, ArrayHash $values)
    {
        try {
            $this->getPresenter()->getUser()->login($values->email, $values->password);
            $this->getPresenter()->flashMessage('Uživatel byl přihlášen', 'success');
            $this->getPresenter()->redirect('Homepage:');
        } catch (AuthenticationException $e) {
            $form->addError('Špatné jméno nebo heslo');
            $this->getPresenter()->redirect('this');
        }
    }

}

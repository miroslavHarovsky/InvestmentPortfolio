<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\forms\ISignInFactory;

class SignPresenter extends BasePresenter
{
    /**
     * @inject
     * @var \App\AdminModule\Components\forms\ISignInFactory
     */
    public ISignInFactory $signInFactory;

    /**
     * @return void
     * @throws \Nette\Application\AbortException
     */
    public function actionIn(){
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect('Homepage:');
        }
    }

    protected function createComponentSignInForm()
    {
        return $this->signInFactory->create();
    }
}

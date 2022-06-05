<?php

namespace App\AdminModule\Presenters;


abstract class BasePresenter extends \App\Presenters\BasePresenter
{

    /**
     * @throws \Nette\Application\AbortException
     */
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn() && $this->getName() !== "Admin:Sign") {
            $this->redirect('Sign:in');
        }
    }

    /**
     * @throws \Nette\Application\AbortException
     */
    public function handleLogout()
    {
        $this->getUser()->logout();
        $this->redirect(':Front:Homepage:');
    }

}



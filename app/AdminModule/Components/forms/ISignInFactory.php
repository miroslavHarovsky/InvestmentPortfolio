<?php

namespace App\AdminModule\Components\forms;

use Nettrine\ORM\EntityManagerDecorator;

interface ISignInFactory
{
    public function create(): SignIn;

}

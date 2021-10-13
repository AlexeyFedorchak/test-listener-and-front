<?php

namespace Listeners;

use Validators\IValidator;

interface IListener
{
    public function listen(): IValidator;
}

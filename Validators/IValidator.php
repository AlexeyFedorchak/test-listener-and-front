<?php

namespace Validators;

interface IValidator
{
    public function validate(): IParser;
}

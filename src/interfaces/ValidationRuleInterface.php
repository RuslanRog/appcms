<?php

namespace src\interface;


interface ValidationRuleInterface
{
    public function validateRule($value);
    public function getErrorMessage();
}

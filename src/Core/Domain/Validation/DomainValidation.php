<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value, string $exceptMessage = null) 
    {
        if (empty($value))
            throw new EntityValidationException($exceptMessage ?? "Não deve ser nulo");
    }   
}
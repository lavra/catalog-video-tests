<?php

namespace tests\Unit\Domain\Validation;

use Throwable;
use PHPUnit\Framework\TestCase;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\Exception\EntityValidationException;


class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = '';
            DomainValidation::notNull($value);

            $this->assertTrue(false);

        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        try {
            $value = '';
            DomainValidation::notNull($value, 'Exception: Mensagem personalizada.');

            $this->assertTrue(false);

        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th, 'Exception: Mensagem personalizada.');
        }
    }

    public function testStringMaxLength()
    {
        try {
            $value = 'Test';
            DomainValidation::strMaxLength($value, 3, 'Exception: string max 5 length');

            $this->assertTrue(false);

        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th, 'Exception: string max 5 length');
        }
    }

    public function testStringMinLength()
    {
        try {
            $value = 'Test';
            DomainValidation::strMinLength($value, 8, 'Exception: string min 8 length');

            $this->assertTrue(false);

        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th, 'Exception: string min 8 length');
        }
    }
}
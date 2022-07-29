<?php

namespace Core\Domain\Entity;

use Core\Domain\Validation\DomainValidation;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;


class Category
{
    use MethodsMagicsTrait;

    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    )
    {
        $this->validate();
    }

    /**
     * Ativar categoria
     *
     * @return void
     */
    public function activate(): void
    {
        $this->isActive = true;
    }


    public function disabled(): void
    {
        $this->isActive = false;
    }

    /**
     * Update data category
     * Ex: description como null ($this->description = $description ?? $this->description)
     *
     * @param string $name
     * @param string $description
     * @return void
     */
    public function update(string $name, string $description = ''): void
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    public function validate()
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->description);
    }
}
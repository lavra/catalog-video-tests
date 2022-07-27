<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;

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
        if (empty($this->name)) {
            throw new EntityValidationException("Nome inválido");
        }


        if (strlen($this->name) > 255 || strlen($this->name) <= 2) {
            throw new EntityValidationException("O nome tem que ser maior que 2 e menor que 50 caracteries");
        }

        if ($this->description != '' && (strlen($this->description) > 255 || strlen($this->description) < 3)) {
            throw new EntityValidationException("A descrição tem que ser maior que 3 e menor que 250 caracteries");
        }

    }
}
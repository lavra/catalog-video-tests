<?php

namespace Core\Application\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\CategoryCreateInputDto;
use Core\Application\DTO\Category\CategoryCreateOutputDto;

class CategoryCreateUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryCreateInputDto $input): CategoryCreateOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );

        $new_category = $this->repository->insert($category);

        return new CategoryCreateOutputDto(
            id: $new_category->id(),
            name: $new_category->name,
            description: $category->description,
            is_active: $category->isActive,
        );
    }
}
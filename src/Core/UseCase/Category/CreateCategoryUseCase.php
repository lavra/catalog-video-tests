<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        $category = new Category(
            id: 'sdfsd',
            name: 'name cat',
            description: 'desc cat',
            isActive: true,
            createdAt: '2023-01-01 00:00:00',
        );


        $this->repository->insert($category);


    }
}
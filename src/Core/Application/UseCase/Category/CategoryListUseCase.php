<?php 

namespace Core\Application\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\{
    CategoryListInputDto,
    CategoryListOutputDto
};

class CategoryListUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryListInputDto $input): CategoryListOutputDto
    {

        $category = $this->repository->findById($input->id);

        return new CategoryListOutputDto(
            id: $category->id,
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive,
        );
    }

}

<?php 

namespace Core\Application\DTO\Category;


class ListCategoriesOutputDto
{
    public function __construct(
        public array $items,
        public int $total
    ) { }
}
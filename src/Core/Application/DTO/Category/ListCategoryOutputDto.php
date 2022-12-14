<?php 

namespace Core\Application\DTO\Category;

class ListCategoryOutputDto
{
    /**
     * Construtor DTO Category
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @param boolean $is_active
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $is_active = true,
        public string $created_at = '',
    ) { }
}
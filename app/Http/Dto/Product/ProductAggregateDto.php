<?php

namespace App\Http\Dto\Product;

use App\Http\Dto\BaseDto;
use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Unit\UnitDto;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;

class ProductAggregateDto extends BaseDto
{
	public function __construct(
        public int $id,
		public string $name,
        public string|null $description,
        public array $images,
        public CategoryDto $category,
        public UnitDto $unit,
        public string|null $barcode,
        public float $price,
        public float $costPrice,
        public float $stockQuantity,
        public float $minQuantity,
        public bool $isActive,
        public string|null $userCreatedName,
        public string|null $userUpdatedName,
        public Carbon $createdAt,
        public Carbon $updatedAt
    ) {}
}
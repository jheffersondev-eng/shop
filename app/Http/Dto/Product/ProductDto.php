<?php

namespace App\Http\Dto\Product;

use App\Http\Dto\BaseDto;
use Illuminate\Http\UploadedFile;

class ProductDto extends BaseDto
{
	public function __construct(
		public string $name,
        public string|UploadedFile|null $image,
        public string $description,
        public int $categoryId,
        public int $unitId,
        public string $barcode,
        public float $price,
        public float $costPrice,
        public float $stockQuantity,
        public float $minQuantity,
        public bool $isActive
    ) {}
}
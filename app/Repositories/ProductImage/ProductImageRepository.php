<?php

namespace App\Repositories\ProductImage;

use App\Models\ProductImage;
use App\Repositories\BaseRepository;
use App\Repositories\ProductImage\IProductImageRepository;
use Illuminate\Support\Facades\DB;

class ProductImageRepository extends BaseRepository implements IProductImageRepository
{
    public function __construct()
    {
        parent::__construct(new ProductImage());
    }

    public function GetProductImages(int $productId)
    {
        return DB::table('product_images as pi')
            ->where('pi.product_id', $productId)
            ->whereNull('pi.deleted_at')
            ->select(
                'pi.id',
                'pi.product_id',
                'pi.image',
            )
            ->get();
    }
}

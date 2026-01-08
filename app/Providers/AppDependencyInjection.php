<?php

namespace App\Providers;

use App\Repositories\UserDetail\UserDetailRepository;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Profile\IProfileRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\ProductImage\ProductImageRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductImage\IProductImageRepository;
use App\Repositories\Unit\IUnitRepository;
use App\Repositories\Unit\UnitRepository;
use App\Services\About\AboutService;
use App\Services\About\IAboutService;
use App\Services\Category\CategoryService;
use App\Services\Category\ICategoryService;
use App\Services\Dashboard\DashboardService;
use App\Services\Dashboard\IDashboardService;
use App\Services\Login\ILoginService;
use App\Services\Login\LoginService;
use App\Services\ProductImage\IProductImageService;
use App\Services\ProductImage\ProductImageService;
use App\Services\Product\IProductService;
use App\Services\Product\ProductService;
use App\Services\Profile\IProfileService;
use App\Services\User\IUserService;
use App\Services\Profile\ProfileService;
use App\Services\UnitService\IUnitService;
use App\Services\UnitService\UnitService;
use App\Services\User\UserService;
use Illuminate\Contracts\Foundation\Application;

class AppDependencyInjection
{
    public static function register(Application $app)
    {
        //register bindings repositorys
        $app->bind(IUserDetailRepository::class, UserDetailRepository::class);
        $app->bind(IUserRepository::class, UserRepository::class);
        $app->bind(IProfileRepository::class, ProfileRepository::class);
        $app->bind(ICategoryRepository::class, CategoryRepository::class);
        $app->bind(IUnitRepository::class, UnitRepository::class);
        $app->bind(IProductRepository::class, ProductRepository::class);
        $app->bind(IProductImageRepository::class, ProductImageRepository::class);

        //register bindings services
        $app->bind(ILoginService::class, LoginService::class);
        $app->bind(IUserService::class, UserService::class);
        $app->bind(IProfileService::class, ProfileService::class);
        $app->bind(ICategoryService::class, CategoryService::class);
        $app->bind(IUnitService::class, UnitService::class);
        $app->bind(IProductService::class, ProductService::class);
        $app->bind(IProductImageService::class, ProductImageService::class);
        $app->bind(IDashboardService::class, DashboardService::class);
        $app->bind(IAboutService::class, AboutService::class);
    }
}
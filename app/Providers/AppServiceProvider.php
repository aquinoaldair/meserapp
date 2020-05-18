<?php

namespace App\Providers;

use App\Models\CustomModel;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Commerce\CommerceRepository;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Cost\CostRepository;
use App\Repositories\Cost\CostRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Printer\PrinterRepository;
use App\Repositories\Printer\PrinterRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Station\StationRepository;
use App\Repositories\Station\StationRepositoryInterface;
use App\Repositories\Stock\StockRepository;
use App\Repositories\Stock\StockRepositoryInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\Table\TableRepository;
use App\Repositories\Table\TableRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CommerceRepositoryInterface::class, CommerceRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(TableRepositoryInterface::class, TableRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(CostRepositoryInterface::class, CostRepository::class);
        $this->app->bind(PrinterRepositoryInterface::class, PrinterRepository::class);
        $this->app->bind(StationRepositoryInterface::class, StationRepository::class);
    }


    public function boot()
    {

    }
}

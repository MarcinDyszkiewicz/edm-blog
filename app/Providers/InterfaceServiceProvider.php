<?php

namespace App\Providers;

use App\Repositories\ParagraphRepository;
use App\Repositories\ParagraphRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Services\ParagraphService;
use App\Services\ParagraphServiceInterface;
use App\Services\PostService;
use App\Services\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ParagraphServiceInterface::class, ParagraphService::class);
        $this->app->bind(ParagraphRepositoryInterface::class, ParagraphRepository::class);
    }
}

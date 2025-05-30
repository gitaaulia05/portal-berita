<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\NewsServices;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share data 'kategori' ke semua view yang pakai 'partials.navbar' misal
        View::composer('Pengguna.Main.main', function ($view) {
            $newsService = app(NewsServices::class);
            $kategori = collect($newsService->dataKategori() ?? []);
            $view->with('kategori', $kategori);
        });
    }
}

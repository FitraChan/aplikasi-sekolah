<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    View::composer('layout.header', function ($view) {

        $jumlahNotifikasi = 0;
        $pesanNotifikasi = collect();

        if (auth()->check()) {

            $pesanNotifikasi = DB::table('tb_pesan')
                ->where('status', 0)
                ->orderByDesc('id')
                ->limit(10)
                ->get();

            $jumlahNotifikasi = DB::table('tb_pesan')
                ->where('status', 0)
                ->count();
        }

        $view->with(compact(
            'jumlahNotifikasi',
            'pesanNotifikasi'
        ));
    });
}
}

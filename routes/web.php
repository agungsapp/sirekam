<?php

use App\Http\Controllers\Bidan\DashboardController;
use App\Http\Controllers\Bidan\PasienLamaController;
use App\Http\Controllers\Bidan\PemeriksaanAwalController;
use App\Http\Controllers\Bidan\PendaftarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienBaruController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Bidan\DashboardPage;
use App\Livewire\Bidan\DataFaqPage;
use App\Livewire\Bidan\DataGalleryPage;
use App\Livewire\Bidan\DataObatPage;
use App\Livewire\Bidan\DataPasienPage;
use App\Livewire\Bidan\DataPendaftarPage;
use App\Livewire\Bidan\DataRuangPage;
use App\Livewire\Bidan\DataTestimoniPage;
use App\Livewire\Bidan\DetailPasienPage;
use App\Livewire\Bidan\DetailPendaftarPage;
use App\Livewire\Bidan\HistoryBerobatPage;
use App\Livewire\Bidan\PemeriksaanAwalPage;
use App\Livewire\Bidan\PemeriksaanLanjutPage;
use App\Livewire\Bidan\ProfilePage;
use App\Models\PemeriksaanLanjut;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('bidan')->name('bidan.')->middleware('auth')->group(function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('pendaftar', DataPendaftarPage::class)->name('pendaftar');
    Route::get('detail-pendaftaran/{id}', DetailPendaftarPage::class)->name('detail-pendaftaran');
    Route::get('data-ruang', DataRuangPage::class)->name('data-ruang');
    Route::get('data-obat', DataObatPage::class)->name('data-obat');
    Route::get('data-pasien', DataPasienPage::class)->name('data-pasien');
    Route::get('detail-pasien/{id}', DetailPasienPage::class)->name('detail-pasien');
    Route::get('history-berobat', HistoryBerobatPage::class)->name('history-berobat');
    Route::get('pemeriksaan-awal/{id}', PemeriksaanAwalPage::class)->name('pemeriksaan-awal');
    Route::get('pemeriksaan-lanjut/{id}', PemeriksaanLanjutPage::class)->name('pemeriksaan-lanjut');
    // Route::resource('pemeriksaan-awal', PemeriksaanAwalController::class);
    Route::get('profile', ProfilePage::class)->name('profile');

    // manejemen konten
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('data-gallery', DataGalleryPage::class)->name('data-gallery');
        Route::get('data-faq', DataFaqPage::class)->name('data-faq');
        Route::get('data-testimoni', DataTestimoniPage::class)->name('data-testimoni');
    });
});

Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::resource('pasien-baru', PasienBaruController::class);
Route::resource('pasien-lama', PasienLamaController::class);

Route::get('test', function () {
    return view('pasien.layouts.app');
});


require __DIR__ . '/auth.php';

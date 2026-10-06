<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SterilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout/main');
});
Route::get('/dashboard', [DashboardController::class, 'viewDashboard'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('steril-bulanan/data', [DashboardController::class, 'grafikSterilBulanan']);
    Route::get('list-alat-kadaluarsa', [DashboardController::class, 'getDataAlatKadaluarsa']);
    Route::get('view-steril-ulang/{kodeSteril}', [DashboardController::class, 'getViewSterilUlang']);
    Route::get('detail-alat-steril/{kodeSteril}', [DashboardController::class, 'detailDataAlatSteril']);
    Route::post('edit-data-steril-alat-kadaluarsa', [DashboardController::class, 'editDataSterilAlatKadaluarsa']);
});

Route::get('/', [HomepageController::class, 'viewHome'])->name('daftar-steril');
// Route::get('/dashboard/main', [HomepageController::class, 'viewHome'])->name('daftar-steril');

Route::prefix('homepage')->group(function () {
    Route::get('daftar-steril-homepage', [HomepageController::class, 'getDataSteril']);
     Route::get('/cetak-form-steril/{kodeSteril}', [HomepageController::class, 'cetakFormSteril']);
     Route::get('view-detail-data-steril/{kodeSteril}', [HomepageController::class, 'viewDetailDataSteril']);
     Route::get('detail-alat-steril/{kodeSteril}', [HomepageController::class, 'detailDataAlatSteril']);
     Route::get('view-ajuan-data-steril', [HomepageController::class, 'viewAjuanSteril'])->name('ajuan-steril');
     Route::post('tambah-ajuan-steril', [HomepageController::class, 'simpanAjuanSteril']);
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('proses-login', [LoginController::class, 'loginProcess']);
Route::post('logout', [LoginController::class, 'logoutProcess']);

Route::group(['prefix' => 'master-data', 'middleware' => ['auth']], function () {
    Route::get('alat', [MasterController::class, 'viewDataAlat'])->name('data-alat');
    Route::get('list-alat', [MasterController::class, 'getDataAlat']);
    Route::post('simpan-list-alat', [MasterController::class, 'addDataAlat']);
    Route::post('edit-list-alat', [MasterController::class, 'editDataAlat']);
    Route::get('/hapus/{idAlat}', [MasterController::class, 'hapusDataAlat']);

    Route::get('ruang', [MasterController::class, 'viewDataRuang'])->name('data-ruang');
    Route::get('list-ruang', [MasterController::class, 'getDataRuang']);
    Route::post('simpan-list-ruang', [MasterController::class, 'addDataRuang']);
    Route::post('edit-list-ruang', [MasterController::class, 'editDataRuang']);
    Route::get('/hapus-data-ruang/{idRuang}', [MasterController::class, 'hapusDataRuang']);

    Route::get('user', [MasterController::class, 'viewDataUser'])->name('data-user');
    Route::get('list-user', [MasterController::class, 'getDataUser']);
    Route::post('simpan-list-user', [MasterController::class, 'addDataUser']);
    Route::post('edit-list-user', [MasterController::class, 'editDataUser']);
    Route::post('reset-password-user', [MasterController::class, 'resetPassUser']);
    Route::get('/hapus-data-user/{idUser}', [MasterController::class, 'hapusDataUser']);
});

Route::prefix('steril')->group(function () {
    Route::get('view-steril', [SterilController::class, 'viewSteril'])->middleware('auth')->name('data-steril');
    Route::get('tambah-data-steril', [SterilController::class, 'viewTambahSteril'])->middleware('auth');
    Route::get('list-steril', [SterilController::class, 'getDataSteril'])->middleware('auth');
    Route::get('list-ruangan', [SterilController::class, 'getListRuangan']);
    Route::get('list-user-cssd', [SterilController::class, 'getListUserCssd']);
    Route::post('list-alat', [SterilController::class, 'getListAlat']);
    Route::post('simpan-data-steril', [SterilController::class, 'simpanDataSteril'])->middleware('auth');
    Route::get('detail-data-steril/{kodeSteril}', [SterilController::class, 'detailDataSteril'])->middleware('auth')->name('detail-data-steril');
    Route::get('detail-alat-steril/{kodeSteril}', [SterilController::class, 'detailDataAlatSteril'])->middleware('auth');
    Route::get('list-alat-steril-edit/{kodeSteril}', [SterilController::class, 'detailDataAlatSterilEdit'])->middleware('auth');
    Route::post('edit-detail-alat-steril', [SterilController::class, 'editDataListAlatSteril'])->middleware('auth');
    Route::post('edit-data-steril', [SterilController::class, 'editDataSteril'])->middleware('auth');
    Route::post('edit-data-pengambilan', [SterilController::class, 'editDataPengambilanSteril']);
    Route::get('view-edit-data-steril/{kodeSteril}', [SterilController::class, 'viewEditDataSteril']);
    Route::get('view-data-pengambilan/{kodeSteril}', [SterilController::class, 'viewDataPengambilan']);
    Route::get('/hapus-data-steril/{kodeSteril}', [SterilController::class, 'hapusDataSteril'])->middleware('auth');
    Route::get('/hapus-data-alat-steril/{idSteril}', [SterilController::class, 'hapusDataAlatSteril'])->middleware('auth');
    Route::get('/cetak-form-steril/{kodeSteril}', [SterilController::class, 'cetakFormSteril'])->middleware('auth');
});

Route::prefix('laporan')->group(function () {
    Route::get('view-laporan', [LaporanController::class, 'viewLaporan'])->middleware('auth')->name('laporan');
    Route::get('view-laporan-bulan', [LaporanController::class, 'viewLaporanBulan'])->middleware('auth')->name('laporan-bulan');
    Route::get('/cetak-laporan-bulan', [LaporanController::class, 'cetakLaporanBulan'])->middleware('auth');
    Route::get('/cetak-laporan-tahun', [LaporanController::class, 'cetakLaporanTahun'])->middleware('auth');
    Route::get('/export-sterilisasi-bulan', [LaporanController::class, 'export'])->middleware('auth')->name('export-excel');
    Route::get('/export-sterilisasi-tahun', [LaporanController::class, 'exportTahun'])->middleware('auth')->name('export-excel-tahun');
    Route::get('view-laporan-tahun', [LaporanController::class, 'viewLaporanTahun'])->middleware('auth')->name('laporan-tahun');
});

Route::prefix('grafik')->group(function () {
    Route::get('view-grafik', [GrafikController::class, 'viewGrafik'])->name('grafik');
    
   
});


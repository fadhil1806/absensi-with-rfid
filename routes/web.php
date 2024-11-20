<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RekapAbsenSiswaController;
use App\Http\Controllers\RekapAbsenTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\SilatController;
use App\Http\Controllers\FutsalController;
use App\Http\Controllers\JurnalAgendaKelasController;
use App\Http\Controllers\PramukaController;
use App\Http\Controllers\KodingController;
use App\Http\Controllers\PlatformMerdekaMengajarController;
use App\Http\Controllers\RekapFutsalController;
use App\Http\Controllers\RekapJurnalAgendaKelasController;
use App\Http\Controllers\RekapKodingController;
use App\Http\Controllers\RekapPlatformMerdekaMengajarController;
use App\Http\Controllers\RekapPramukaController;
use App\Http\Controllers\RekapRobotikController;
use App\Http\Controllers\RekapSilatController;
use App\Http\Controllers\RobotikController;

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    '/data-card/add' => false
]);

Route::get('/', [HomeController::class, 'index'])->middleware('check.pin')->name('home');
Route::post('/masuk', [HomeController::class, 'masuk'])->middleware('check.pin')->name('home.masuk');
Route::post('/pulang', [HomeController::class, 'pulang'])->middleware('check.pin')->name('home.pulang');

use App\Http\Controllers\DataCardController;

// Rute for UI
Route::get('/data-card-siswa', action: [DataCardController::class, 'indexSiswa'])->middleware('check.pin')->name('card');
Route::get('/data-card-tendik', action: [DataCardController::class, 'indexTendik'])->middleware('check.pin')->name('card');
Route::get('/data-card-alert', action: [DataCardController::class, 'indexAlert'])->middleware('check.pin')->name('card.alert');

//Tap data
Route::get('/card/scan', [DataCardController::class, 'store'])->name('card.add');

// Get data
Route::get('/api/siswa', action: [DataCardController::class, 'getSiswa'])->name('data.siswa');
Route::get('/api/tendik', action: [DataCardController::class, 'getTendik'])->name('data.tendik');

// Register card in alert
Route::get('/data-card-alert/add/{id}', action: [DataCardController::class, 'addAlert'])->middleware('check.pin')->name('card.alert.add');
Route::post('/data-card/register/card/{id}', action: [DataCardController::class, 'addDataCard'])->name('card.add');

// Delete card data for users
Route::delete('/data-card/delete/{id}', [DataCardController::class, 'destroy
'])->name('card.delete');

Route::middleware(['auth', 'check.pin'])->group(function () {
    Route::controller(TendikController::class)->group(function () {
        Route::get('/tendik', 'index')->name('tendik');
        Route::get('/tendik-create', 'create');
        Route::post('/tendik-create', 'store')->name('tendik.perform');
        Route::post('/tendik-import', 'importTendik')->name('tendik.import');
        Route::get('/tendik-edit/{id}', 'edit')->name('tendik.edit');
        Route::put('/tendik-edit/{id}', 'update')->name('tendik.update');
        Route::delete('tendik/{id}', 'destroy')->name('tendik.delete');
    });
    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa', 'index')->name('siswa');
        Route::get('/siswa-cari', 'siswaFilter')->name('siswa.filter');
        Route::get('/siswa-create', 'create');
        Route::post('/siswa-create', 'store')->name('siswa.perform');
        Route::post('/siswa-import', 'importSiswa')->name('siswa.import');
        Route::get('/siswa-edit/{id}', 'edit')->name('siswa.edit');
        Route::put('/siswa-edit/{id}', 'update')->name('siswa.update');
        Route::delete('siswa/{id}', 'destroy')->name('siswa.delete');
    });
    Route::controller(IzinController::class)->group(function () {
        Route::get('/izin', 'index');
        Route::get('/izin-create', 'create');
        Route::post('/izin-create', 'store')->name('izin.perform');
        Route::get('/izin-edit/{id}', 'edit')->name('izin.edit');
        Route::put('/izin-edit/{id}', 'update')->name('izin.update');
        Route::delete('izin/{id}', 'destroy')->name('izin.delete');
    });
    Route::controller(WaktuController::class)->group(function () {
        Route::get('/waktu', 'index');
        Route::put('/waktu-edit/{id}', 'update')->name('waktu.update');
    });
    Route::controller(SilatController::class)->group(function () {
        Route::get('/silat', 'index')->name('silat');
        Route::get('/silat-create', 'create');
        Route::post('/silat-create', 'store')->name('silat.perform');
        Route::get('/silat-edit/{id}', 'edit')->name('silat.edit');
        Route::put('/silat-edit/{id}', 'update')->name('silat.update');
        Route::delete('silat/{id}', 'destroy')->name('silat.delete');
    });
    Route::controller(FutsalController::class)->group(function () {
        Route::get('/futsal', 'index')->name('futsal');
        Route::get('/futsal-create', 'create');
        Route::post('/futsal-create', 'store')->name('futsal.perform');
        Route::get('/futsal-edit/{id}', 'edit')->name('futsal.edit');
        Route::put('/futsal-edit/{id}', 'update')->name('futsal.update');
        Route::delete('futsal/{id}', 'destroy')->name('futsal.delete');
    });
    Route::controller(PramukaController::class)->group(function () {
        Route::get('/pramuka', 'index')->name('pramuka');
        Route::get('/pramuka-create', 'create');
        Route::post('/pramuka-create', 'store')->name('pramuka.perform');
        Route::get('/pramuka-edit/{id}', 'edit')->name('pramuka.edit');
        Route::put('/pramuka-edit/{id}', 'update')->name('pramuka.update');
        Route::delete('pramuka/{id}', 'destroy')->name('pramuka.delete');
    });
    Route::controller(KodingController::class)->group(function () {
        Route::get('/koding', 'index')->name('koding');
        Route::get('/koding-create', 'create');
        Route::post('/koding-create', 'store')->name('koding.perform');
        Route::get('/koding-edit/{id}', 'edit')->name('koding.edit');
        Route::put('/koding-edit/{id}', 'update')->name('koding.update');
        Route::delete('koding/{id}', 'destroy')->name('koding.delete');
    });
    Route::controller(RobotikController::class)->group(function () {
        Route::get('/robotik', 'index')->name('robotik');
        Route::get('/robotik-create', 'create');
        Route::post('/robotik-create', 'store')->name('robotik.perform');
        Route::get('/robotik-edit/{id}', 'edit')->name('robotik.edit');
        Route::put('/robotik-edit/{id}', 'update')->name('robotik.update');
        Route::delete('robotik/{id}', 'destroy')->name('robotik.delete');
    });
    Route::controller(JurnalAgendaKelasController::class)->group(function () {
        Route::get('/jurnal', 'index')->name('jurnal');
        Route::get('/jurnal-create', 'create');
        Route::post('/jurnal-create', 'store')->name('jurnal.perform');
        Route::get('/jurnal-edit/{id}', 'edit')->name('jurnal.edit');
        Route::put('/jurnal-edit/{id}', 'update')->name('jurnal.update');
        Route::delete('jurnal/{id}', 'destroy')->name('jurnal.delete');
    });
    Route::controller(PlatformMerdekaMengajarController::class)->group(function () {
        Route::get('/platform', 'index')->name('platform');
        Route::get('/platform-create', 'create');
        Route::post('/platform-create', 'store')->name('platform.perform');
        Route::get('/platform-edit/{id}', 'edit')->name('platform.edit');
        Route::put('/platform-edit/{id}', 'update')->name('platform.update');
        Route::delete('platform/{id}', 'destroy')->name('platform.delete');
    });
    Route::controller(RekapAbsenSiswaController::class)->group(function () {
        Route::get('/rekap-siswa', 'index')->name('rekap-siswa');
        Route::get('/filter-siswa', 'filter');
    });

    Route::controller(RekapAbsenTendikController::class)->group(function () {
        Route::get('/pin', 'pin')->name('pin');
        Route::post('/check-pin', 'checkPin')->name('check.pin');
        Route::post('/update-pin', 'updatePin')->middleware('check.pin')->name('update.pin');
        Route::get('/rekap-tendik', 'index')->middleware('check.pin')->name('rekap-tendik');
        Route::get('/filter-tendik', 'filter')->middleware('check.pin');
    });
    Route::controller(RekapSilatController::class)->group(function () {
        Route::get('/rekap-silat', 'index')->name('rekap-silat');
        Route::get('/filter-silat', 'filter');
    });
    Route::controller(RekapFutsalController::class)->group(function () {
        Route::get('/rekap-futsal', 'index')->name('rekap-futsal');
        Route::get('/filter-futsal', 'filter');
    });
    Route::controller(RekapPramukaController::class)->group(function () {
        Route::get('/rekap-pramuka', 'index')->name('rekap-pramuka');
        Route::get('/filter-pramuka', 'filter');
    });
    Route::controller(RekapKodingController::class)->group(function () {
        Route::get('/rekap-koding', 'index')->name('rekap-koding');
        Route::get('/filter-koding', 'filter');
    });
    Route::controller(RekapRobotikController::class)->group(function () {
        Route::get('/rekap-robotik', 'index')->name('rekap-robotik');
        Route::get('/filter-robotik', 'filter');
    });
    Route::controller(RekapJurnalAgendaKelasController::class)->group(function () {
        Route::get('/rekap-jak', 'index')->name('rekap-jak');
        Route::get('/filter-jak', 'filter');
    });
    Route::controller(RekapPlatformMerdekaMengajarController::class)->group(function () {
        Route::get('/rekap-pmm', 'index')->name('rekap-pmm');
        Route::get('/filter-pmm', 'filter');
    });
});

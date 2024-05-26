<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::ind


// Rute untuk menampilkan halaman login
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/starter', 'Home::starter', ['filter' => 'auth']);

 // Rute untuk proses login
 $routes->post('auth/processLogin', 'AuthController::processLogin', ['as' => 'auth/processLogin']);

$routes->group('/auth', function ($routes) {
   $routes->get('/', 'AuthController::index');
   $routes->post('login', 'AuthController::login');
   $routes->get('logout', 'AuthController::logout');
});

$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);


$routes->group('user', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'UserController::index');
   $routes->get('create', 'UserController::create');
   $routes->post('store', 'UserController::store');
   $routes->post('update/(:num)', 'UserController::update/$1');
   $routes->get('edit/(:num)', 'UserController::edit/$1');
   $routes->get('delete/(:num)', 'UserController::delete/$1');
   $routes->get('show/(:num)', 'UserController::show/$1');
});

$routes->group('karyawan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'KaryawanController::index');
   $routes->get('create', 'KaryawanController::create');
   $routes->post('store', 'KaryawanController::store');
   $routes->post('update/(:num)', 'KaryawanController::update/$1');
   $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
   $routes->get('delete/(:num)', 'KaryawanController::delete/$1');
   $routes->get('show/(:num)', 'KaryawanController::show/$1');
});

$routes->group('datarekening', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'DataRekeningController::index');
   $routes->get('create', 'DataRekeningController::create');
   $routes->post('store', 'DataRekeningController::store');
   $routes->post('update/(:num)', 'DataRekeningController::update/$1');
   $routes->get('edit/(:num)', 'DataRekeningController::edit/$1');
   $routes->get('delete/(:num)', 'DataRekeningController::destroy/$1');
   $routes->get('show/(:num)', 'DataRekeningController::show/$1');
});

$routes->group('rakbelanja', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'RakBelanjaController::index');
   $routes->get('create', 'RakBelanjaController::create');
   $routes->post('store', 'RakBelanjaController::store');
   $routes->post('update/(:num)', 'RakBelanjaController::update/$1');
   $routes->get('edit/(:num)', 'RakBelanjaController::edit/$1');
   $routes->get('delete/(:num)', 'RakBelanjaController::destroy/$1');
});

$routes->group('detailrak', ['filter' => 'auth'], function ($routes) {
   $routes->get('show/(:num)', 'DetailRakController::show/$1');
   $routes->get('create/(:num)', 'DetailRakController::create/$1');
   $routes->post('store', 'DetailRakController::store');
   $routes->post('update/(:num)', 'DetailRakController::update/$1');
   $routes->get('edit/(:num)', 'DetailRakController::edit/$1');
   $routes->get('delete/(:num)', 'DetailRakController::destroy/$1');
});

$routes->group('akun', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'AkunController::index');
   $routes->get('create', 'AkunController::create');
   $routes->post('store', 'AkunController::store');
   $routes->post('update/(:num)', 'AkunController::update/$1');
   $routes->get('edit/(:num)', 'AkunController::edit/$1');
   $routes->get('delete/(:num)', 'AkunController::destroy/$1');
});

$routes->group('kelompok', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'KelompokController::index');
   $routes->get('create', 'KelompokController::create');
   $routes->post('store', 'KelompokController::store');
   $routes->post('update/(:num)', 'KelompokController::update/$1');
   $routes->get('edit/(:num)', 'KelompokController::edit/$1');
   $routes->get('delete/(:num)', 'KelompokController::destroy/$1');
});

$routes->group('jenis', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'JenisController::index');
   $routes->get('create', 'JenisController::create');
   $routes->post('store', 'JenisController::store');
   $routes->post('update/(:num)', 'JenisController::update/$1');
   $routes->get('edit/(:num)', 'JenisController::edit/$1');
   $routes->get('delete/(:num)', 'JenisController::destroy/$1');
});

$routes->group('objek', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'ObjekController::index');
   $routes->get('create', 'ObjekController::create');
   $routes->post('store', 'ObjekController::store');
   $routes->post('update/(:num)', 'ObjekController::update/$1');
   $routes->get('edit/(:num)', 'ObjekController::edit/$1');
   $routes->get('delete/(:num)', 'ObjekController::destroy/$1');
});

$routes->group('rincianobjek', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'RincianObjekController::index');
   $routes->get('create', 'RincianObjekController::create');
   $routes->post('store', 'RincianObjekController::store');
   $routes->post('update/(:num)', 'RincianObjekController::update/$1');
   $routes->get('edit/(:num)', 'RincianObjekController::edit/$1');
   $routes->get('delete/(:num)', 'RincianObjekController::destroy/$1');
});

$routes->group('subrincian', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'SubRincianObjekController::index');
   $routes->get('create', 'SubRincianObjekController::create');
   $routes->post('store', 'SubRincianObjekController::store');
   $routes->post('update/(:num)', 'SubRincianObjekController::update/$1');
   $routes->get('edit/(:num)', 'SubRincianObjekController::edit/$1');
   $routes->get('delete/(:num)', 'SubRincianObjekController::destroy/$1');
   $routes->get('getKelompok/(:num)', 'SubRincianObjekController::getKelompok/$1');
   $routes->get('getJenis/(:num)', 'SubRincianObjekController::getJenis/$1');
   $routes->get('getObjek/(:num)', 'SubRincianObjekController::getObjek/$1');
   $routes->get('getRincianObjek/(:num)', 'SubRincianObjekController::getRincianObjek/$1');
});

$routes->group('penatausahaan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'PenatausahaanController::index');
   $routes->get('create', 'PenatausahaanController::create');
   $routes->post('store', 'PenatausahaanController::store');
   $routes->post('update/(:num)', 'PenatausahaanController::update/$1');
   $routes->get('edit/(:num)', 'PenatausahaanController::edit/$1');
   $routes->get('delete/(:num)', 'PenatausahaanController::destroy/$1');
});


$routes->group('urusan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'UrusanController::index');
   $routes->get('create', 'UrusanController::create');
   $routes->post('store', 'UrusanController::store');
   $routes->post('update/(:num)', 'UrusanController::update/$1');
   $routes->get('edit/(:num)', 'UrusanController::edit/$1');
   $routes->get('delete/(:num)', 'UrusanController::destroy/$1');
});

$routes->group('bidang_urusan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'BidangUrusanController::index');
   $routes->get('create', 'BidangUrusanController::create');
   $routes->post('store', 'BidangUrusanController::store');
   $routes->post('update/(:num)', 'BidangUrusanController::update/$1');
   $routes->get('edit/(:num)', 'BidangUrusanController::edit/$1');
   $routes->get('delete/(:num)', 'BidangUrusanController::destroy/$1');
});

$routes->group('program', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'ProgramController::index');
   $routes->get('create', 'ProgramController::create');
   $routes->post('store', 'ProgramController::store');
   $routes->post('update/(:num)', 'ProgramController::update/$1');
   $routes->get('edit/(:num)', 'ProgramController::edit/$1');
   $routes->get('delete/(:num)', 'ProgramController::destroy/$1');
   $routes->get('getBidangUrusan/(:num)', 'ProgramController::getBidangUrusan/$1');
});

$routes->group('kegiatan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'KegiatanController::index');
   $routes->get('create', 'KegiatanController::create');
   $routes->post('store', 'KegiatanController::store');
   $routes->post('update/(:num)', 'KegiatanController::update/$1');
   $routes->get('edit/(:num)', 'KegiatanController::edit/$1');
   $routes->get('delete/(:num)', 'KegiatanController::destroy/$1');
   $routes->get('getBidangUrusan/(:num)', 'KegiatanController::getBidangUrusan/$1');
   $routes->get('getProgram/(:num)', 'KegiatanController::getProgram/$1');
});

$routes->group('subkegiatan', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'SubkegiatanController::index');
   $routes->get('create', 'SubkegiatanController::create');
   $routes->post('store', 'SubkegiatanController::store');
   $routes->post('update/(:num)', 'SubkegiatanController::update/$1');
   $routes->get('edit/(:num)', 'SubkegiatanController::edit/$1');
   $routes->get('delete/(:num)', 'SubkegiatanController::destroy/$1');
   $routes->get('getBidangUrusan/(:num)', 'SubkegiatanController::getBidangUrusan/$1');
   $routes->get('getProgram/(:num)', 'SubkegiatanController::getProgram/$1');
   $routes->get('getKegiatan/(:num)', 'SubkegiatanController::getKegiatan/$1');
});

$routes->group('dpa', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'DPAController::index');
   $routes->get('create', 'DPAController::create');
   $routes->post('store', 'DPAController::store');
   $routes->post('update/(:num)', 'DPAController::update/$1');
   $routes->get('edit/(:num)', 'DPAController::edit/$1');
   $routes->get('delete/(:num)', 'DPAController::destroy/$1');
});

$routes->group('detaildpa', ['filter' => 'auth'], function ($routes) {
   $routes->get('show/(:num)', 'DetailDPAController::show/$1');
   $routes->get('create/(:num)', 'DetailDPAController::create/$1');
   $routes->post('store', 'DetailDPAController::store');

   $routes->put('update/(:num)', 'DetailDPAController::update/$1'); 
   $routes->get('edit/(:num)', 'DetailDPAController::edit/$1');
   $routes->get('delete/(:num)', 'DetailDPAController::destroy/$1');
   $routes->post('update_jumlah_perubahan/(:num)', 'DetailDPAController::update_jumlah_perubahan/$1');
   $routes->get('edit_jumlah_perubahan/(:num)', 'DetailDPAController::edit_jumlah_perubahan/$1');
});

$routes->group('detailpenatausahaan', ['filter' => 'auth'], function ($routes) {
   $routes->get('show/(:num)', 'DetailPenatausahaanController::show/$1');
   $routes->get('create/(:num)', 'DetailPenatausahaanController::create/$1');
   $routes->post('store', 'DetailPenatausahaanController::store');
   $routes->post('update/(:num)', 'DetailPenatausahaanController::update/$1');
   $routes->get('edit/(:num)', 'DetailPenatausahaanController::edit/$1');
   $routes->get('delete/(:num)', 'DetailPenatausahaanController::destroy/$1');
   $routes->get('create2/(:num)', 'DetailPenatausahaanController::create2/$1');
   $routes->post('store2', 'DetailPenatausahaanController::store2');
   $routes->post('update2/(:num)', 'DetailPenatausahaanController::update2/$1');
   $routes->get('edit2/(:num)', 'DetailPenatausahaanController::edit2/$1');
   $routes->get('delete2/(:num)', 'DetailPenatausahaanController::destroy2/$1');
   $routes->add('terima/(:num)', 'DetailPenatausahaanController::terima/$1');
   $routes->add('tolak/(:num)', 'DetailPenatausahaanController::tolak/$1');
   $routes->get('cetak/(:num)', 'DetailPenatausahaanController::cetak/$1');
});

$routes->group('keterangan', ['filter' => 'auth'], function ($routes) {
   $routes->get('show/(:num)', 'KeteranganController::show/$1');
   $routes->get('create/(:num)', 'KeteranganController::create/$1');
   $routes->post('store', 'KeteranganController::store');
   $routes->post('update/(:num)', 'KeteranganController::update/$1');
   $routes->get('edit/(:num)', 'KeteranganController::edit/$1');
   $routes->get('delete/(:num)', 'KeteranganController::destroy/$1');
});


$routes->group('detaildpa_subkegiatan', ['filter' => 'auth'], function ($routes) {
   $routes->get('showdetail/(:num)', 'DetailDPASubkegiatanController::showdetail/$1');
   $routes->get('create/(:num)', 'DetailDPASubkegiatanController::create/$1');
   $routes->post('store', 'DetailDPASubkegiatanController::store');
   $routes->post('update/(:num)', 'DetailDPASubkegiatanController::update/$1'); 
   $routes->get('edit/(:num)', 'DetailDPASubkegiatanController::edit/$1');
   $routes->get('delete/(:num)', 'DetailDPASubkegiatanController::destroy/$1');
   $routes->post('update_perubahan/(:num)', 'DetailDPASubkegiatanController::update_perubahan/$1');
   $routes->get('perubahan/(:num)', 'DetailDPASubkegiatanController::perubahan/$1');
});

$routes->group('verifikasi', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'VerifikasiController::index');
   $routes->get('create', 'VerifikasiController::create');
   $routes->post('store', 'VerifikasiController::store');
   $routes->post('update/(:num)', 'VerifikasiController::update/$1');
   $routes->get('edit/(:num)', 'VerifikasiController::edit/$1');
   $routes->get('destroy/(:num)', 'VerifikasiController::destroy/$1');
   $routes->get('preview_spj/(:segment)', 'VerifikasiController::preview_spj/$1');
   $routes->get('preview_kwintansi/(:segment)', 'VerifikasiController::preview_kwintansi/$1');
   $routes->get('download/(:num)', 'VerifikasiController::download/$1');
   $routes->add('terima/(:num)', 'VerifikasiController::terima/$1');
   $routes->add('tolak/(:num)', 'VerifikasiController::tolak/$1');
});

$routes->group('bp_kas_tunai', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'BPKasTunaiController::show');
   $routes->get('create', 'BPKasTunaiController::create');
   $routes->post('store', 'BPKasTunaiController::store');
   $routes->post('update/(:num)', 'BPKasTunaiController::update/$1');
   $routes->get('edit/(:num)', 'BPKasTunaiController::edit/$1');
   $routes->get('delete/(:num)', 'BPKasTunaiController::destroy/$1');
   $routes->get('cetak/(:num)', 'BPKasTunaiController::cetak/$1');

});

$routes->group('pajak', ['filter' => 'auth'], function ($routes) {
   $routes->get('/', 'PajakController::index');
   $routes->get('create', 'PajakController::create');
   $routes->post('store', 'PajakController::store');
   $routes->post('update/(:num)', 'PajakController::update/$1');
   $routes->get('edit/(:num)', 'PajakController::edit/$1');
   $routes->get('delete/(:num)', 'PajakController::destroy/$1');
});

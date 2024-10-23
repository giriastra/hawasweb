<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Pagging';
$route['logout'] = 'Web/logout';
$route['forum'] = 'Pagging/PaggingGlobal';
$route['chat_forum/(:any)'] = 'Pagging/ChatForum';
$route['detail_complaint/(:any)'] = 'Pagging/ComplaintDetail';
$route['pengguna'] = 'Pagging/PaggingGlobal';
$route['beranda'] = 'Pagging/Beranda';
$route['company'] = 'Pagging/PaggingGlobal';
$route['berita'] = 'Pagging/PaggingGlobal';
$route['setting'] = 'Pagging/PaggingGlobal';
$route['daerah'] = 'Pagging/daerah';
$route['partai'] = 'Pagging/PaggingGlobal';
$route['kabupaten/(:any)'] = 'Pagging/partial_daerah';
$route['kecamatan/(:any)'] = 'Pagging/partial_daerah';
$route['kelurahan/(:any)'] = 'Pagging/partial_daerah';
$route['announcement'] = 'Pagging/PaggingGlobal';
$route['pemilihan'] = 'Pagging/PaggingGlobal';
$route['calon/(:any)'] = 'Pagging/partial_pemilihan';
$route['tambahCalon'] = 'Utiliy/TambahCalon';
$route['quickcount'] = 'Pagging/PaggingGlobal';
$route['broadcast'] = 'Pagging/PaggingGlobal';
// $route['hitungcepat'] = 'Pagging/PaggingGlobal';
$route['hitungcepat'] = 'Pagging/HitungCepat';
$route['form_hitungcepat'] = 'Pagging/PaggingGlobal';
$route['maps_tps'] = 'Pagging/MapsTPS';
$route['maps_tps/(:any)'] = 'Pagging/MapsTPS';
$route['complaint'] = 'Pagging/PaggingGlobal';
$route['lokasi_kantor'] = 'Pagging/PaggingGlobal';
$route['tps'] = 'Pagging/PaggingGlobal';
$route['petugas/(:any)'] = 'Pagging/PetugasTps';
$route['tracking_status/(:any)'] = 'Pagging/TrackingStatus';
$route['lokasi_petugas/(:any)/(:any)/(:any)'] = 'Pagging/LokasiPetugas';
$route['lokasi_semua_petugas'] = 'Pagging/LokasiSemuaPetugasOnline';
$route['news_comment/(:any)'] = 'Pagging/newsComment';
$route['show_quickcount'] = 'Pagging/GetDataSuaraPeilihan';
$route['semua_petugas'] = 'Pagging/DaftarSemuaPetugas';
$route['user_manual'] = 'Pagging/PaggingGlobal';
$route['user_manual/(:any)'] = 'Pagging/PaggingGlobal';
$route['riwayat_pengaduan/(:any)'] = 'Pagging/RiwayatPengaduan';
$route['riwayat_lokasi_petugas/(:any)'] = 'Pagging/RiwayatLokasiPetugas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['sample_map']='Pagging/SampleMap';



// ANDROID
$route['user'] = 'user/User';
$route['global'] = 'GlobalCon';
$route['insertComment'] = 'user/User/insertComment';
$route['ChangePhotoProfile'] = 'user/User/ChangePhotoProfile';
$route['InputC1'] = 'user/Pilkada/InputC1';
$route['tesUpload'] = 'user/Pilkada/tesUpload';


//FORUM
$route['forum_android'] = 'user/Forum';
$route['event_pilkada'] = 'user/Pilkada';
$route['pengaduan'] = 'user/Pengaduan';


//GLOBAL
$route['managFirebase'] = 'GlobalCon/insertFirebaseID';
$route['loadDataSplashScreen'] = 'GlobalCon/loadDataSplashScreen';
$route['loadNews'] = 'GlobalCon/loadNews';
$route['about'] = 'GlobalCon/getDataCompany';
$route['inputBerita'] = 'GlobalCon/inputBerita';
$route['privacy-policy'] = 'Pagging/privacy';
$route['privacy-policy-hawas-petugas'] = 'Pagging/privacyPetugas';
$route['sendEmail'] = 'Login/sendEmail';

$route['enkrip'] = 'user/User/enkripsi';

<?php

use Illuminate\Support\Facades\Route;

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


//Đơn vị
Route::get('/lich_su_thao_tac', [\App\Http\Controllers\MainController::class, 'lich_su_thao_tac'])->name('lich_su_thao_tac');
Route::get('/danhsachdonvi', [\App\Http\Controllers\MainController::class, 'list_dv'])->name('danhsachdonvi');
Route::get('/themdonvi', [\App\Http\Controllers\MainController::class, 'add_dv'])->name('themdonvi');
Route::post('/themdonvi', [\App\Http\Controllers\MainController::class, 'store_dv'])->name('themdonvi_store');
Route::post('/themdv_ajax', [\App\Http\Controllers\MainController::class, 'store_dv_ajax'])->name('themdonvi_ajax');
Route::post('/dv/change/{donvi}', [\App\Http\Controllers\MainController::class, 'change_active'])->name('change_active_dv');
Route::post('/dv/edit_dv/{donvi}', [\App\Http\Controllers\MainController::class, 'edit_dv'])->name('edit_dv');
Route::delete('/dv/destroy', [\App\Http\Controllers\MainController::class, 'destroy']);

//Nhân Viên
//Route::get('/danhsachnhanvien', [\App\Http\Controllers\NguoithuchienController::class, 'list_nv']);
Route::get('/themnhanvien', [\App\Http\Controllers\NguoithuchienController::class, 'add_nv'])->name('themnhanvien');
Route::post('/themnhanvien', [\App\Http\Controllers\NguoithuchienController::class, 'store_nv'])->name('store_nv');
Route::post('/nv/change/{nguoithuchien}', [\App\Http\Controllers\NguoithuchienController::class, 'change_active'])->name('change_active_nv');
Route::post('/nv/edit_nv/{nguoithuchien}', [\App\Http\Controllers\NguoithuchienController::class, 'edit_nv'])->name('edit_nv');
Route::delete('/nv/destroy', [\App\Http\Controllers\NguoithuchienController::class, 'destroy']);

//chuc vu nguoi thuc hien
Route::post('/themchucvu', [\App\Http\Controllers\ChucvuController::class, 'store_cv'])->name('store_cv');
Route::post('/cv/change/{chucvu}', [\App\Http\Controllers\ChucvuController::class, 'change_active'])->name('change_active_cv');
Route::post('/cv/edit_cv/{chucvu}', [\App\Http\Controllers\ChucvuController::class, 'edit_cv'])->name('edit_cv');
Route::delete('/cv/destroy', [\App\Http\Controllers\ChucvuController::class, 'destroy']);

//Chương trình
Route::get('/danhsachloaichuongtrinh', [\App\Http\Controllers\LoaichuongtrinhController::class, 'list_ct']);
Route::get('/themloaichuongtrinh', [\App\Http\Controllers\LoaichuongtrinhController::class, 'add_ct'])->name('themloaichuongtrinh');
Route::post('/themloaichuongtrinh', [\App\Http\Controllers\LoaichuongtrinhController::class, 'store_ct']);
Route::post('/themloaichuongtrinh_ajax', [\App\Http\Controllers\LoaichuongtrinhController::class, 'store_ct_ajax'])->name('store_ct_ajax');
Route::post('/ct/change/{loaichuongtrinh}', [\App\Http\Controllers\LoaichuongtrinhController::class, 'change_active'])->name('change_active_ct');
Route::post('/ct/edit_ct/{loaichuongtrinh}', [\App\Http\Controllers\LoaichuongtrinhController::class, 'edit_ct'])->name('edit_ct');
Route::delete('/ct/destroy', [\App\Http\Controllers\LoaichuongtrinhController::class, 'destroy']);

//Yêu Cầu
Route::get('/danhsachyeucau', [\App\Http\Controllers\YeucauController::class, 'list_yc'])->name('danhsachyeucau');
Route::get('/themyeucau', [\App\Http\Controllers\YeucauController::class, 'add_yc'])->name('themyeucau');
Route::post('/themyeucau', [\App\Http\Controllers\YeucauController::class, 'store_yc'])->name('themyeucau_store');
Route::post('/addtamyc', [\App\Http\Controllers\YeucauController::class, 'store_tam_yc'])->name('store_tam_yc');
Route::post('/search_yc_with_date', [\App\Http\Controllers\YeucauController::class, 'search_yc_with_date']);
Route::post('/capnhat_pagethem', [\App\Http\Controllers\YeucauController::class, 'update_pagethem'])->name('update_pagethem');
Route::get('/yc/edit/{yeucauton}', [\App\Http\Controllers\YeucauController::class, 'edit_yeucau'])->name('edit_yeucau');
Route::post('/yc/capnhatyeucau', [\App\Http\Controllers\YeucauController::class, 'store_edit_yeucau'])->name('store_edit_yeucau');
Route::delete('/yc/destroy', [\App\Http\Controllers\YeucauController::class, 'destroy'])->name('destroy_yeucau');

//Yêu cầu thêm
Route::post('/themthuoctinhyc', [\App\Http\Controllers\YeucauController::class, 'store_thuoctinh_yc'])->name('store_thuoctinh_yc');
Route::post('/suathuoctinhyc', [\App\Http\Controllers\YeucauController::class, 'edit_thuoctinh_yc'])->name('edit_thuoctinh_yc');
Route::delete('/yck/destroy', [\App\Http\Controllers\YeucauController::class, 'destroy_yck'])->name('destroy_yck');

// báo cáo
Route::get('/baocao',[\App\Http\Controllers\BaocaoController::class,'index'])->name('baocao');
Route::get('/kybaocao',[\App\Http\Controllers\BaocaoController::class,'kybaocao'])->name('kybaocao');
Route::post('/kybaocao',[\App\Http\Controllers\BaocaoController::class,'them_kybaocao']);
Route::get('/xembaocao/{ky}',[\App\Http\Controllers\BaocaoController::class,'xembaocao'])->name('xembaocao_ky');
Route::post('/load_ky/',[\App\Http\Controllers\BaocaoController::class,'load_ky'])->name('load_ky');
Route::post('/chot_ky',[\App\Http\Controllers\BaocaoController::class,'chot_ky'])->name('chot_ky');
Route::delete('/ky/destroy',[\App\Http\Controllers\BaocaoController::class,'destroy'])->name('destroy_ky');
Route::get('/', [\App\Http\Controllers\BaocaoController::class,'index']);
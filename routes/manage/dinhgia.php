<?php
//Giá các loại đất
Route::resource('dmqdgiadat','DmQdGiaDatController');
Route::post('dmqdgiadat/delete','DmQdGiaDatController@destroy');

Route::get('thongtingiacacloaidat','GiaCacLoaiDatController@index');
Route::get('thongtingiacacloaidat/addlv1','GiaCacLoaiDatController@addlv1');
Route::get('thongtingiacacloaidat/editvitri','GiaCacLoaiDatController@editvitri');
Route::get('thongtingiacacloaidat/updatevitri','GiaCacLoaiDatController@updatevitri');
Route::get('thongtingiacacloaidat/storechirld','GiaCacLoaiDatController@storechirld');
Route::get('thongtingiacacloaidat/edithesok','GiaCacLoaiDatController@edithesok');
Route::get('thongtingiacacloaidat/updatehesok','GiaCacLoaiDatController@updatehesok');
Route::post('thongtingiacacloaidat/delete','GiaCacLoaiDatController@destroy');
Route::post('thongtingiacacloaidat/upgrade','GiaCacLoaiDatController@upgrade');
ROute::get('thongtingiacacloaidat/history','GiaCacLoaiDatController@showhis');

Route::get('reportsgiacldat','GiaCacLoaiDatController@show');

Route::get('timkiemthongtingiacacloaidat','GiaCacLoaiDatController@search');

//Giá đất địa bàn
Route::get('giadatdiaban','GiaDatDiaBanController@index');
Route::get('giadatdiaban/nhandulieutuexcel','GiaDatDiaBanController@nhandulieutuexcel');
Route::post('giadatdiaban/import_excel','GiaDatDiaBanController@importexcel');
Route::post('giadatdiaban/delete','GiaDatDiaBanController@multidelete');
Route::get('giadatdiaban/edittt','GiaDatDiaBanController@edit');
Route::post('giadatdiaban/update','GiaDatDiaBanController@update');
Route::post('giadatdiaban/destroy','GiaDatDiaBanController@destroy');
Route::post('giadatdiaban/add','GiaDatDiaBanController@store');
Route::post('giadatdiaban/congbo','GiaDatDiaBanController@congbo');
Route::post('giadatdiaban/huycongbo','GiaDatDiaBanController@huycongbo');
Route::post('giadatdiaban/checkmulti','GiaDatDiaBanController@checkmulti');
Route::get('giadatdiaban/prints','GiaDatDiaBanController@bcgiadatdiaban');

Route::resource('thongtugiadatdiaban','manage\giadatdiaban\TtGiaDatDiaBanController');
Route::post('thongtugiadatdiaban/delete','manage\giadatdiaban\TtGiaDatDiaBanController@destroy');

//danh mục đất theo phân loại
Route::resource('giadatphanloaidm','manage\giadatphanloai\GiaDatPhanLoaiDmController');
Route::post('giadatphanloaidm/delete','manage\giadatphanloai\GiaDatPhanLoaiDmController@destroy');

//giá đất theo phân loại
Route::get('giadatphanloai/print','manage\giadatphanloai\GiaDatPhanLoaiController@ketxuat');
Route::resource('giadatphanloai','manage\giadatphanloai\GiaDatPhanLoaiController');
Route::post('giadatphanloai/delete','manage\giadatphanloai\GiaDatPhanLoaiController@destroy');
Route::post('giadatphanloai/hoanthanh','manage\giadatphanloai\GiaDatPhanLoaiController@hoanthanh');
Route::post('giadatphanloai/huyhoanthanh','manage\giadatphanloai\GiaDatPhanLoaiController@huyhoanthanh');
Route::post('giadatphanloai/congbo','manage\giadatphanloai\GiaDatPhanLoaiController@congbo');
Route::get('timkiemgiadatphanloai','manage\giadatphanloai\GiaDatPhanLoaiController@search');
//Lệ phí trước bạ
Route::resource('nhomlephitruocba','NhomLePhiTruocBaController');
Route::get('nhomlephitruocba/edit','NhomLePhiTruocBaController@edit');
Route::post('nhomlephitruocba/update','NhomLePhiTruocBaController@update');

Route::resource('lephitruocba','LePhiTruocBaController');
Route::post('lephitruocba/delete','LePhiTruocBaController@destroy');

Route::post('lephitruocba/hoanthanh','LePhiTruocBaController@hoanthanh');
Route::post('lephitruocba/huyhoanthanh','LePhiTruocBaController@huyhoanthanh');
Route::post('lephitruocba/congbo','LePhiTruocBaController@congbo');

Route::get('lephitruocbactdf/add','LePhiTruocBaCtDfController@store');
Route::get('lephitruocbactdf/show','LePhiTruocBaCtDfController@show');
Route::get('lephitruocbactdf/update','LePhiTruocBaCtDfController@update');
Route::get('lephitruocbactdf/del','LePhiTruocBaCtDfController@destroy');

Route::get('lephitruocbact/add','LePhiTruocBaCtController@store');
Route::get('lephitruocbact/show','LePhiTruocBaCtController@show');
Route::get('lephitruocbact/update','LePhiTruocBaCtController@update');
Route::get('lephitruocbact/del','LePhiTruocBaCtController@destroy');

Route::get('timkiemlephitruocba','LePhiTruocBaController@search');

//Giá thuê mặt đất-nước
Route::get('giathuematdatmatnuoc/ketxuat','GiaThueDatNuocController@ketxuat');
Route::resource('giathuematdatmatnuoc','GiaThueDatNuocController');
Route::post('giathuematdatmatnuoc/delete','GiaThueDatNuocController@destroy');
Route::post('giathuematdatmatnuoc/hoanthanh','GiaThueDatNuocController@hoanthanh');
Route::post('giathuematdatmatnuoc/huyhoanthanh','GiaThueDatNuocController@huyhoanthanh');
Route::post('giathuematdatmatnuoc/congbo','GiaThueDatNuocController@congbo');
Route::get('timkiemgiathuematdatmatnuoc','GiaThueDatNuocController@search');

Route::get('giathuematdatmatnuocctdf/store','GiaThueDatNuocCtDfController@store');
Route::get('giathuematdatmatnuocctdf/edit','GiaThueDatNuocCtDfController@edit');
Route::get('giathuematdatmatnuocctdf/update','GiaThueDatNuocCtDfController@update');
Route::get('giathuematdatmatnuocctdf/del','GiaThueDatNuocCtDfController@destroy');

Route::get('giathuematdatmatnuocct/store','GiaThueDatNuocCtController@store');
Route::get('giathuematdatmatnuocct/edit','GiaThueDatNuocCtController@edit');
Route::get('giathuematdatmatnuocct/update','GiaThueDatNuocCtController@update');
Route::get('giathuematdatmatnuocct/del','GiaThueDatNuocCtController@destroy');

//Giá rừng
Route::get('dmgiarung','manage\giarung\DmGiaRungController@index');
Route::post('dmgiarung','manage\giarung\DmGiaRungController@store');
Route::get('dmgiarung/show','manage\giarung\DmGiaRungController@show');
Route::post('dmgiarung/update','manage\giarung\DmGiaRungController@update');

Route::get('giarung','manage\giarung\GiaRungController@index');
Route::post('giarung/add','manage\giarung\GiaRungController@store');
Route::get('giarung/edittt','manage\giarung\GiaRungController@edit');
Route::post('giarung/update','manage\giarung\GiaRungController@update');
Route::post('giarung/destroy','manage\giarung\GiaRungController@destroy');
Route::post('giarung/delete','manage\giarung\GiaRungController@multidelete');
Route::post('giarung/congbo','manage\giarung\GiaRungController@congbo');
Route::post('giarung/huycongbo','manage\giarung\GiaRungController@huycongbo');
Route::post('giarung/checkmulti','manage\giarung\GiaRungController@checkmulti');
Route::get('giarung/prints','manage\giarung\GiaRungController@BcGiaRung');
Route::get('giarung/nhandulieutuexcel','manage\giarung\GiaRungController@nhandulieutuexcel');
Route::post('giarung/importexcel','manage\giarung\GiaRungController@importexcel');

Route::post('giarung/hoanthanh','manage\giarung\GiaRungController@hoanthanh');
Route::post('giarung/huyhoanthanh','manage\giarung\GiaRungController@huyhoanthanh');

//Thuế tài nguyên

Route::get('nhomthuetn','manage\thuetn\NhomThueTnController@index');
Route::post('nhomthuetn','manage\thuetn\NhomThueTnController@store');
Route::get('nhomthuetn/show','manage\thuetn\NhomThueTnController@show');
Route::post('nhomthuetn/update','manage\thuetn\NhomThueTnController@update');
Route::get('dmthuetn','manage\thuetn\DmThueTnController@index');
Route::post('dmthuetn','manage\thuetn\DmThueTnController@store');
Route::get('dmthuetn/show','manage\thuetn\DmThueTnController@show');
Route::post('dmthuetn/update','manage\thuetn\DmThueTnController@update');
Route::post('dmthuetn/delete','manage\thuetn\DmThueTnController@destroy');
Route::post('dmthuetn/importexcel','manage\thuetn\DmThueTnController@importexcel');

Route::get('thuetainguyen','manage\thuetn\ThueTaiNguyenController@index');
Route::post('thuetainguyen/add','manage\thuetn\ThueTaiNguyenController@store');
Route::get('thuetainguyen/edit','manage\thuetn\ThueTaiNguyenController@edit');
Route::post('thuetainguyen/update','manage\thuetn\ThueTaiNguyenController@update');
Route::post('thuetainguyen/destroy','manage\thuetn\ThueTaiNguyenController@destroy');
Route::post('thuetainguyen/delete','manage\thuetn\ThueTaiNguyenController@delete');
Route::post('thuetainguyen/congbo','manage\thuetn\ThueTaiNguyenController@congbo');
Route::post('thuetainguyen/huycongbo','manage\thuetn\ThueTaiNguyenController@huycongbo');
Route::post('thuetainguyen/checkmulti','manage\thuetn\ThueTaiNguyenController@checkmulti');
Route::get('thuetainguyen/nhandulieutuexcel','manage\thuetn\ThueTaiNguyenController@nhandulieutuexcel');
Route::post('thuetainguyen/import_excel','manage\thuetn\ThueTaiNguyenController@importexcel');
Route::post('thuetainguyen/export','manage\thuetn\ThueTaiNguyenController@export');

Route::get('baocaothuetainguyen','manage\thuetn\ReportsThueTnController@index');
Route::post('/baocaothuetainguyen/bc1','manage\thuetn\ReportsThueTnController@Bc1');


//DV Khám chữa bệnh
Route::get('dichvukcb','manage\dvkcb\DvKcbController@index');
Route::post('dichvukcb/add','manage\dvkcb\DvKcbController@store');
Route::get('dichvukcb/edittt','manage\dvkcb\DvKcbController@edit');
Route::post('dichvukcb/update','manage\dvkcb\DvKcbController@update');
Route::post('dichvukcb/delete','manage\dvkcb\DvKcbController@multidelete');
Route::post('dichvukcb/destroy','manage\dvkcb\DvKcbController@destroy');
Route::post('dichvukcb/congbo','manage\dvkcb\DvKcbController@congbo');
Route::post('dichvukcb/huycongbo','manage\dvkcb\DvKcbController@huycongbo');
Route::post('dichvukcb/checkmulti','manage\dvkcb\DvKcbController@checkmulti');
Route::get('dichvukcb/nhandulieutuexcel','manage\dvkcb\DvKcbController@nhandulieutuexcel');
Route::post('dichvukcb/importexcel','manage\dvkcb\DvKcbController@importexcel');
Route::get('dichvukcb/prints','manage\dvkcb\DvKcbController@BcGiaDvKcb');
Route::post('dichvukcb/huyhoanthanh','manage\dvkcb\DvKcbController@huyhoanthanh');
Route::post('dichvukcb/hoanthanh','manage\dvkcb\DvKcbController@hoanthanh');


//Giá HH-DV khác
Route::resource('nhomhanghoadichvu','NhomHhDvKController');
Route::get('nhomhanghoadichvu/show','NhomHhDvKController@show');
Route::post('nhomhanghoadichvu/update','NhomHhDvKController@update');
Route::resource('dmhanghoadichvu','DmHhDvKController');
Route::get('dmhanghoadichvu/show','DmHhDvKController@show');
Route::post('dmhanghoadichvu/update','DmHhDvKController@update');

Route::post('giahhdvkhac/danhmucmau','GiaHhDvKController@filemau');
Route::get('giahhdvkhac/nhanexcel','GiaHhDvKController@nhanexcel');
Route::post('giahhdvkhac/import_excel','GiaHhDvKController@import_excel');

Route::resource('giahhdvkhac','GiaHhDvKController');
Route::post('giahhdvkhac/create','GiaHhDvKController@create');
Route::post('giahhdvkhac/delete','GiaHhDvKController@destroy');
Route::post('giahhdvkhac/hoanthanh','GiaHhDvKController@hoanthanh');
Route::post('giahhdvkhac/huyhoanthanh','GiaHhDvKController@huyhoanthanh');
Route::post('giahhdvkhac/congbo','GiaHhDvKController@congbo');
Route::get('timkiemgiahhdvkhac','GiaHhDvKController@search');

Route::get('/giahhdvkhacctdf/edit','GiaHhDvKCtDfController@edit');
Route::get('/giahhdvkhacctdf/update','GiaHhDvKCtDfController@update');

Route::get('/giahhdvkhacct/edit','GiaHhDvKCtController@edit');
Route::get('/giahhdvkhacct/update','GiaHhDvKCtController@update');

Route::get('reportshanghoadichvukhac','ReportsHhDvKController@index');
Route::post('reportshanghoadichvukhac/bc1','ReportsHhDvKController@bc1');
Route::post('reportshanghoadichvukhac/bc2','ReportsHhDvKController@bc2');
        //Tổng hợp
Route::resource('tonghopgiahhdvk','ThGiaHhDvKController');
Route::post('tonghopgiahhdvk/create','ThGiaHhDvKController@create');
Route::post('tonghopgiahhdvk/delete','ThGiaHhDvKController@destroy');
Route::post('tonghopgiahhdvk/hoanthanh','ThGiaHhDvKController@hoanthanh');
Route::post('tonghopgiahhdvk/huyhoanthanh','ThGiaHhDvKController@huyhoanthanh');
Route::post('tonghopgiahhdvk/congbo','ThGiaHhDvKController@congbo');
Route::post('tonghopgiahhdvkthang/create','ThGiaHhDvKController@createthang');

Route::get('thgiahhdvk/{id}/exportXML','ThGiaHhDvKController@exportXML');
Route::get('thgiahhdvk/{id}/exportEx','ThGiaHhDvKController@exportEx');


Route::get('thgiahhdvkctdf/edit','ThGiaHhDvKCtDfController@show');
Route::get('thgiahhdvkctdf/update','ThGiaHhDvKCtDfController@update');

Route::get('thgiahhdvkct/edit','ThGiaHhDvKCtController@show');
Route::get('thgiahhdvkct/update','ThGiaHhDvKCtController@update');
        //End Tổng hợp

//Phí Lệ phí
Route::resource('nhomphilephi','DmPhiLePhiController');
Route::post('nhomphilephi/update','DmPhiLePhiController@update');

Route::resource('philephi','PhiLePhiController');
Route::post('philephi/create','PhiLePhiController@create');
Route::post('philephi/delete','PhiLePhiController@destroy');

Route::post('philephi/hoanthanh','PhiLePhiController@hoanthanh');
Route::post('philephi/huyhoanthanh','PhiLePhiController@huyhoanthanh');
Route::post('philephi/congbo','PhiLePhiController@congbo');

Route::get('timkiemthongtinphilephi','PhiLePhiController@search');

Route::get('philephictdf/store','PhiLePhiCtDfController@store');
Route::get('philephictdf/show','PhiLePhiCtDfController@show');
Route::get('philephictdf/update','PhiLePhiCtDfController@update');
Route::get('philephictdf/del','PhiLePhiCtDfController@destroy');

Route::get('philephict/store','PhiLePhiCtController@store');
Route::get('philephict/show','PhiLePhiCtController@show');
Route::get('philephict/update','PhiLePhiCtController@update');
Route::get('philephict/del','PhiLePhiCtController@destroy');

//Đầu giá đất
Route::get('thongtindaugiadat/print','manage\giadaugiadat\DauGiaDatController@ketxuat');
Route::resource('thongtindaugiadat','manage\giadaugiadat\DauGiaDatController');
Route::post('thongtindaugiadat/delete','manage\giadaugiadat\DauGiaDatController@destroy');
Route::post('thongtindaugiadat/hoanthanh','manage\giadaugiadat\DauGiaDatController@hoanthanh');
Route::post('thongtindaugiadat/huyhoanthanh','manage\giadaugiadat\DauGiaDatController@huyhoanthanh');
Route::post('thongtindaugiadat/congbo','manage\giadaugiadat\DauGiaDatController@congbo');

Route::get('timkiemthongtindaugiadat','manage\giadaugiadat\DauGiaDatController@search');

//Route::get('thongtindaugiadatctdf/store','DauGiaDatCtDfController@store');
//Route::get('thongtindaugiadatctdf/show','DauGiaDatCtDfController@show');
//Route::get('thongtindaugiadatctdf/update','DauGiaDatCtDfController@update');
//Route::get('thongtindaugiadatctdf/del','DauGiaDatCtDfController@destroy');

Route::get('thongtindaugiadatct','manage\giadaugiadat\DauGiaDatCtController@index');
Route::post('thongtindaugiadatct/store','manage\giadaugiadat\DauGiaDatCtController@store');
Route::get('thongtindaugiadatct/edit','manage\giadaugiadat\DauGiaDatCtController@edit');
Route::post('thongtindaugiadatct/update','manage\giadaugiadat\DauGiaDatCtController@update');
Route::post('thongtindaugiadatct/delete','manage\giadaugiadat\DauGiaDatCtController@destroy');

//Đấu giá đất và tài sản gắn liền đất
Route::get('thongtindaugiadatts/print','manage\giadaugiadatts\DauGiaDatTsController@ketxuat');
Route::resource('thongtindaugiadatts','manage\giadaugiadatts\DauGiaDatTsController');
Route::post('thongtindaugiadatts/delete','manage\giadaugiadatts\DauGiaDatTsController@destroy');
Route::post('thongtindaugiadatts/hoanthanh','manage\giadaugiadatts\DauGiaDatTsController@hoanthanh');
Route::post('thongtindaugiadatts/huyhoanthanh','manage\giadaugiadatts\DauGiaDatTsController@huyhoanthanh');
Route::post('thongtindaugiadatts/congbo','manage\giadaugiadatts\DauGiaDatTsController@congbo');

Route::get('thongtindaugiadattsct','manage\giadaugiadatts\DauGiaDatTsCtController@index');
Route::post('thongtindaugiadattsct/store','manage\giadaugiadatts\DauGiaDatTsCtController@store');
Route::get('thongtindaugiadattsct/edit','manage\giadaugiadatts\DauGiaDatTsCtController@edit');
Route::post('thongtindaugiadattsct/update','manage\giadaugiadatts\DauGiaDatTsCtController@update');
Route::post('thongtindaugiadattsct/delete','manage\giadaugiadatts\DauGiaDatTsCtController@destroy');

//Giá thuê tài sản công
Route::get('thongtinthuetaisancong/ketxuat','GiaThueTsCongController@ketxuat');
Route::resource('thongtinthuetaisancong','GiaThueTsCongController');
Route::post('thongtinthuetaisancong/delete','GiaThueTsCongController@destroy');
Route::post('thongtinthuetaisancong/hoanthanh','GiaThueTsCongController@hoanthanh');
Route::post('thongtinthuetaisancong/huyhoanthanh','GiaThueTsCongController@huyhoanthanh');
Route::post('thongtinthuetaisancong/congbo','GiaThueTsCongController@congbo');
Route::get('timkiemthongtinthuetaisancong','GiaThueTsCongController@search');

Route::get('thongtinthuetaisancongctdf/store','GiaThueTsCongCtDfController@store');
Route::get('thongtinthuetaisancongctdf/show','GiaThueTsCongCtDfController@show');
Route::get('thongtinthuetaisancongctdf/update','GiaThueTsCongCtDfController@update');
Route::get('thongtinthuetaisancongctdf/del','GiaThueTsCongCtDfController@destroy');

Route::get('thongtinthuetaisancongct/store','GiaThueTsCongCtController@store');
Route::get('thongtinthuetaisancongct/show','GiaThueTsCongCtController@show');
Route::get('thongtinthuetaisancongct/update','GiaThueTsCongCtController@update');
Route::get('thongtinthuetaisancongct/del','GiaThueTsCongCtController@destroy');

//Giá Nước sạch sinh hoạt

Route::get('dmgianuocsachsinhhoat','manage\gianuocsachsh\GiaNuocSachShDmController@index');
Route::post('dmgianuocsachsinhhoat/add','manage\gianuocsachsh\GiaNuocSachShDmController@store');
Route::get('dmgianuocsachsinhhoat/edittt','manage\gianuocsachsh\GiaNuocSachShDmController@edit');
Route::post('dmgianuocsachsinhhoat/update','manage\gianuocsachsh\GiaNuocSachShDmController@update');
Route::post('dmgianuocsachsinhhoat/destroy','manage\gianuocsachsh\GiaNuocSachShDmController@destroy');

Route::resource('gianuocsachsinhhoat','manage\gianuocsachsh\GiaNuocShController');
Route::post('gianuocsachsinhhoat/destroy','manage\gianuocsachsh\GiaNuocShController@destroy');
Route::post('gianuocsachsinhhoat/delete','manage\gianuocsachsh\GiaNuocShController@multidelete');
Route::post('gianuocsachsinhhoat/congbo','manage\gianuocsachsh\GiaNuocShController@congbo');
Route::post('gianuocsachsinhhoat/huycongbo','manage\gianuocsachsh\GiaNuocShController@huycongbo');
Route::post('gianuocsachsinhhoat/checkmulti','manage\gianuocsachsh\GiaNuocShController@checkmulti');
Route::get('gianuocsachsinhhoat/nhandulieutuexcel','manage\gianuocsachsh\GiaNuocShController@nhandulieutuexcel');
Route::post('gianuocsachsinhhoat/importexcel','manage\gianuocsachsh\GiaNuocShController@importexcel');

Route::post('gianuocsachsinhhoat/huyhoanthanh','manage\gianuocsachsh\GiaNuocShController@huyhoanthanh');
Route::post('gianuocsachsinhhoat/hoanthanh','manage\gianuocsachsh\GiaNuocShController@hoanthanh');

Route::get('gianuocsachsinhhoatct/edittt','manage\gianuocsachsh\GiaNuocShCtController@edit');
Route::get('gianuocsachsinhhoatct/update','manage\gianuocsachsh\GiaNuocShCtController@update');

Route::get('tkgianuocsachsinhhoat/printf','manage\gianuocsachsh\GiaNuocShTkController@printf');
Route::get('tkgianuocsachsinhhoat','manage\gianuocsachsh\GiaNuocShTkController@index');

Route::get('bcgianuocsachsinhhoat','manage\gianuocsachsh\GiaNuocShBcController@index');
Route::post('bcgianuocsachsinhhoat/baocaonuocsh1','manage\gianuocsachsh\GiaNuocShBcController@Bc1');



//Giá DV GD-ĐT

Route::get('giadvgiaoducdaotao','manage\GiaDvGdDtController@index');
Route::post('giadvgiaoducdaotao/add','manage\GiaDvGdDtController@store');
Route::get('giadvgiaoducdaotao/edittt','manage\GiaDvGdDtController@edit');
Route::post('giadvgiaoducdaotao/update','manage\GiaDvGdDtController@update');
Route::post('giadvgiaoducdaotao/destroy','manage\GiaDvGdDtController@destroy');
Route::post('giadvgiaoducdaotao/delete','manage\GiaDvGdDtController@multidelete');
Route::post('giadvgiaoducdaotao/congbo','manage\GiaDvGdDtController@congbo');
Route::post('giadvgiaoducdaotao/huycongbo','manage\GiaDvGdDtController@huycongbo');
Route::post('giadvgiaoducdaotao/checkmulti','manage\GiaDvGdDtController@checkmulti');
Route::get('giadvgiaoducdaotao/nhandulieutuexcel','manage\GiaDvGdDtController@nhandulieutuexcel');
Route::post('giadvgiaoducdaotao/import_excel','manage\GiaDvGdDtController@importexcel');
Route::get('giadvgiaoducdaotao/prints','manage\GiaDvGdDtController@BcGiaDvGdDt');
Route::post('giadvgiaoducdaotao/hoanthanh','manage\GiaDvGdDtController@hoanthanh');
Route::post('giadvgiaoducdaotao/huyhoanthanh','manage\GiaDvGdDtController@huyhoanthanh');
//Giá thuê mua nhà XH
Route::get('thuemuanhaxahoi','manage\thuemuanhaxh\GiaThueMuaNhaXhController@index');
Route::post('thuemuanhaxahoi/add','manage\thuemuanhaxh\GiaThueMuaNhaXhController@store');
Route::get('thuemuanhaxahoi/edittt','manage\thuemuanhaxh\GiaThueMuaNhaXhController@edit');
Route::post('thuemuanhaxahoi/update','manage\thuemuanhaxh\GiaThueMuaNhaXhController@update');
Route::post('thuemuanhaxahoi/destroy','manage\thuemuanhaxh\GiaThueMuaNhaXhController@destroy');
Route::post('thuemuanhaxahoi/delete','manage\thuemuanhaxh\GiaThueMuaNhaXhController@multidelete');
Route::post('thuemuanhaxahoi/congbo','manage\thuemuanhaxh\GiaThueMuaNhaXhController@congbo');
Route::post('thuemuanhaxahoi/huycongbo','manage\thuemuanhaxh\GiaThueMuaNhaXhController@huycongbo');
Route::post('thuemuanhaxahoi/checkmulti','manage\thuemuanhaxh\GiaThueMuaNhaXhController@checkmulti');
Route::get('thuemuanhaxahoi/nhandulieutuexcel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@nhandulieutuexcel');
Route::post('thuemuanhaxahoi/import_excel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@importexcel');
Route::get('thuemuanhaxahoi/prints','manage\thuemuanhaxh\GiaThueMuaNhaXhController@BcGiaThueMuaNhaXh');

Route::post('thuemuanhaxahoi/hoanthanh','manage\thuemuanhaxh\GiaThueMuaNhaXhController@hoanthanh');
Route::post('thuemuanhaxahoi/huyhoanthanh','manage\thuemuanhaxh\GiaThueMuaNhaXhController@huyhoanthanh');
//Giá thị trường
Route::get('thongtugiathitruong','manage\giathitruong\GiaThiTruongTtController@index');
Route::post('thongtugiathitruong','manage\giathitruong\GiaThiTruongTtController@store');
Route::get('thongtugiathitruong/edit','manage\giathitruong\GiaThiTruongTtController@edit');
Route::post('thongtugiathitruong/update','manage\giathitruong\GiaThiTruongTtController@update');
Route::get('thongtugiathitruong/nhandulieutuexcel','manage\giathitruong\GiaThiTruongTtController@nhandulieutuexcel');

Route::get('danhmucgiathitruong','manage\giathitruong\GiaThiTruongDmController@index');
Route::post('danhmucgiathitruong','manage\giathitruong\GiaThiTruongDmController@store');
Route::get('danhmucgiathitruong/edit','manage\giathitruong\GiaThiTruongDmController@edit');
Route::post('danhmucgiathitruong/update','manage\giathitruong\GiaThiTruongDmController@update');
Route::post('danhmucgiathitruong/importexcel','manage\giathitruong\GiaThiTruongDmController@importexcel');

Route::get('kekhaigiathitruong','manage\giathitruong\GiaThiTruongController@index');
Route::post('kekhaigiathitruong/create','manage\giathitruong\GiaThiTruongController@create');
Route::post('kekhaigiathitruong','manage\giathitruong\GiaThiTruongController@store');
Route::get('kekhaigiathitruong/{id}/edit','manage\giathitruong\GiaThiTruongController@edit');
Route::patch('kekhaigiathitruong/{id}','manage\giathitruong\GiaThiTruongController@update');
Route::get('kekhaigiathitruong/{id}','manage\giathitruong\GiaThiTruongController@show');
Route::post('kekhaigiathitruong/hoanthanh','manage\giathitruong\GiaThiTruongController@hoanthanh');
Route::post('kekhaigiathitruong/huyhoanthanh','manage\giathitruong\GiaThiTruongController@huyhoanthanh');

Route::get('giathitruongct/edit','manage\giathitruong\GiaThiTruongCtController@edit');
Route::get('giathitruongct/update','manage\giathitruong\GiaThiTruongCtController@update');
Route::get('tkgiatrhitruong','manage\giathitruong\GiaThiTruongController@search');


Route::get('baocaogiathitruong','manage\giathitruong\GiaThiTruongBcController@index');
Route::post('baocaogiathitruong/baocaotonghop1','manage\giathitruong\GiaThiTruongBcController@baocaotonghop1');

//Bán nhà tái định cư
Route::get('bannhataidinhcu','manage\bannhataidinhcu\BanNhaTaiDinhCuController@index');
Route::post('bannhataidinhcu/add','manage\bannhataidinhcu\BanNhaTaiDinhCuController@store');
Route::get('bannhataidinhcu/edittt','manage\bannhataidinhcu\BanNhaTaiDinhCuController@edit');
Route::post('bannhataidinhcu/update','manage\bannhataidinhcu\BanNhaTaiDinhCuController@update');
Route::post('bannhataidinhcu/destroy','manage\bannhataidinhcu\BanNhaTaiDinhCuController@destroy');
Route::post('bannhataidinhcu/delete','manage\bannhataidinhcu\BanNhaTaiDinhCuController@multidelete');
Route::post('bannhataidinhcu/congbo','manage\bannhataidinhcu\BanNhaTaiDinhCuController@congbo');
Route::post('bannhataidinhcu/huycongbo','manage\bannhataidinhcu\BanNhaTaiDinhCuController@huycongbo');
Route::post('bannhataidinhcu/checkmulti','manage\bannhataidinhcu\BanNhaTaiDinhCuController@checkmulti');
Route::get('bannhataidinhcu/nhandulieutuexcel','manage\bannhataidinhcu\BanNhaTaiDinhCuController@nhandulieutuexcel');
Route::post('bannhataidinhcu/import_excel','manage\bannhataidinhcu\BanNhaTaiDinhCuController@importexcel');
Route::get('bannhataidinhcu/prints','manage\bannhataidinhcu\BanNhaTaiDinhCuController@BcBanNhaTaiDinhCu');

//Giá thuê nhà công vụ
Route::get('giathuenhacongvu','manage\thuenhacongvu\GiaThueNhaCongVuController@index');
Route::post('giathuenhacongvu/add','manage\thuenhacongvu\GiaThueNhaCongVuController@store');
Route::get('giathuenhacongvu/edittt','manage\thuenhacongvu\GiaThueNhaCongVuController@edit');
Route::post('giathuenhacongvu/update','manage\thuenhacongvu\GiaThueNhaCongVuController@update');
Route::post('giathuenhacongvu/destroy','manage\thuenhacongvu\GiaThueNhaCongVuController@destroy');
Route::post('giathuenhacongvu/delete','manage\thuenhacongvu\GiaThueNhaCongVuController@multidelete');
Route::post('giathuenhacongvu/congbo','manage\thuenhacongvu\GiaThueNhaCongVuController@congbo');
Route::post('giathuenhacongvu/huycongbo','manage\thuenhacongvu\GiaThueNhaCongVuController@huycongbo');
Route::post('giathuenhacongvu/checkmulti','manage\thuenhacongvu\GiaThueNhaCongVuController@checkmulti');
Route::get('giathuenhacongvu/nhandulieutuexcel','manage\thuenhacongvu\GiaThueNhaCongVuController@nhandulieutuexcel');
Route::post('giathuenhacongvu/import_excel','manage\thuenhacongvu\GiaThueNhaCongVuController@importexcel');
Route::get('giathuenhacongvu/prints','manage\thuenhacongvu\GiaThueNhaCongVuController@BcGiaThueNhaCongVu');

?>
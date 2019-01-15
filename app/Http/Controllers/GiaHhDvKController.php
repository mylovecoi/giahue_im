<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\GiaHhDvKCtDf;
//use App\GiaRungCt;
//use App\GiaRungCtDf;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaHhDvKController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $modeldb = DiaBanHd::where('level','H')->get();
            if(session('admin')->level == 'X') {
                $inputs['district'] = session('admin')->district;
            }else {
                $inputs['district'] = isset($inputs['district']) ? $inputs['district'] : $modeldb->first()->district;
            }

            $model = GiaHhDvK::join('nhomhhdvk','nhomhhdvk.manhom','=','giahhdvk.manhom')
                ->select('giahhdvk.*', 'nhomhhdvk.tennhom')
                ->where('giahhdvk.district', $inputs['district'])
                ->where('giahhdvk.nam',$inputs['nam'])
                ->where('giahhdvk.thang',$inputs['thang']);

            $model = $model->get();
            $m_nhom =array_column(NhomHhDvK::where('theodoi', 'TD')
                ->get()->toarray(), 'tennhom','manhom');
            $diaban = DiaBanHd::where('district',$inputs['district'])->first();
            return view('manage.dinhgia.giahhdvk.kekhai.index')
                ->with('model', $model)
                ->with('modeldb', $modeldb)
                ->with('inputs',$inputs)
                ->with('a_nhom', $m_nhom)
                ->with('diaban',$diaban)
                //->with('a_nhom',array_merge(array('ALL'=>'Tất cả hàng hóa'), $m_nhom))
                ->with('pageTitle', 'Thông tin báo cáo giá hàng hóa dịch vụ');

        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            if(isset($inputs['manhombc']) && isset($inputs['districtbc'])) {
                $modelkt = GiaHhDvK::where('manhom',$inputs['manhombc'])
                    ->where('thang',$inputs['thangbc'])
                    ->where('nam',$inputs['nambc'])
                    ->where('phanloai',$inputs['phanloaibc'])
                    ->where('district',$inputs['districtbc'])
                    ->count();
                if($modelkt > 0){
                    dd('Bạn đã tạo báo cáo!Nếu thay đổi số liệu bạn cần xóa báo cáo của thời điểm đó rồi tạo lại báo cáo');
                }else {
                    $tennhom = NhomHhDvK::where('manhom', $inputs['manhombc'])->first()->tennhom;
                    $diaban = DiaBanHd::where('district', $inputs['districtbc'])->where('level', 'H')->first()->diaban;
                    $modelidlk = GiaHhDvK::where('trangthai', 'HT')
                        ->where('manhom', $inputs['manhombc'])
                        ->where('district', $inputs['districtbc'])
                        ->max('id');
                    if ($modelidlk != null) {
                        $modellk = GiaHhDvK::where('id', $modelidlk)
                            ->first();
                        $modelctlk = GiaHhDvKCt::where('mahs', $modellk->mahs)
                            ->get();
                        $modeldel = GiaHhDvKCtDf::where('district', $inputs['districtbc'])
                            ->where('manhom', $inputs['manhombc'])->delete();
                        foreach ($modelctlk as $ct) {
                            $modelctnew = new GiaHhDvKCtDf();
                            $modelctnew->district = $inputs['districtbc'];
                            $modelctnew->manhom = $ct->manhom;
                            $modelctnew->mahhdv = $ct->mahhdv;
                            $modelctnew->tenhhdv = $ct->tenhhdv;
                            $modelctnew->dacdiemkt = $ct->dacdiemkt;
                            $modelctnew->dvt = $ct->dvt;
                            $modelctnew->gialk = $ct->gia;
                            $modelctnew->save();
                        }
                    } else {
                        $modellk = '';
                        $checkct = GiaHhDvKCtDf::where('district', $inputs['districtbc'])
                            ->where('manhom', $inputs['manhombc'])->count();
                        if ($checkct == 0) {
                            $modeldm = DmHhDvK::where('manhom', $inputs['manhombc'])->get();
                            foreach ($modeldm as $dm) {
                                $modelctnew = new GiaHhDvKCtDf();
                                $modelctnew->district = $inputs['districtbc'];
                                $modelctnew->manhom = $dm->manhom;
                                $modelctnew->mahhdv = $dm->mahhdv;
                                $modelctnew->tenhhdv = $dm->tenhhdv;
                                $modelctnew->dacdiemkt = $dm->dacdiemkt;
                                $modelctnew->dvt = $dm->dvt;
                                $modelctnew->save();
                            }
                        }
                    }
                }

                $modelct = GiaHhDvKCtDf::where('district',$inputs['districtbc'])
                    ->where('manhom',$inputs['manhombc'])->get();
                return view('manage.dinhgia.giahhdvk.kekhai.create')
                    ->with('diaban', $diaban)
                    ->with('tennhom', $tennhom)
                    ->with('modelct',$modelct)
                    ->with('modellk',$modellk)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Báo cáo giá hàng hóa dịch vụ thêm mới');
            }else
                dd('Lỗi!Bạn cần xem lại thao tác!');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['ngayapdung'] = getDateToDb($inputs['ngayapdung']);
            $inputs['mahs'] = $inputs['district'].getdate()[0];
            $inputs['trangthai'] = 'CHT';
            if($inputs['ngayapdunglk'] != '')
                $inputs['ngayapdunglk'] = getDateToDb($inputs['ngayapdunglk']);
            else
                unset($inputs['ngayapdunglk']);

            $model = new GiaHhDvK();
            if($model->create($inputs)){
                $modelctdf = GiaHhDvKCtDf::where('district',$inputs['district'])
                    ->where('manhom',$inputs['manhom']);
                foreach($modelctdf->get() as $ctdf){
                    $modelct = new GiaHhDvKCt();
                    $modelct->manhom = $ctdf->manhom;
                    $modelct->mahhdv = $ctdf->mahhdv;
                    $modelct->tenhhdv = $ctdf->tenhhdv;
                    $modelct->dacdiemkt = $ctdf->dacdiemkt;
                    $modelct->dvt = $ctdf->dvt;
                    $modelct->mahs = $inputs['mahs'];
                    $modelct->gialk = $ctdf->gialk;
                    $modelct->gia = $ctdf->gia;
                    $modelct->save();
                }
                $modelctdf->delete();
            }
            return redirect('giahhdvkhac?&district='.$inputs['district'].'&trangthai='.$inputs['trangthai']);

        }else
            return view('errors.notlogin');
    }

    public function show($id){
        if(Session::has('admin')){
            $model = GiaHhDvK::findOrFail($id);
            $tennhom = NhomHhDvK::where('manhom', $model->manhom)->first()->tennhom;
            $diaban = DiaBanHd::where('district',$model->district)->where('level', 'H')->first()->diaban;
            $modelct = GiaHhDvKCt::where('mahs',$model->mahs)
                ->get();
            return view('manage.dinhgia.giahhdvk.reports.prints')
                ->with('diaban', $diaban)
                ->with('tennhom', $tennhom)
                ->with('modelct',$modelct)
                ->with('model',$model)
                ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ chi tiết');

        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if(Session::has('admin')){
            $model = GiaHhDvK::findOrFail($id);
            $tennhom = NhomHhDvK::where('manhom', $model->manhom)->first()->tennhom;
            $diaban = DiaBanHd::where('district',$model->district)->where('level', 'H')->first()->diaban;
            $modelct = GiaHhDvKCt::where('mahs',$model->mahs)
                ->get();
            return view('manage.dinhgia.giahhdvk.kekhai.edit')
                ->with('diaban', $diaban)
                ->with('tennhom', $tennhom)
                ->with('modelct',$modelct)
                ->with('model',$model)
                ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ chỉnh sửa');

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['ngayapdung'] = getDateToDb($inputs['ngayapdung']);
            if($inputs['ngayapdunglk'] != '')
                $inputs['ngayapdunglk'] = getDateToDb($inputs['ngayapdunglk']);
            else
                unset($inputs['ngayapdunglk']);
            $model = GiaHhDvK::findOrFail($id);
            $model->update($inputs);
            return redirect('giahhdvkhac?&district='.$model->district.'&trangthai='.$model->trangthai);

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = GiaHhDvK::findOrFail($id);
            $district = $model->district;
            $modelct = GiaHhDvKCt::where('mahs',$model->mahs)->delete();
            $model->delete();
            return redirect('giahhdvkhac?&district='.$district.'&trangthai=CHT');
        }else
            return view('errors.notlogin');
    }

    public function search(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['tenhhdv'] = isset($inputs['tenhhdv']) ? $inputs['tenhhdv'] : '';
            $inputs['district'] =  isset($inputs['district']) ? $inputs['district'] : '';
            $inputs['manhom'] =  isset($inputs['manhom']) ? $inputs['manhom'] : '';
            $modeldb = DiaBanHd::where('level','H')->get();
            $modelnhomtn = NhomHhDvK::where('theodoi','TD')->get();
            $model = GiaHhDvKCt::join('giahhdvk','giahhdvk.mahs','=','giahhdvkct.mahs')
                ->join('nhomhhdvk','nhomhhdvk.manhom','=','giahhdvkct.manhom')
                ->join('diabanhd','diabanhd.district','=','giahhdvk.district')
                ->select('giahhdvkct.*','giahhdvk.soqd','giahhdvk.ngayapdung','diabanhd.diaban',
                    'nhomhhdvk.tennhom')
                ->whereIn('giahhdvk.trangthai',['HT','CB']);
            if($inputs['nam'] != '')
                $model = $model->whereYear('giahhdvk.ngayapdung',$inputs['nam']);
            if($inputs['district'] != '')
                $model = $model->where('giahhdvk.district','=',$inputs['district']);
            if($inputs['manhom'] != '')
                $model = $model->where('giahhdvk.manhom','=',$inputs['manhom']);
            if($inputs['tenhhdv'] != '')
                $model = $model->where('giahhdvkct.tenhhdv','like','%'.$inputs['tenhhdv'].'%');

            $model = $model->get();
            return view('manage.dinhgia.giahhdvk.timkiem.index')
                ->with('nam',$inputs['nam'])
                ->with('tenhhdv',$inputs['tenhhdv'])
                ->with('district',$inputs['district'])
                ->with('manhom',$inputs['manhom'])
                ->with('model',$model)
                ->with('modeldb',$modeldb)
                ->with('modelnhomtn',$modelnhomtn)
                ->with('pageTitle','Tìm kiếm thông tin giá hàng hóa dịch vụ khác');
        }else
            return view('errors.notlogin');
    }

    public function hoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idhoanthanh'];
            $model = GiaHhDvK::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();
            return redirect('giahhdvkhac?&district='.$model->district);
        }else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idhuyhoanthanh'];
            $model = GiaHhDvK::findOrFail($id);
            $model->trangthai = 'HHT';
            $model->save();
            return redirect('giahhdvkhac?&district='.$model->district);
        }else
            return view('errors.notlogin');
    }

    public function congbo(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idcongbo'];
            $model = GiaHhDvK::findOrFail($id);
            $model->congbo = 'CB';
            $model->save();
            return redirect('giahhdvkhac?&district='.$model->district);
        }else
            return view('errors.notlogin');
    }

    function filemau(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                //dd($inputs);
                if ($inputs['phanloai'] == 'HS') {
                    $model_nhom = NhomHhDvK::where('manhom', $inputs['manhom'])->get();
                    if (session('admin')->level == 'T' || session('admin')->level == 'H')
                        $inputs['district'] = $inputs['diaban'];
                    else
                        $inputs['district'] = session('admin')->district;
                    //$diaban = DiaBanHd::where('district', $inputs['getdistrict'])->where('level', 'H')->first()->diaban;
                    $modelidlk = GiaHhDvK::where('trangthai', 'HT')
                        ->where('manhom', $inputs['manhom'])
                        ->where('district', $inputs['district'])
                        ->max('id');
                    if ($modelidlk != null) {
                        $modellk = GiaHhDvK::where('id', $modelidlk)->first();
                        $model = GiaHhDvKCt::where('mahs', $modellk->mahs)->get();
                        foreach ($model as $ct) {
                            $ct->gialk = $ct->gia;
                        }
                        Excel::create('DMHANGHOA', function ($excel) use ($model_nhom, $model) {
                            $excel->sheet('DMHANGHOA', function ($sheet) use ($model_nhom, $model) {
                                $sheet->loadView('manage.dinhgia.giahhdvk.excel.danhmuc')
                                    ->with('model_nhom', $model_nhom->sortBy('manhom'))
                                    ->with('model', $model)
                                    ->with('pageTitle', 'Danh mục hàng hóa');
                                //$sheet->setPageMargin(0.25);
                                $sheet->setAutoSize(false);
                                $sheet->setFontFamily('Tahoma');
                                $sheet->setFontBold(false);

                                //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                            });
                        })->download('xls');
                    } else
                        goto danhmuc;
                } else {
                    danhmuc:
                    $model_nhom = NhomHhDvK::all();
                    $model = DmHhDvK::all();
                    foreach ($model as $ct) {
                        $ct->gia = 0;
                        $ct->gialk = 0;
                    }
                    Excel::create('DMHANGHOA', function ($excel) use ($model_nhom, $model) {
                        $excel->sheet('DMHANGHOA', function ($sheet) use ($model_nhom, $model) {
                            $sheet->loadView('manage.dinhgia.giahhdvk.excel.danhmuc')
                                ->with('model_nhom', $model_nhom->sortBy('manhom'))
                                ->with('model', $model)
                                ->with('pageTitle', 'Danh mục hàng hóa');
                            //$sheet->setPageMargin(0.25);
                            $sheet->setAutoSize(false);
                            $sheet->setFontFamily('Tahoma');
                            $sheet->setFontBold(false);

                            //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                        });
                    })->download('xls');
                }
            }else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function nhanexcel(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $m_nhom =array_column(NhomHhDvK::where('theodoi', 'TD')
                ->get()->toarray(), 'tennhom','manhom');
            if(session('admin')->level == 'X')
                $inputs['district'] = session('admin')->district;

            return view('manage.dinhgia.giahhdvk.excel.information')
                ->with('a_nhom', $m_nhom)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Nhận dữ liệu hàng hóa từ file Excel');
        }else
            return view('errors.notlogin');
    }

    function import_excel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $inputs['phanloaibc'] = $inputs['phanloai'];
            $inputs['thangbc'] = $inputs['thang'];
            $inputs['nambc'] = $inputs['nam'];
            $inputs['districtbc'] = $inputs['district'];
            $inputs['manhombc'] = $inputs['manhom'];
            //dd($inputs);
            $modelkt = GiaHhDvK::where('manhom',$inputs['manhom'])
                ->where('thang',$inputs['thang'])
                ->where('nam',$inputs['nam'])
                ->where('district',$inputs['district'])
                ->where('phanloai',$inputs['phanloai'])
                ->count();
            if($modelkt > 0)
                dd('Báo cáo đã tồn tại, bạn cần kiểm tra lại! Nếu thay đổi thông tin bạn cần xóa báo cáo và nhận lại file');
            else {
                $filename = $inputs['district'] . '_' . getdate()[0];
                $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
                $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
                $data = [];

                Excel::load($path, function ($reader) use (&$data, $inputs) {
                    $obj = $reader->getExcel();
                    $sheet = $obj->getSheet(0);
                    $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
                });
                //dd($data);
                $modeldel = GiaHhDvKCtDf::where('district', $inputs['district'])->where('manhom', $inputs['manhom'])->delete();

                for ($i = $inputs['tudong']; $i < ($inputs['tudong'] + $inputs['sodong']); $i++) {
                    //dd($data[$i]);
                    if (!isset($data[$i][$inputs['mahhdv']]) || $data[$i][$inputs['tenhhdv']] == '') {
                        continue;//Tên cán bộ rỗng => thoát
                    }
                    $modelctnew = new GiaHhDvKCtDf();
                    $modelctnew->district = $inputs['district'];
                    $modelctnew->manhom = $inputs['manhom'];
                    $modelctnew->mahhdv = $data[$i][$inputs['mahhdv']];
                    $modelctnew->tenhhdv = $data[$i][$inputs['tenhhdv']];
                    $modelctnew->dacdiemkt = $data[$i][$inputs['dacdiemkt']];
                    $modelctnew->dvt = $data[$i][$inputs['dvt']];
                    $modelctnew->gia = $data[$i][$inputs['gia']];
                    $modelctnew->gialk = $data[$i][$inputs['gialk']];
                    $modelctnew->save();
                }
                File::Delete($path);
                $tennhom = NhomHhDvK::where('manhom', $inputs['manhom'])->first()->tennhom;
                $diaban = DiaBanHd::where('district', $inputs['district'])->where('level', 'H')->first()->diaban;
                $modelidlk = GiaHhDvK::where('trangthai', 'CB')
                    ->where('manhom', $inputs['manhom'])
                    ->where('district', $inputs['district'])
                    ->max('id');
                if ($modelidlk != null) {
                    $modellk = GiaHhDvK::where('id', $modelidlk)->first();
                } else {
                    $modellk = null;
                }
                $modelct = GiaHhDvKCtDf::where('district', $inputs['district'])
                    ->where('manhom', $inputs['manhom'])->get();
                return view('manage.dinhgia.giahhdvk.kekhai.create')
                    ->with('diaban', $diaban)
                    ->with('tennhom', $tennhom)
                    ->with('modelct', $modelct)
                    ->with('modellk', $modellk)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ thêm mới');
            }
        }else
            return view('errors.notlogin');
    }
}

<?php

namespace App\Http\Controllers\manage\kekhaigia\kkgiay;

use App\District;
use App\Jobs\SendMail;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiay;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiayCt;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiayCtDf;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\NgayNghiLe;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGiaGiayController extends Controller
{
    public function ttdn(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $modeldmnghe = DmNgheKd::where('manganh','GIAY')
                    ->where('manghe','GIAY')
                    ->first();
                if(session('admin')->level == 'T'){
                    $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                    $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                }elseif(session('admin')->level == 'H'){
                    if(session('admin')->mahuyen == $modeldmnghe->mahuyen){
                        $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                    }else
                        return view('errors.perm');
                }else{
                    if(session('admin')->mahuyen == $modeldmnghe->mahuyen){
                        $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : session('admin')->maxa;
                    }else
                        return view('errors.perm');
                }
                $model = Company::join('companylvcc','companylvcc.maxa','=','company.maxa')
                    ->where('companylvcc.manghe','GIAY')
                    ->where('companylvcc.mahuyen',$inputs['maxa'])
                    ->join('town','town.maxa','=','companylvcc.mahuyen')
                    ->select('company.*','town.tendv')
                    ->get();

                $ttql = District::where('mahuyen',$modeldmnghe->mahuyen)
                    ->first();
                return view('manage.kkgia.giay.kkgia.kkgiadv.ttdn')
                    ->with('model', $model)
                    ->with('modeldv',$modeldv)
                    ->with('inputs',$inputs)
                    ->with('ttql',$ttql)
                    ->with('pageTitle', 'Danh sách doanh nghiệp kê khai giá giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H'  || session('admin')->level == 'X') {
                $inputs = $request->all();
                if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
                    $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue'] : '';
                else
                    $inputs['masothue'] = session('admin')->maxa;
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');

                $model = KkGiaGiay::where('maxa', $inputs['masothue'])
                    ->whereYear('ngaynhap', $inputs['nam'])
                    ->orderBy('id', 'desc')
                    ->get();
                $modeldn = Company::join('companylvcc','companylvcc.maxa','=','company.maxa')
                    ->where('company.maxa',$inputs['masothue'])
                    ->where('companylvcc.manghe','GIAY')
                    ->select('company.*','companylvcc.mahuyen')
                    ->first();

                if(isset($modeldn)) {
                    $modeldv = Town::where('maxa', $modeldn->mahuyen)
                        ->first();
                    return view('manage.kkgia.giay.kkgia.kkgiadv.index')
                        ->with('model', $model)
                        ->with('modeldn', $modeldn)
                        ->with('modeldv', $modeldv)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Danh sách hồ sơ kê khai giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước');
                }else
                    return view('errors.perm');
            } else
                return view('errors.perm');

        }else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
                $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue'] : '';
            else
                $inputs['masothue'] = session('admin')->maxa;
            $modeldn = Company::join('companylvcc','companylvcc.maxa','=','company.maxa')
                ->where('company.maxa',$inputs['masothue'])
                ->where('companylvcc.manghe','GIAY')
                ->select('company.*','companylvcc.mahuyen')
                ->first();
            if(isset($modeldn)) {
                $delctdf = KkGiaGiayCtDf::where('maxa',$inputs['masothue'])->delete();
                $idlk = KkGiaGiay::where('maxa',$inputs['masothue'])
                    ->where('trangthai','DD')
                    ->max('id');
                if(isset($idlk)){
                    $modellk = KkGiaGiay::where('id',$idlk)
                        ->first();
                    $modellkct = KkGiaGiayCt::where('mahs',$modellk->mahs)
                        ->get();
                    foreach($modellkct as  $ctdf){
                        $addct = new KkGiaGiayCtDf();
                        $addct->tthhdv = $ctdf->tthhdv;
                        $addct->qccl = $ctdf->qccl;
                        $addct->dvt = $ctdf->dvt;
                        $addct->dongialk = $ctdf->dongia;
                        $addct->maxa = $ctdf->$inputs['masothue'];
                        $addct->save();
                    }
                }
                $modelct = KkGiaGiayCtDf::where('maxa',$inputs['masothue'])
                    ->get();

                return view('manage.kkgia.giay.kkgia.kkgiadv.create')
                    ->with('modeldn', $modeldn)
                    ->with('modelct',$modelct)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Kê khai giá giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước thêm mới');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = new KkGiaGiay();
                $inputs['mahs'] = $inputs['maxa'].getdate()[0];
                $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                if($inputs['ngaycvlk'] != '')
                    $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
                else
                    unset($inputs['ngaycvlk']);
                $inputs['trangthai'] = 'CC';
                if($model->create($inputs)){
                    $modelctdf = KkGiaGiayCtDf::where('maxa',$inputs['maxa']);

                    foreach($modelctdf->geT() as $ctdf) {
                        $modelct = new KkGiaGiayCt();
                        $arrays = $ctdf->toArray();
                        unset($arrays['id']);
                        $arrays['mahs'] = $inputs['mahs'];
                        $modelct->create($arrays);
                    }
                    $modelctdf->delete();
                }
                return redirect('kekhaigiagiay?&masothue='.$inputs['maxa']);
            } else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkGiaGiay::where('mahs',$mahs)->first();
            $modeldn = Company::where('maxa',$modelkk->maxa)
                ->first();
            $modelkkct = KkGiaGiayCt::where('mahs',$modelkk->mahs)
                ->get();
            $modelcqcq = Town::where('maxa',$modelkk->mahuyen)
                ->first();
            return view('manage.kkgia.giay.reports.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước');

        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X'){
                $model = KkGiaGiay::findOrFail($id);
                $modelct = KkGiaGiayCt::where('mahs',$model->mahs)->get();
                $modeldn = Company::where('maxa', $model->maxa)
                    ->first();

                return view('manage.kkgia.giay.kkgia.kkgiadv.edit')
                    ->with('modeldn', $modeldn)
                    ->with('modelct',$modelct)
                    ->with('model',$model)
                    ->with('pageTitle', 'Kê khai giá giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước chỉnh sửa');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = KkGiaGiay::findOrFail($id);
                $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                if($inputs['ngaycvlk'] != '')
                    $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
                else
                    unset($inputs['ngaycvlk']);
                $model->update($inputs);
                return redirect('kekhaigiagiay?&masothue='.$model->maxa);
            } else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $id = $inputs['iddelete'];
                $model = KkGiaGiay::findOrFail($id);
                if($model->delete()){
                    $modelct = KkGiaGiayCt::where('mahs',$model->mahs)
                        ->delete();
                }
                return redirect('kekhaigiagiay?&masothue='.$model->maxa);
            } else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function kiemtra(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => '"Bạn cần đăng nhập tài khoản để chuyển hồ so", "Lỗi!!!"',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();
        $ngaychuyen = Carbon::now()->toDateTimeString();
        if(isset($inputs['id'])){
            $model = KkGiaGiay::where('id',$inputs['id'])
                ->first();
            $date = date_create($ngaychuyen);
            if(date('H',strtotime($ngaychuyen)) >= '17')
                $datenew = date_modify($date, "+1 days");
            else
                $datenew = $date;

            $ngaychuyen = date_format($datenew, "Y-m-d");
            $ngayduyet = $model->ngayhieuluc;
            $ngaylv = 0;
//            dd($ngaychuyen.'-'.$ngayduyet);
            while (strtotime($ngaychuyen) <= strtotime($ngayduyet)) {
                $checkngay = NgayNghiLe::where('tungay', '<=', $ngaychuyen)
                    ->where('denngay', '>=', $ngaychuyen)->get();
                if (count($checkngay) > 0)
                    $ngaylv = $ngaylv;
                elseif (date('D', strtotime($ngaychuyen)) == 'Sat')
                    $ngaylv = $ngaylv;
                elseif (date('D', strtotime($ngaychuyen)) == 'Sun')
                    $ngaylv = $ngaylv;
                else
                    $ngaylv = $ngaylv + 1;
                //dd($ngaylv);
                $datestart = date_create($ngaychuyen);
                $datestartnew = date_modify($datestart, "+1 days");
                $ngaychuyen = date_format($datestartnew, "Y-m-d");

            }
            $modeldv = Town::where('maxa',$model->mahuyen)
                ->first();
            if ($ngaylv >= $modeldv->songaylv) {
                $result['message'] = '<div class="form-group" id="tthschuyen">';
                $result['message'] .= '<label> Số CV: '.$model->socv.'- Ngày áp dụng: '.getDayVn($model->ngayhieuluc).'</label>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';

            }else{
                $result['status'] = 'fail';
                $result['message'] = '"Ngày áp dụng hồ sơ không đủ điều kiện xét duyệt", "Lỗi!!!"';
            }
        }
        //dd($result);
        die(json_encode($result));
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $model = KkGiaGiay::where('id',$inputs['idchuyen'])
                    ->first();
                $inputs['trangthai'] = 'CD';
                $inputs['ngaychuyen'] = Carbon::now()->toDateTimeString();
                if($model->update($inputs)){
                    $modeldn = Company::where('maxa', $model->maxa)
                        ->first();
                    $modeldv = Town::where('maxa',$model->mahuyen)
                        ->first();
                    $dmnghe = DmNgheKd::where('manghe','GIAY')
                        ->where('manganh','GIAY')
                        ->first();
                    $tg = getDateTime(Carbon::now()->toDateTimeString());
                    $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp. Số công văn: '.$model->socv.
                        ' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['ttnguoinop'].'!!!';
                    $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->maxa.
                        ' Số công văn: '.$model->socv.' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['ttnguoinop'].'!!!';
                    $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                    $run->handle();
                }
                return redirect('kekhaigiagiay?&masothue='.$model->maxa);
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function showlydo(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkGiaGiay::where('id',$inputs['id'])
                ->first();
            $modelql = Town::where('maxa',$model->mahuyen)->first();
            $modeldn = Company::where('maxa',$model->maxa)
                ->first();

            $result['message'] = '<div class="form-group" id="showlydo">';
            $result['message'] = '<label style="color: blue"><b>'.$modelql->tendv.'</b> trả lại hồ sơ kê khai giá số: <b>'.$model->socv.'</b> của '.$modeldn->tendn.'- mã số thuế <b>'.$modeldn->maxa.'</b> vào lúc <b>'.getDateTime($model->updated_at).'</b>.<br> Lý do trả lại: '.$model->lydo.'</lable>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }
}

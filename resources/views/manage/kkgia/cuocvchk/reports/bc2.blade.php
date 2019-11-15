@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="text-transform: uppercase;">
            --------<br><br>
            Số:
        </td>
        <td>
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br>
            <b><i><u>Độc lập - Tự do - Hạnh phúc</u></i></b><br><br>
            <i>....., Ngày ..... tháng ..... năm .....</i>
        </td>
    </tr>
</table>

<p style="text-align: center; font-weight: bold; font-size: 16px;text-transform: uppercase;">BÁO CÁO KÊ KHAI Cước vận chuyển hành khách: xe buýt, xe điện, bè mảng</p>
<p style="text-align: center; font-size: 14px;">
    Thời điểm: @if($inputs['time'] == 'ngay')
                   Từ ngày {{$inputs['tungay']}} đến ngày {{$inputs['denngay']}}
               @elseif($inputs['time'] == 'thang')
                    Tháng {{$inputs['thang']}} Năm {{$inputs['nam']}}
               @else
                    Quý {{$inputs['quy']}} Năm {{$inputs['nam']}}
               @endif
</p>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
    <tr>
        <th style="text-align: center ; margin: auto" width="2%">STT</th>
        <th style="text-align: center" width="20%">Doanh nghiệp</th>
        <th style="text-align: center">Loại xe</th>
        <th style="text-align: center">Quy cách chất lượng</th>
        <th style="text-align: center">Mô tả</th>
        <th style="text-align: center">Mức giá <br>liền kề</th>
        <th style="text-align: center">Mức giá <br>kê khai</th>
    </tr>
    </thead>
    <tbody>
    @foreach($modeldvql as $dvql)
        <tr>
            <td></td>
            <td colspan="6" style="font-weight: bold; text-align: left">{{$dvql->tendv}}</td>
        </tr>
        <?php $model = $model->where('mahuyen',$dvql->maxa)?>
        @foreach($model as $key=>$tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td class="active" colspan="6">{{$tt->tendn}}
                    -<b>Mã số thuế:</b> {{$tt->maxa}}
                    -<b>Mã hồ sơ:</b> {{$tt->mahs}}
                . Số công văn :{{$tt->socv}} -
                Ngày hiệu lực: {{getDayVn($tt->ngayhieuluc)}}
                - Ngày chuyển: {{getDateTime($tt->ngaychuyen)}}
                <br>Số hồ sơ nhận: {{$tt->sohsnhan}} - Ngày nhận: {{getDayVn($tt->ngaynhan)}}</td>
            </tr>
            <?php $modelct = $modelct->where('mahs',$tt->mahs)?>
            @foreach($modelct as $key2=>$tt)
                <tr>
                    <td></td>
                    <td style="text-align: center">{{($key2 +1)}}</td>
                    <td class="active">{{$tt->loaixe}}</td>
                    <td style="text-align: left">{{$tt->qccl}}</td>
                    <td style="text-align: left;font-weight: bold">{{$tt->mota}}</td>
                    <td style="text-align: right;font-weight: bold">{{number_format($tt->dongialk).'đ/'.$tt->sllk.' '.$tt->dvtlk}}</td>
                    <td style="text-align: right;font-weight: bold">{{number_format($tt->dongia).'đ/'.$tt->sl.' '.$tt->dvt}}</td>
                </tr>
            @endforeach
        @endforeach
    @endforeach
    </tbody>
</table>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:20px auto; text-align: center;">
    <tr>
        <td style="text-align: left;" width="30%">

        </td>
        <td style="text-align: center;text-transform: uppercase; " width="70%">
            <b></b><br>
        </td>
    </tr>
</table>
@stop
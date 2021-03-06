@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%">
            <span style="text-transform: uppercase">{{$inputs['dvcaptren']}}</span><br>
            <span style="text-transform: uppercase;font-weight: bold">{{$inputs['dv']}}</span><br>
            <hr style="width: 10%"> <br>
            Số: {{$model->soqd}}
        </td>
        <td>
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập - Tự do - Hạnh phúc</b><br>
            <hr style="width: 15%"><br>
            <i>{{$inputs['diadanh']}}, ngày .... tháng .... năm ....</i>
        </td>
    </tr>
</table>
<p style="text-transform: uppercase;font-weight: bold;text-align: center">{{$model->ttqd}} </p>
<p style="text-align: center">Ngày áp dụng: {{getDayVn($model->ngayqd)}} </p>
<div class="row">
    <div class="col-md-12">
        <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
            <tr>
                <th width="2%" style="text-align: center">STT</th>
                <th style="text-align: center">Mô tả</th>
                <th style="text-align: center" width="10%">Đơn vị tính</th>
                <th style="text-align: center" width="10%">Mức giá</th>
            </tr>
            @foreach($modelct as $key=>$ct)
                <tr>
                    <td style="text-align: center">{{$key + 1}}</td>
                    <td class="active">{{$ct->mota}}</td>
                    <td >{{$ct->dvt}}</td>
                    <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($ct->gia,5)}}</td>
            @endforeach
        </table>
    </div>
</div>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="text-align: left;vertical-align: top;">
            <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
            - UBND tỉnh;<br>
            - Bộ tài chính;<br>
            - Lưu: VT, QLGCS.
        </td>
        <td>
            <b>THỦ TRƯỞNG ĐƠN VỊ</b><br>
            <i>(Ký tên, đóng dấu)</i><br><br><br><br><br><br><br>
        </td>
    </tr>
</table>
@stop
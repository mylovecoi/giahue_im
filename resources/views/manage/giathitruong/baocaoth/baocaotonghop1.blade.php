@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
<p style="text-align: center; font-weight: bold">PHỤ LỤC SỐ 1</p>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="vertical-align: top;">
            <span style="text-transform: uppercase">{{$inputs['dvcaptren']}}</span><br>
            <span style="text-transform: uppercase;font-weight: bold">{{$inputs['dv']}}</span>
            <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

        </td>
        <td style="vertical-align: top;">
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập - Tự do - Hạnh phúc</b>
            <hr style="width: 15%;vertical-align: top; margin-top: 2px">

        </td>
    </tr>
    <tr>
        <td>Số: ..............</td>
        <td style="text-align: right"><i style="margin-right: 25%;">{{$inputs['diadanh']}}, ngày .... tháng {{$inputs['thang']}} năm {{$inputs['nam']}}</i></td>
    </tr>
</table>

<p style="text-align: center; font-weight: bold; font-size: 16px;">BẢNG GIÁ THỊ TRƯỜNG THÁNG {{$inputs['thang']}} NĂM {{$inputs['nam']}}</p>
<p style="font-style: italic; text-align: center">(Ban hành kèm theo Thông tư số 116/2018/TT-BTC ngày 28/11/2018 của Bộ Tài Chính quy định chế độ báo cáo giá thị trường)</p>
<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
        <tr>
            <th width="2%" style="text-align: center" >STT</th>
            <th style="text-align: center">Mã hàng hóa<br> dịch vụ</th>
            <th style="text-align: center" >Tên hàng hóa dịch vụ</th>
            <th style="text-align: center">Đặc điểm kỹ thuật</th>
            <th style="text-align: center" >Đơn vị tính</th>
            <th style="text-align: center" >Loại giá</th>
            <th style="text-align: center" >Giá kỳ <br>trước<br>{{$inputs['thanglk']}}/{{$inputs['namlk']}}</th>
            <th style="text-align: center" >Giá kỳ <br>này<br>{{$inputs['thang']}}/{{$inputs['nam']}}</th>
            <th style="text-align: center">Mức tăng<br>(giảm)</th>
            <th style="text-align: center">Tỷ lệ<br>tăng<br>(giảm)<br>(%)</th>
            <th style="text-align: center">Nguồn thông tin</th>
            <th style="text-align: center" width="10%">Ghi chú</th>
        </tr>
        <tr style="font-size: 10px">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9=8-7</th>
            <th>10=8/7</th>
            <th>11</th>
            <th>12</th>
        </tr>
    </thead>
    <tbody>
    @foreach($modelgr as $keygr=>$gr)
        <tr>
            <td>{{romanNumerals($keygr + 1)}}</td>
            <td style="text-align: center">{{$gr->manhom}}</td>
            <td colspan="10" style="font-weight: bold">{{$gr->tennhom}}</td>
        </tr>
        @if($ttct = $model->where('manhom',$gr->manhom))@endif
        @foreach($ttct as $key=>$tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td style="text-align: center">{{$tt->mahh}}</td>
                <td class="active" style="font-weight: bold">{{$tt->tenhh}}</td>
                <td>{{$tt->dacdiemkt}}</td>
                <td style="text-align: center">{{$tt->dvt}}</td>
                <td style="text-align: center">KT: {{$tt->loaigiakt}} <br> KN: {{$tt->loaigia}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->dongialk,5)}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->dongia,5)}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->dongia - $tt->dongialk,5)}}</td>
                <td style="text-align: right;font-weight: bold">{{number_format($tt->dongialk) == 0 ? ''
                                : dinhdangsothapphan($tt->dongia/$tt->dongialk,2)}}</td>
                <td>KT: {{$tt->nguonttkt}}<br>KN: {{$tt->nguontt}}</td>
                <td>KT: {{$tt->ghichukt}}<br>KN: {{$tt->ghichu}}</td>
            </tr>
        @endforeach
    @endforeach

    </tbody>
</table>
<table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
    <tr>
        <td width="40%" style="text-align: left; vertical-align: top;">
            <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
            - UBND tỉnh;<br>
            - Bộ tài chính;<br>
            - Lưu: VT, QLGCS.
        </td>
        <td style="vertical-align: top;">
            <b>THỦ TRƯỞNG ĐƠN VỊ</b><br>
            <i>(Ký tên, đóng dấu)</i>
        </td>
    </tr>
</table>
@stop
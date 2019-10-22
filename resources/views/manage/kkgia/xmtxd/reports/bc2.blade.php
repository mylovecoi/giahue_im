<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$pageTitle}}</title>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
    <style type="text/css">
        body {
            font: normal 14px/16px time, serif;
        }

        table, p {
            width: 98%;
            margin: auto;
        }

        table tr td:first-child {
            text-align: center;
        }

        td, th {
            padding: 10px;
        }
        p{
            padding: 5px;
        }
        span{
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body style="font:normal 14px Times, serif;">
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

<p style="text-align: center; font-weight: bold; font-size: 16px;">BÁO CÁO KÊ KHAI GIÁ XI MĂNG, THÉP XÂY DỰNG</p>
<p style="text-align: center; font-size: 14px;">
    Thời điểm: @if($inputs['time'] == 'ngay')
                   Từ ngày {{$inputs['tungay']}} đến ngày {{$inputs['denngay']}}
               @elseif($inputs['time'] == 'thang')
                    Tháng {{$inputs['thang']}} Năm {{$inputs['nam']}}
               @else
                    Quý {{$inputs['quy']}} Năm {{$inputs['nam']}}
               @endif
</p>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <thead>
    <tr>
        <th style="text-align: center ; margin: auto" width="2%">STT</th>
        <th style="text-align: center" width="20%">Doanh nghiệp</th>
        <th style="text-align: center">Tên xi măng, thép xây dựng</th>
        <th style="text-align: center">Quy cách, chất lượng</th>
        <th style="text-align: center">Đơn vị<br>tính</th>
        <th style="text-align: center">Giá<br>liền kề</th>
        <th style="text-align: center">Giá <br>kê khai</th>
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
                    <td class="active">{{$tt->ten}}</td>
                    <td style="text-align: left">{{$tt->qccl}}</td>
                    <td style="text-align: center">{{$tt->dvt}}</td>
                    <td style="text-align: right">{{number_format($tt->gialk)}}</td>
                    <td style="text-align: right">{{number_format($tt->gia)}}</td>
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
</body>
</html>
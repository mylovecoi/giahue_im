@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        $(function(){
            $('#nam').change(function() {
                var namhs = '&nam=' + $('#nam').val();
                var url = '/giathuematdatmatnuoc?'+namhs;
                window.location.href = url;
            });
            $('#trangthai').change(function() {
                var namhs = '&nam=' + $('#nam').val();
                var trangthai = '&trangthai=' + $('#trangthai').val();
                var url = '/giathuematdatmatnuoc?'+namhs + trangthai;
                window.location.href = url;
            });

            $('#diaban').change(function() {
                var nam = '&nam='+ $('#nam').val();
                var trangthai = '&trangthai=' + $('#trangthai').val();
                var diaban = '&diaban='+ $('#diaban').val();
                var url = '/giathuematdatmatnuoc?' + nam +trangthai + diaban;

                window.location.href = url;
            });

        });
        function confirmDelete(id) {
            document.getElementById("iddelete").value=id;
        }
        function confirmHoanthanh(id) {
            document.getElementById("idhoanthanh").value=id;
        }
        function confirmHHT(id){
            document.getElementById("idhuyhoanthanh").value=id;
        }
        function confirmCB(id){
            document.getElementById("idcongbo").value=id;
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin hồ sơ thuê<small>&nbsp;mặt đất- mặt nước</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        @if(can('kkgiathuedatnuoc','create'))
                        <a href="{{url('giathuematdatmatnuoc/create?&diaban='.$inputs['diaban'])}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Thêm mới </a>
                        @endif
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Năm hồ sơ</label>
                                <select name="nam" id="nam" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                    @if ($nam_stop = intval(date('Y')) + 1) @endif
                                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Trạng thái hồ sơ</label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    @if(session('admin')->level == 'X')
                                    <option value="CHT" {{$inputs['trangthai'] == 'CHT' ? 'selected' : ''}}>Chưa hoàn thành</option>
                                    @endif
                                    <option value="HT" {{$inputs['trangthai'] == 'HT' ? 'selected' : ''}}>Hoàn thành</option>
                                    <option value="HHT" {{$inputs['trangthai'] == 'HHT' ? 'selected' : ''}}>Hủy hoàn thành</option>
                                    <option value="CB" {{$inputs['trangthai'] == 'CB' ? 'selected' : ''}}>Công bố</option>
                                </select>
                            </div>
                        </div>
                        @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Địa bàn quản lý</label>
                                    <select name="diaban" id="diaban" class="form-control">
                                        @foreach($modeldb as $db)
                                            <option value="{{$db->district}}" {{$db->district == $inputs['diaban'] ? 'selected' : ''}}>{{$db->diaban}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center">Số quyết định</th>
                            <th style="text-align: center">Ngày áp dụng</th>
                            <th style="text-align: center">Ghi chú</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center" width="33%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td style="text-align: center">{{$tt->soqd}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngayapdung)}}</td>
                                <td>{{$tt->ghichu}}</td>
                                <td style="text-align: center">
                                    @if($tt->trangthai == 'HT')
                                        <span class="badge badge-warning">Hoàn thành</span>
                                    @elseif($tt->trangthai == 'CHT')
                                        <span class="badge badge-danger">Chưa hoàn thành</span>
                                    @elseif($tt->trangthai == 'HHT')
                                        <span class="badge badge-danger">Hủy hoàn thành</span>
                                    @else
                                        <span class="badge badge-success">Công bố</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('giathuematdatmatnuoc/'.$tt->id)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    @if($tt->trangthai == 'CHT' || $tt->trangthai == 'HHT')
                                        @if(can('kkgiathuedatnuoc','edit'))
                                            <a href="{{url('giathuematdatmatnuoc/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                        @endif
                                        @if(can('kkgiathuedatnuoc','approve'))
                                            <button type="button" onclick="confirmHoanthanh('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#hoanthanh-modal-confirm" data-toggle="modal"><i class="fa fa-check"></i>&nbsp;Hoàn thành</button>
                                        @endif
                                        @if($tt->trangthai == 'CHT')
                                            @if(can('kkgiathuedatnuoc','delete'))
                                                <button type="button" onclick="confirmDelete('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                                Xóa</button>
                                            @endif
                                        @endif
                                    @endif
                                    @if($tt->trangthai == 'HT' || $tt->trangthai == 'CB')
                                        @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                                        @if($tt->trangthai == 'HT')
                                            @if(can('thgiathuedatnuoc','congbo'))
                                                <button type="button" onclick="confirmCB('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal-confirm" data-toggle="modal"><i class="fa fa-send"></i>&nbsp;
                                                    Công bố</button>
                                            @endif
                                        @endif
                                            @if(can('kkgiathuedatnuoc','approve'))
                                                <button type="button" onclick="confirmHHT('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#huyhoanthanh-modal-confirm" data-toggle="modal"><i class="fa fa-times"></i>&nbsp;
                                                    Hủy hoàn thành</button>
                                            @endif
                                        @endif
                                    @endif

                                    <!--a href="{{url('hoso-thamdinhgia/'.$tt->mahs.'/history')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Lịch sử</a-->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    @include('includes.e.modal-attackfile')
    <!--Modal Delete-->
    <div id="delete-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giathuematdatmatnuoc/delete','id' => 'frm_delete'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                    <input type="hidden" name="iddelete" id="iddelete">

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickdelete()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        function clickdelete(){
            $('#frm_delete').submit();
        }
    </script>
    <!--Modal Hoàn thành-->
    <div id="hoanthanh-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giathuematdatmatnuoc/hoanthanh','id' => 'frm_hoanthanh'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành hồ sơ?</h4>

                    <input type="hidden" name="idhoanthanh" id="idhoanthanh">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ đã hoàn thành sẽ không được phép chỉnh sửa và xóa hồ sơ nữa!Bạn cần liên hệ cơ quan chủ quản để chỉnh sửa hồ sơ nếu cần!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickhoanthanh()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!--Modal Hủy Hoàn thành-->
    <div id="huyhoanthanh-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giathuematdatmatnuoc/huyhoanthanh','id' => 'frm_huyhoanthanh'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hủy hoàn thành hồ sơ?</h4>

                    <input type="hidden" name="idhuyhoanthanh" id="idhuyhoanthanh">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ Bị hủy sẽ chuyển lại cho cơ quan nhập chủ quản có thể chỉnh sửa hồ sơ!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickhuyhoanthanh()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!--Modal Hủy Hoàn thành-->
    <div id="congbo-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giathuematdatmatnuoc/congbo','id' => 'frm_congbo'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý công bố hồ sơ?</h4>

                    <input type="hidden" name="idcongbo" id="idcongbo">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ sẽ được công bố lên trang công bố của tỉnh!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickcongbo()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        function clickhoanthanh(){
            $('#frm_hoanthanh').submit();
        }
        function clickcongbo(){
            $('#frm_congbo').submit();
        }
        function clickhuyhoanthanh(){
            $('#frm_huyhoanthanh').submit();
        }
    </script>

@stop
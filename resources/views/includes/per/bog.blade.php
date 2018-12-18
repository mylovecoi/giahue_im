
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <input type="checkbox" {{ (isset($permission->bog->index) && $permission->bog->index == 1) ? 'checked' : '' }} value="1" name="roles[bog][index]"/> Bình ổn giá
                </div>
                <div class="tools">
                    <a href="" class="expand" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form" style="display: none;">
                <div class="form-body">
                    <div class="row">
                        @if($model->level == 'T' || $model->level == 'H' || $model->level == 'X')
                        <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <input type="checkbox" {{ (isset($permission->bpbog->index) && $permission->bpbog->index == 1) ? 'checked' : '' }} value="1" name="roles[bpbog][index]"/>Biện pháp bình ổn giá
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand" data-original-title="" title="">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body form" style="display: none;">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="action">
                                                        <tr>
                                                            <th class="table-checkbox" width="5%">
                                                                <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                                            </th>
                                                            <th>Danh mục mặt hàng BOG</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->dmbog->index) && $permission->dmbog->index == 1) ? 'checked' : '' }} value="1" name="roles[dmbog][index]"/></td>
                                                            <td>Xem</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->dmbog->create) && $permission->dmbog->create == 1) ? 'checked' : '' }} value="1" name="roles[dmbog][create]"/></td>
                                                            <td>Thêm mới</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->dmbog->edit) && $permission->dmbog->edit == 1) ? 'checked' : '' }} value="1" name="roles[dmbog][edit]"/></td>
                                                            <td>Chỉnh sửa</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->dmbog->delete) && $permission->dmbog->delete == 1) ? 'checked' : '' }} value="1" name="roles[dmbog][delete]"/></td>
                                                            <td>Xóa</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="action">
                                                        <tr>
                                                            <th class="table-checkbox" width="5%">
                                                                <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                                            </th>
                                                            <th>Kê khai BOG</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->kkbog->index) && $permission->kkbog->index == 1) ? 'checked' : '' }} value="1" name="roles[kkbog][index]"/></td>
                                                            <td>Xem</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->kkbog->create) && $permission->kkbog->create == 1) ? 'checked' : '' }} value="1" name="roles[kkbog][create]"/></td>
                                                            <td>Thêm mới</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->kkbog->edit) && $permission->kkbog->edit == 1) ? 'checked' : '' }} value="1" name="roles[kkbog][edit]"/></td>
                                                            <td>Chỉnh sửa</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->kkbog->delete) && $permission->kkbog->delete == 1) ? 'checked' : '' }} value="1" name="roles[kkbog][delete]"/></td>
                                                            <td>Xóa</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->kkbog->approve) && $permission->kkbog->approve == 1) ? 'checked' : '' }} value="1" name="roles[kkbog][approve]"/></td>
                                                            <td>Xét duyệt</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead class="action">
                                                        <tr>
                                                            <th class="table-checkbox" width="5%">
                                                                <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                                            </th>
                                                            <th>Tổng hợp</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->thbog->baocao) && $permission->thbog->baocao == 1) ? 'checked' : '' }} value="1" name="roles[thbog][baocao]"/></td>
                                                            <td>Báo cáo</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->thbog->congbo) && $permission->thbog->congbo == 1) ? 'checked' : '' }} value="1" name="roles[thbog][congbo]"/></td>
                                                            <td>Công bố </td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox" {{ (isset($permission->thbog->timkiem) && $permission->thbog->timkiem == 1) ? 'checked' : '' }} value="1" name="roles[thbog][timkiem]"/></td>
                                                            <td>Tìm kiếm</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif
                    </div>
                    @include('includes.per.include.dangkygia.dangkygia')
                </div>
            </div>
        </div>
    </div>
</div>

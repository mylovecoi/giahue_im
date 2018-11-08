<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <input type="checkbox" {{ (isset($setting->dinhgia->index) && $setting->dinhgia->index == 1) ? 'checked' : '' }} value="1" name="roles[dinhgia][index]"/> Định giá
                </div>
                <div class="tools">
                    <a href="" class="expand" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form" style="display: none;">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3">
                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <td width="2%"><input type="checkbox" {{ (isset($setting->giacacloaidat->index) && $setting->giacacloaidat->index == 1) ? 'checked' : '' }} value="1" name="roles[giacacloaidat][index]"/></td>
                                    <td>Giá các loại đất</td>
                                </tr>
                                <tr>
                                    <td width="2"><input type="checkbox" {{ (isset($setting->giacacloaidat->congbo) && $setting->giacacloaidat->congbo == 1) ? 'checked' : '' }} value="1" name="roles[giacacloaidat][congbo]"/></td>
                                    <td>Công bố giá các loại đất</td>
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
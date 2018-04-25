@extends('adminlte::page')
@section('header', 'Youtube')
@section('description', 'last update')

@section('js')
<!-- Resources -->
<script src="{{{ URL::asset('vendor/amcharts/amcharts.bundle.js')}}}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Hari Ini</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>

            </div>
            <div class="box-body">
                <div>
                    @include('pages.sosmed.youtube.today')
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- DONUT CHART -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Channel Teraktif (Khofifah-Emil)</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="#tab_2k" data-toggle="tab">Emil</a></li>
                        <li class="active"><a href="#tab_1k" data-toggle="tab">Khofifah</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1k">
                            @include('pages.sosmed.youtube.userkhof')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2k">
                            @include('pages.sosmed.youtube.useremil')
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Seminggu Ini</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div>
                    @include('pages.sosmed.youtube.weeks')
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- BAR CHART -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Channel Teraktif (Gus Ipul-Puti)</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li><a href="#tab_2g" data-toggle="tab">Puti</a></li>
                            <li class="active"><a href="#tab_1g" data-toggle="tab">Gus Ipul</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1g">
                                @include('pages.sosmed.youtube.useripul')
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2g">
                                @include('pages.sosmed.youtube.userputi')
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
</div>
<!-- /.row -->
@endsection
@extends('layouts.admin')

@section('content')

<div class="row">
    @if(Auth::user()->userRole==config('services.userRole.SUPERADMIN'))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$totalSubAdmin}}</h3>

                <p>Sub Admin</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endif

    @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN')]))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$totalMasters}}</h3>

                <p>Master</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>    
    <!-- ./col -->
    @endif

    @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN'),config('services.userRole.MASTER')]))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$totalSuperAgent}}</h3>

                <p>Super Agents</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endif

    @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN'),config('services.userRole.MASTER'),config('services.userRole.SUPERAGENT')]))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$totalAgent}}</h3>

                <p>Agents</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endif
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3>{{$totalClient}}</h3>

                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

@endsection
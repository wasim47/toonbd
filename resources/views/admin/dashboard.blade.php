@extends('admin.include.master') 
@section('title') Welcome to ToonBD.com @endsection 
@section('content')

 <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <!--<div class="title-bar-actions">
              <select class="selectpicker dropdown" name="period" data-dropdown-align-right="true" data-style="btn-default btn-sm" data-width="fit">
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="last_7d" selected="selected">Last 7 days</option>
                <option value="last_1m">Last 30 days</option>
                <option value="last_3m">Last 90 days</option>
              </select>
            </div>-->
            <h1 class="title-bar-title"><span class="d-ib">Dashboard - ToonBD</span></h1>
            
          </div>
          <?php /*?><div class="row gutter-xs">
          	 <h3 style="margin-left:10px; font-size:18px">Summery :: Our Applications</h3>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                  <div class="p-x">
                    <small style="font-size:18px;">Total Hospital</small>
                    <h3 class="card-title fw-l">{{ $totalhospital }}</h3>
                  </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                  <div class="p-x">
                    <small style="font-size:18px;">Total Hospital Users</small>
                    <h3 class="card-title fw-l">{{ $totalhospitalusers }}</h3>
                  </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                  <div class="p-x">
                    <small style="font-size:18px;">Total DGHS Users</small>
                    <h3 class="card-title fw-l">{{ $totaldghs }}</h3>
                  </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                  <div class="p-x">
                    <small style="font-size:18px;">Total Hospital Bed</small>
                    <h3 class="card-title fw-l">{{ $hospitalTotalBed }}</h3>
                  </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                  <div class="p-x">
                    <small style="font-size:18px;">Total Available Bed</small>
                    <h3 class="card-title fw-l">{{ $available_data }}</h3>
                  </div>
              </div>
            </div>
            
          </div><?php */?>
          
          
          
        
        
        </div>
      </div>
    
    
@endsection

@section('footerScript')
	
    
@endsection
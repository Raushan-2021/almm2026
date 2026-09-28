@extends('layouts.masters.backend')
@section('content')
@section('title', 'Track Application : '.$applications->application_no)
<style>
    /* .card{
        border:none;
    }
    .isteColor{
        color: #cd2147;
    }
    .isteColor:hover{
        color: #353A40;
    }
    .timeline p{
        margin-bottom: 0px;
    }
   
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 40px 0;
        padding-left: 60px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #cd2147;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    } */
    .card{
        border:none;
    }
    .isteColor{
        color: #cd2147;
    }
    .isteColor:hover{
        color: #353A40;
    }
    .timeline p{
        margin-bottom: 0px;
    }
    
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
    display:none;
    }
    ul.timeline > li {
    min-height: 200px;
    min-width: 275px;
    }
    ul.timeline > li:after{content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 100%;
    height: 2px;
    z-index: 400;
    top: 10px;}
  
    ul.timeline > li:last-child:after{display:none;}
   .timeline_innertext {
    position: absolute;
    top: 25px;
    left: 0;
    padding: 15px;
}
.check_img{position: absolute;
    border-radius: 50%;
    left: 5px;
    width: 50px;
    height: 50PX;
    top: -12px;
    z-index: 999;}
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">

            <div class="col-md-12">

                <ul class="timeline d-flex pt-4" style="    overflow: auto;">
                    <li class="">
                        <img src="{{ URL::asset('frontend/images/check_img.gif') }}" class="check_img">
                        <div class="timeline_innertext">
                        <span ><strong><?php $user=Auth::user(); if(!empty($user->country_id)){?>{{Auth::user()->name}} -  <?php  }?><span  class="text-success"> Application has been submitted successfully By User</span></strong></span>
                        <p class="article text-success"> <em> <small>{{ date("d-M-Y",strtotime($applications->created_at)) }}</small> </em></p>
                        </div>
                    </li>
                    <?php
                    //echo "<pre>";
                    //print_r($trackDetail);die;
                    ?>
                    @foreach ($trackDetail as $key => $trackDetail)

                    <li class="">
                        <img src="{{ URL::asset('frontend/images/check_img.gif') }}" class="check_img">
                        <div class="timeline_innertext">
                            <span><strong class="text-uppercase">{{$trackDetail->user_type}}</strong> - {{$trackDetail->action}}</span>
                        <p class="article text-success"> <em> <small>{{ date("d-M-Y",strtotime($trackDetail->created_at)) }}</small> </em></p>
                        </div>
                        
                    </li>
                    @endforeach
                    
                </ul>


            </div>
        </div>
        <a onclick="history.back()" class="btn btn-warning">Back</a>
    </div>

</div>

@endsection

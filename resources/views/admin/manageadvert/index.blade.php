<?php 

use App\Lip\Helper;

?>

@extends('layouts.adminLayouts')

@section('content')

<style>
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }
    .custom-panel-body {
        overflow: visible !important;
    }
</style>

<div class="row justify-content-center" style="margin: 30px 0;">
    <section class="col-lg-8" style="width: 76.666667%;margin-left: -20%;">
        <div class="custom-panel">
            <div class="custom-panel-heading">
                <h3>مشاهده کل تبلیعات</h3>
            </div>
            <div class="custom-panel-body">
                
                <div class="form-group mb-4">
                    <div class="panel-heading"><h3 style="margin: 0;">تبلیغات</h3></div>
                    
                    <div style="width: 90%; margin:auto; ">
                        <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th class="text-center">شماره تبلیغات</th>
                                    <th class="text-center">موضع تبلیغات</th>
                                    <th class="text-center">ایمیل</th>
                                    <th class="text-center">شماره موبایل</th>
                                    <th class="text-center">شهر</th>
                                    <th class="text-center">نوع تبلیغات</th>
                                    <th class="text-center">وضعیت</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1?>
                                @foreach ($adverts as $advert)
                                <tr >
                                    <td>{{ $i }}</td>
                                    <td style="cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#Modal{{$advert->id}}">{{$advert->subject}}</td>
                                    <td>{{$advert->email}}</td>
                                    <td>{{$advert->mobile}}</td>
                                    <td>{{$advert->city}}</td>
                                    <td>
                                        
                                    @if ($advert->type==1)
                                         <span style="color: #1c7430;">فرشی</span>
                                         @else
                                         <span style="color:darkred ;">درخواستی</span>
                                    @endif
                                
                                    </td>
                                    <td>
                                    <form action="/chechadvert" method="post">
                                                @csrf
                                        @if ($advert->check==1)
                                        <button type="submit"><i class="fa fa-check" style="color: #1c7430;"></i></button>
                                            <input type="hidden" value="{{$advert->id}}" name="advert_id">
                                            @else
                                            <input type="hidden" value="{{$advert->id}}" name="advert_id">
                                            <button type="submit"><i class="fa fa-remove" style="color:red;"></i></button>
                                        @endif

                                    </form>

                                    </td>
                                    <td  >
                                    <form action="/removeadvert" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$advert->id}}" name="advert_id">
                                      <button type="submit"> <i class="fa fa-trash" style="color: darkred;"></i> </button>  
                                    </form>
                                        
                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            </tbody>
                        </table>

                       {{ $adverts->links() }}

                    </div>
                    
                </div>

            </div>
        </div>
    </section>


  <!-- Modal ها -->
@foreach ($adverts as $advert)
    <div class="modal fade" id="Modal{{$advert->id}}" tabindex="-1" aria-labelledby="ModalLabel{{$advert->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="direction: rtl;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel{{$advert->id}}">{{$advert->subject}}</h5>
                    
                </div>
                <div class="modal-body">
                    
                    @php
                        $car = \App\Models\Car::where('advert_id', $advert->id)->first();
                        $estate = \App\Models\Estate::where('advert_id', $advert->id)->first();
                    @endphp

                    {{-- اگر ماشین وجود دارد --}}
                    @if ($car)
                        @php
                            $type = match($car->type) {
                                0 => 'فروشی',
                                1 => 'اجاره',
                                default => 'درخواستی',
                            };
                        @endphp
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>برند</th>
                                    <th>سال ساخت</th>
                                    <th>کارکرد (کیلومتر)</th>
                                    <th>نوع</th>
                                    <th>قیمت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->year }}</td>
                                    <td>{{ $car->run_time }}</td>
                                    <td>{{ $type }}</td>
                                    <td>{{ $car->price }}</td>
                                </tr>
                            </tbody>
                        </table>

                    {{-- اگر ملک وجود دارد --}}
                    @elseif ($estate)
                        @php
                            $type = match($estate->typeAdvert) {
                                1 => 'فروشی',
                                2 => 'اجاره',
                                default => 'درخواستی',
                            };
                        @endphp
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>مبلغ گروی</th>
                                    @if($estate->typeAdvert == 2 || $estate->typeAdvert == 3)
                                        <th>مبلغ اجاره</th>
                                    @endif
                                    <th>نوع</th>
                                    <th>تعداد اتاق</th>
                                    <th>متراج</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $estate->deposite }} افغانی</td>
                                    @if($estate->typeAdvert == 2 || $estate->typeAdvert == 3)
                                        <td>{{ $estate->rent }} افغانی</td>
                                    @endif
                                    <td>{{ $type }}</td>
                                    <td>{{ $estate->number }}</td>
                                    <td>{{ $estate->area }}</td>
                                </tr>
                            </tbody>
                        </table>

                    {{-- اگر هیچ‌کدام نبود فقط اطلاعات آگهی --}}
                    @else
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>شماره</th>
                                    <th>عنوان</th>
                                    <th>ایمیل</th>
                                    <th>موبایل</th>
                                    <th>شهر</th>
                                    <th>نوع</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $advert->id }}</td>
                                    <td>{{ $advert->subject }}</td>
                                    <td>{{ $advert->email }}</td>
                                    <td>{{ $advert->mobile }}</td>
                                    <td>{{ $advert->city }}</td>
                                    <td>
                                        @if($advert->type == 1)
                                            <span class="text-success">فروشی</span>
                                        @else
                                            <span class="text-danger">درخواستی</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endforeach




</div>
@endsection

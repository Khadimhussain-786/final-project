@extends('layouts.adminLayouts')


@section('content')

<div class="col-lg-12">

    <div class="col-lg-3">
        <div class="content">
             <i class="fa fa-users"></i>
             <p>1</p>
             <span>تعداد کل کاربران</span>
  
        </div>
    </div>

    <div class="col-lg-3">
        <div class="content">
             <i class="fa fa-comments"></i>
             <p>1</p>
             <span>تعداد کاربران</span>
  
        </div>
    </div>

    <div class="col-lg-3">
        <div class="content">
             <i class="fa fa-bullhorn"></i>
             <p>1</p>
             <span>تعداد کل تبلیغات</span>
  
        </div>
    </div>

</div>

<div class="col-lg-9" style="float:left; margin-left: 18px; margin-top: 20px;">
    <div class="panel panel-default" style="margin: top 30px; text-align:center !important; direction:rtl;">
        <h3> جدید ترین سفارشات</h3>
        <table class="table table-striped" style="margin: top 53px;">
            <thead>
                <tr>
                    <th style="text-align:center;">نام سفارش</th>
                    <th style="text-align:center;">تاریخ خرید</th>
                    <th style="text-align:center;">مبلغ</th>
                    
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>A12</td>
                    <td>1399/4/6</td>
                    <td>12000$</td>
                </tr>
                <tr>
                    <td>A12</td>
                    <td>1399/4/6</td>
                    <td>12000$</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
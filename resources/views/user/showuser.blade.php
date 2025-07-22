

@extends('layouts.adminLayouts')

@section('content')



<div class="row justify-content-center" style="margin: 30px 0;">
    <section class="col-lg-8" style="width: 76.666667%;margin-left: -20%;">
        <div class="custom-panel">
            <div class="custom-panel-heading">
                <h3>مشاهده کل کاربران</h3>
            </div>
            <div class="custom-panel-body">
                
                <div class="form-group mb-4">
                    <div class="panel-heading"><h3 style="margin: 0;">کاربران</h3></div>
                    
                    <div style="width: 90%; margin:auto; ">
                        <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th class="text-center">شماره تبلیغات</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">ایمیل</th>
                                    <th class="text-center">شماره موبایل</th>
                                    <th class="text-center">نقش</th>
                                    <th class="text-center">تاریخ ثبت نام</th>
                                    <th class="text-center">وضعیت</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1?>
                                @foreach ($users as $user)
                                <tr >
                                    <td>{{ $i }}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Modal{{$user->u_id}}">{{$user->role}}</td>
                                    <td>
                                        {{ new Verta($user->created_at) }}
                                    </td>
                                    <td>

                                     <form action="/admin/checkuser" method="post">
                                                @csrf
                                        @if ($user->status==1)
                                        <button type="submit"><i class="fa fa-check" style="color: #1c7430;"></i></button>
                                            <input type="hidden" value="{{$user->u_id}}" name="user_id">
                                            @else
                                            <input type="hidden" value="{{$user->u_id}}" name="user_id">
                                            <button type="submit"><i class="fa fa-remove" style="color:red;"></i></button>
                                        @endif
                                    </form>

                                    </td>
                                    <td  >
                                <button type="submit"> <i class="fa fa-trash" style="color: darkred;"></i> </button> 
                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            </tbody>
                        </table>

                      

                    </div>
                    
                </div>

            </div>
        </div>
    </section>

    <!-- modal -->
@foreach ($users as $user)
    <div class="modal fade" id="Modal{{$user->u_id}}" tabindex="-1" aria-labelledby="ModalLabel{{$user->u_id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="top: 30%;direction: rtl;position: absolute;left: 15%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel{{$user->u_id}}">تغیر نقش کاربر</h5>
                    
                </div>
                <div class="modal-body">
                    
                  <form action="/admin/changerole" method="post">
                     @csrf
                     <select id="" name="role" class="form-control">
                        <option value="مدیرسایت">مدیرسایت</option>
                        <option value="ناظر">ناظر</option>
                     </select>
                     <input type="hidden" value="{{ $user->u_id }}" name="id">
                   <input style="margin-top: 10px; float: left;" type="submit" class="btn btn-danger" value="تغیرنفش کاربر">
                  </form>

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

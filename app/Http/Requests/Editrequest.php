<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Editrequest extends FormRequest
{
    /**
     * آیا کاربر مجاز است؟
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * پیام‌های سفارشی برای خطاهای اعتبارسنجی
     */
    public function messages()
    {
        return [
            'city.required'        => 'فیلد شهر را پر کنید',
            'adType.required'      => 'نوع آگهی را انتخاب کنید',
            'deposite.required'    => 'فیلد گروی را پر کنید',
            'deposite.numeric'     => 'در فیلد گروی باید عدد وارد کنید',
            'rent.required'        => 'فیلد کرایه را پر کنید',
            'rent.numeric'         => 'در فیلد کرایه باید عدد وارد کنید',
            'numberRoom.required'  => 'تعداد اتاق را وارد کنید',

            'mobile.required'      => 'شماره موبایل را وارد کنید',
            'mobile.numeric'       => 'شماره موبایل فقط باید شامل اعداد باشد',
            'mobile.digits'        => 'شماره موبایل باید دقیقاً 10 رقم باشد',

            'email.required'       => 'ایمیل را وارد کنید',
            'email.email'          => 'لطفاً یک ایمیل معتبر وارد کنید',

            'text.required'        => 'توضیحات آگهی را وارد کنید',
            'text.min'             => 'توضیحات خیلی کم است. حداقل ۶ حرف وارد کنید',

            'area.required'        => ' متراج را وارد کنید',
            'area.numeric'         => ' متراج فقط باید شامل اعداد باشد',
        ];
    }

    /**
     * نام فارسی فیلدها برای نمایش در پیام‌ها
     */
    public function attributes()
    {
        return [
            'city'       => 'شهر',
            'adType'     => 'نوع آگهی',
            'deposite'   => 'گروی',
            'rent'       => 'کرایه',
            'numberRoom' => 'تعداد اتاق',
            'mobile'     => 'شماره موبایل',
            'email'      => 'ایمیل',
            'text'       => 'توضیحات',
            'area'       => 'متراج',
        ];
    }

    /**
     * قوانین اعتبارسنجی
     */
    public function rules(): array
    {
        return [
            'city'       => 'required',
            'adType'     => 'required',
            'deposite'   => 'required|numeric',
            'rent'       => 'required|numeric',
            'area'       => 'required|numeric',
            'numberRoom' => 'required',
            'mobile'     => 'required|numeric|digits:10',
            'email'      => 'required|email',
            'text'       => 'required|min:6',
        ];
    }
}

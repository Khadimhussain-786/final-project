<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function advert(){
        $category=Category::orderby('id','desc')->get();
        return view('advert',['category'=>$category]);
    }

    public function AdvertParent(Request $request){
        $id=$request->id;
        $category=Category::find($id);
        return $category;

    }

    public function Sendsubmenu(Request $request){
        //  $id = $request->id;
         $category = Category::where('parent_id','!=',0)->get();
         return $category;
    }

    public function subcats(Request $request){
        $id = $request->id;
        $category = Category::where('parent_id',$id)->where('parent_id','!=',0)->get();
         return $category;
    }
 
    public function send_advert2(Request $request){
       $id = $request->id;
       $category = Category::find($id);

       return $category;

    }

    /******addmobile********/



                // public function addmobile(Request $request)
                // {
                //     $mobile = $request->mobilelogin;

                //     if (!str_starts_with($mobile, '+')) {
                //         $mobile = '+93' . ltrim($mobile, '0');
                //     }

                //     $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

                //     try {
                //         $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'))
                //             ->verifications
                //             ->create($mobile, "sms");

                //         return response()->json([
                //             'status' => 'ok',
                //             'message' => 'کد تأیید ارسال شد',
                //             'mobile' => $mobile
                //         ]);

                //     } catch (\Exception $e) {
                //         return response()->json([
                //             'status' => 'error',
                //             'message' => 'ارسال کد با مشکل مواجه شد',
                //             'error' => $e->getMessage()
                //         ], 500);
                //     }
                // }


                public function addmobile(Request $request)
                {
                    $mobile = $request->mobilelogin;
                    $code = rand(100000, 999999); 

                    
                    if (!str_starts_with($mobile, '+')) {
                        $mobile = '+93' . ltrim($mobile, '0');
                    }

                  
                    $user = User::where('mobile', $mobile)->first();

                    if (!$user) {
                        $user = User::create([
                            'mobile' => $mobile,
                            'code' => $code
                        ]);
                    } else {
                        $user->code = $code;
                        $user->save();
                    }

                    // به جای ارسال پیامک، کد را در پاسخ برمی‌گردانیم (فقط برای تست محلی)
                    return response()->json([
                        'status' => 'ok',
                        'message' => 'کد تأیید تولید شد',
                        'code' => $code  // فقط برای تست. در حالت واقعی نباید فرستاده شود.
                    ]);
                }



                // public function checkCode(Request $request)
                // {
                //     $mobile = $request->mobilelogin;
                //     $code = $request->code;

                //     if (!str_starts_with($mobile, '+')) {
                //         $mobile = '+93' . ltrim($mobile, '0');
                //     }

                //     $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

                //     try {
                //         $verification = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'))
                //             ->verificationChecks
                //             ->create([
                //                 'to' => $mobile,
                //                 'code' => $code
                //             ]);

                //         if ($verification->status === 'approved') {
                //             $user = User::firstOrCreate(
                //                         ['mobile' => $mobile],
                //                         ['code' => $code] // مقدار خالی یا هر مقدار پیش‌فرض دیگر
                //                     );
                //             Auth::login($user);

                //             return response()->json([
                //                 'status' => 'ok',
                //                 'message' => 'کد تایید شد و کاربر وارد شد',
                //             ]);
                //         } else {
                //             return response()->json([
                //                 'status' => 'error',
                //                 'message' => 'کد اشتباه است',
                //             ], 422);
                //         }

                //     } catch (\Exception $e) {
                //         return response()->json([
                //             'status' => 'error',
                //             'message' => 'خطا در بررسی کد',
                //             'error' => $e->getMessage()
                //         ], 500);
                //     }
                // }


                public function checkCode(Request $request)
                {
                    $mobile = $request->mobilelogin;
                    $code = $request->code;

                    if (!str_starts_with($mobile, '+')) {
                        $mobile = '+93' . ltrim($mobile, '0');
                    }

                    $user = User::where('mobile', $mobile)->first();

                    if (!$user) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'کاربری با این شماره یافت نشد'
                        ], 404);
                    }

                    if ($user->code == $code) {
                        Auth::login($user);
                          Session(['verified_mobile' => '795534975']);
                          return response()->json([
                            'status' => 'success',
                            'redirect' => url('/myapp')
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'کد اشتباه است'
                        ], 422);
                    }
                }

      
                public function myapp(){

                   $mobile = session('verified_mobile');
     
                   return view('user.myapp', compact('mobile'));

                }


                /**********chate login*******/
                public function addmobile_chat(Request $request)
                {
                    $mobile = $request->mobilelogin;
                    $code = rand(100000, 999999); 

                    
                    if (!str_starts_with($mobile, '+')) {
                        $mobile = '+93' . ltrim($mobile, '0');
                    }

                  
                    $user = User::where('mobile', $mobile)->first();

                    if (!$user) {
                        $user = User::create([
                            'mobile' => $mobile,
                            'code' => $code
                        ]);
                    } else {
                        $user->code = $code;
                        $user->save();
                    }

                    // به جای ارسال پیامک، کد را در پاسخ برمی‌گردانیم (فقط برای تست محلی)
                    return response()->json([
                        'status' => 'ok',
                        'message' => 'کد تأیید تولید شد',
                        'code' => $code  // فقط برای تست. در حالت واقعی نباید فرستاده شود.
                    ]);
                }


                public function checkCode_chat(Request $request)
                {
                    $mobile = $request->mobilelogin;
                    $code = $request->code;

                    if (!str_starts_with($mobile, '+')) {
                        $mobile = '+93' . ltrim($mobile, '0');
                    }

                    $user = User::where('mobile', $mobile)->first();

                    if (!$user) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'کاربری با این شماره یافت نشد'
                        ], 404);
                    }

                    if ($user->code == $code) {
                        Auth::login($user);
                          Session(['verified_mobile' => '795534975']);
                          return response()->json([
                            'status' => 'success',
                            'redirect' => url('/chat')
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'کد اشتباه است'
                        ], 422);
                    }
                }




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Advert;
use App\Models\Image;
use App\Models\Car;
use Hekmatinasser\Verta\Facades\Verta;
 
use Illuminate\Support\Facades\Redirect;

class AdvertControllers extends Controller
{
       public function addstate(Request $request)
            {
                try {
                    
                    $advert = new Advert();
                    $advert->city = $request->city;
                    $advert->email = $request->email; 
                    $advert->mobile = $request->phone; 
                    $advert->chat = $request->chatEnabled;
                    $advert->noemail = $request->emailVisible;
                    $advert->subject = $request->title;
                    $advert->text = $request->description;
                    $advert->type = $request->adType;
                    $advert->category_id = $request->catagory;

                    $advert->date = verta();

                    if (!$advert->save()) {
                        return response()->json(['message' => 'خطا در ذخیره آگهی'], 500);
                    }
            
                    $estate = new Estate();
                    $estate->area = $request->area;
                    $estate->deposite = $request->fee;
                    $estate->rent = $request->rent;
                    $estate->number = $request->numberRoom;
                    $estate->typeAdvert = $request->advertiser;
                    $estate->advert_id = $advert->id;

                    if (!$estate->save()) {
                        return response()->json(['message' => 'خطا در ذخیره ملک'], 500);
                    }

                    
                    if (!$request->has('images')) {
                        return response()->json(['message' => 'تصاویری دریافت نشد'], 400);
                    }

                    $imageString = implode(',', $request->images);

                    $is = new Image();
                    $is->image = $imageString;
                    $is->advert_id = $advert->id;

                    if (!$is->save()) {
                        return response()->json(['message' => 'خطا در ذخیره تصاویر'], 500);
                    }


                            return response()->json([
                                'message' => 'آگهی با موفقیت ذخیره شد',
                                'redirect_url' => route('manage', [
                                    'category_id' => $request->catagory,
                                    'id' => $advert->id
                                ])
                            ]);

                    // return response()->json([
                    //     'message' => 'آگهی، ملک و تصویر با موفقیت ذخیره شدند',
                    //     'data' => [
                    //         'advert' => $advert,
                    //         'estate' => $estate,
                    //         'images' => $imageString
                    //     ]
                    // ], 200);


                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'خطای غیرمنتظره: ' . $e->getMessage()
                    ], 500);
                }
            }


       public function addimage(Request $request)
                            {
                               
                                if ($request->hasFile('file')) {
                                    $file = $request->file('file');

                                
                                    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();

                                    $file->move(public_path('uploads'), $imageName);


                                    return response()->json($imageName);
                                } else {
                                    return response()->json([
                                        'message' => 'هیچ فایلی ارسال نشده است'
                                    ], 400);
                                }
                            }

      public function addcares(Request $request)
                        {
                            try {
                                // 1. ذخیره آگهی
                                $advert = new Advert();
                                $advert->city = $request->city;
                                $advert->email = $request->email;
                                $advert->mobile = $request->mobile;
                                $advert->chat = $request->chat;
                                $advert->noemail = $request->noemail ? 1 : 0;
                                $advert->subject = $request->subject;
                                $advert->text = $request->text;
                                $advert->type = $request->adType;
                                $advert->category_id = $request->category_id;
                                $advert->date = verta();

                                if (!$advert->save()) {
                                    return response()->json(['message' => 'خطا در ذخیره آگهی'], 500);
                                }

                                // 2. ذخیره خودرو
                                $car = new Car();
                                $car->brand = $request->brand;
                                $car->year = $request->year;
                                $car->type = $request->adType;
                                $car->run_time = $request->run_time;
                                $car->price = $request->price;
                                $car->advert_id = $advert->id;

                                if (!$car->save()) {
                                    // اگر ذخیره ماشین شکست خورد، آگهی هم پاک شود
                                    $advert->delete();
                                    return response()->json(['message' => 'خطا در ذخیره اطلاعات خودرو'], 500);
                                }

                                // 3. ذخیره تصاویر
                                if (!$request->has('images')) {
                                    $car->delete();
                                    $advert->delete();
                                    return response()->json(['message' => 'تصاویری دریافت نشد'], 400);
                                }

                                $imageString = implode(',', $request->images);

                                $image = new Image();
                                $image->image = $imageString;
                                $image->advert_id = $advert->id;

                                if (!$image->save()) {
                                    // اگر ذخیره تصویر شکست خورد، همه را پاک کن
                                    $car->delete();
                                    $advert->delete();
                                    return response()->json(['message' => 'خطا در ذخیره تصاویر'], 500);
                                }

                                // 4. پاسخ موفق

                                        return response()->json([
                                                'message' => 'آگهی با موفقیت ذخیره شد',
                                                'redirect_url' => route('manage', [
                                                    'category_id' => $request->category_id,
                                                    'id' => $advert->id
                                                ])
                                           ]);

                                        // return response()->json([
                                        //     'message' => 'آگهی، خودرو و تصاویر با موفقیت ذخیره شدند',
                                        //     'data' => [
                                        //         'advert' => $advert,
                                        //         'car' => $car,
                                        //         'images' => $imageString
                                        //     ]
                                        // ], 200);

                            } catch (\Exception $e) {
                                return response()->json([
                                    'message' => 'خطای غیرمنتظره: ' . $e->getMessage()
                                ], 500);
                            }
                        }

       public function addpublic(Request $request)
                        {
                            try {
                                // ذخیره آگهی
                                $advert = new Advert();
                                $advert->city = $request->city;
                                $advert->email = $request->email;
                                $advert->mobile = $request->mobile;
                                $advert->chat = $request->chat;
                                $advert->maker = $request->maker;
                                $advert->price = $request->price;
                                $advert->noemail = $request->noemail ? 1 : 0;
                                $advert->subject = $request->subject;
                                $advert->text = $request->text;
                                $advert->type = $request->adType;
                                $advert->category_id = $request->category_id;
                                $advert->date = verta();

                                if (!$advert->save()) {
                                    return response()->json(['message' => 'خطا در ذخیره آگهی'], 500);
                                }

                                
                                if (!$request->has('images')) {
                                    $advert->delete(); 
                                    return response()->json(['message' => 'تصاویری دریافت نشد'], 400);
                                }

                                $imageString = implode(',', $request->images);

                                $image = new Image();
                                $image->image = $imageString;
                                $image->advert_id = $advert->id;

                                if (!$image->save()) {
                                    $advert->delete(); 
                                    return response()->json(['message' => 'خطا در ذخیره تصاویر'], 500);
                                }


                                return response()->json([
                                        'message' => 'آگهی با موفقیت ذخیره شد',
                                        'redirect_url' => route('manage', [
                                            'category_id' => $request->category_id,
                                            'id' => $advert->id
                                        ])
                                    ]);


                                // return response()->json([
                                //     'message' => 'آگهی و تصاویر با موفقیت ذخیره شدند',
                                //     'data' => [
                                //         'advert' => $advert,
                                //         'images' => $imageString
                                //     ]
                                // ], 200);

                            } catch (\Exception $e) {
                                return response()->json([
                                    'message' => 'خطای غیرمنتظره: ' . $e->getMessage()
                                ], 500);
                            }
                        }
 

           public function statuscode(Request $request){
                $code = trim($request->code);
                $advert = Advert::where('code', $code)->where('status', '!=', 1)->latest('id')->first();

                if ($advert) {
                    $advert->status = 1;
                    $advert->save();
                    return "yes";
                } else {
                    return "no";
                }
            }



 }

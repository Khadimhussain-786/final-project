<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use Hekmatinasser\Verta\Verta;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ShowController extends Controller
{
            public function index($city){

                            $adverts = DB::table('adverts')
                                    ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
                                    ->leftJoin('estates', 'adverts.id', '=', 'estates.advert_id')
                                    ->leftJoin('cars', 'adverts.id', '=', 'cars.advert_id')
                                    ->select(
                                        'adverts.*',
                                        'images.image',
                                        'estates.deposite as estate_deposit',
                                        'estates.rent as estate_rent',
                                        'cars.price as car_price'
                                    )->get();
                
                    return view('show',['advert' =>$adverts, 'city' => $city]);
            }

            public function showadvert(){
                $adverts = DB::table('adverts')->where('check',1)
                    ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
                    ->leftJoin('estates', 'adverts.id', '=', 'estates.advert_id')
                    ->leftJoin('categories', 'adverts.category_id', '=', 'categories.id')
                    ->leftJoin('cars', 'adverts.id', '=', 'cars.advert_id')
                    ->select(
                        'adverts.*',
                        'images.image',
                        'estates.deposite as estate_deposit',
                        'estates.rent as estate_rent',
                        'cars.price as car_price'
                    )
                    ->paginate(6);

            
                    foreach ($adverts as $advert) {
                        if ($advert->date) {
                            try {
                                [$year, $month, $day, $hour, $minute, $second] = sscanf($advert->date, "%d-%d-%d %d:%d:%d");
                                $v = Verta::createJalali($year, $month, $day, $hour, $minute, $second);
                                $advert->date_diff = $v->formatDifference();
                            } catch (\Exception $e) {
                                $advert->date_diff = '';
                            }
                        } else {
                            $advert->date_diff = '';
                        }
                    }

                return response()->json($adverts);

            }
            
                // public function show(Request $request)
                // {
                //     $adverts = DB::table('adverts')
                //         ->where('adverts.id', $request->id)
                //         ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
                //         ->leftJoin('estates', 'adverts.id', '=', 'estates.advert_id') 
                //         ->leftJoin('categories', 'adverts.category_id', '=', 'categories.id')
                //         ->leftJoin('cars', 'adverts.id', '=', 'cars.advert_id')
                //         ->select(
                //             'adverts.*',
                //             'estates.*',
                //             'images.image as image',
                //             'categories.name',
                //             'cars.price as car_price',
                //             'cars.type as car_type',
                //             'cars.brand',
                //             'cars.run_time',
                //             'cars.year'
                //         )
                //         ->first();

                //     if ($adverts) {
                        
                //         $adverts->images = isset($adverts->image) ? explode(',', $adverts->image) : [];

                //         try {
                //             $v = Verta::parse($adverts->date);
                //             $adverts->relative_time = $v->formatDifference(); // مثلاً: ۳ روز پیش
                //         } catch (\Exception $e) {
                //             $adverts->relative_time = null;
                //         }
                //     }

                //     return response()->json($adverts);
                // }

                public function show(Request $request)
                {
                    $adverts = DB::table('adverts')
                        ->where('adverts.id', $request->id)
                        ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
                        ->leftJoin('users', 'adverts.mobile', '=', 'users.mobile')
                        ->leftJoin('estates', 'adverts.id', '=', 'estates.advert_id') 
                        ->leftJoin('categories', 'adverts.category_id', '=', 'categories.id')
                        ->leftJoin('cars', 'adverts.id', '=', 'cars.advert_id')
                        ->select(
                            'users.*',
                            'adverts.id as Id',
                            'adverts.city',
                            'adverts.price',
                            'adverts.email',
                            'adverts.mobile',
                            'adverts.chat',
                            'adverts.noemail',
                            'adverts.subject',
                            'adverts.text',
                            'adverts.type',
                            'adverts.maker',
                            'adverts.date',
                            'adverts.code',
                            'adverts.status',
                            'adverts.check',
                            'adverts.category_id',
                            'adverts.user_id',
                            'estates.*',
                            'images.image as image',
                            'categories.name',
                            'cars.price as car_price',
                            'cars.type as car_type',
                            'cars.brand',
                            'cars.run_time',
                            'cars.year'
                        )
                        ->first();

                    if ($adverts) {
                        
                        $adverts->images = isset($adverts->image) ? explode(',', $adverts->image) : [];

                        try {
                            $v = Verta::parse($adverts->date);
                            $adverts->relative_time = $v->formatDifference(); // مثلاً: ۳ روز پیش
                        } catch (\Exception $e) {
                            $adverts->relative_time = null;
                        }
                    }

                    return response()->json($adverts);
                }





  
}

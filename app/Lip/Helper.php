<?php 
namespace App\Lip;
use App\Models\Estate;
use App\Models\Car;
use App\Models\Image;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class Helper{
    public static function Estate($id){

      $Estate = Estate::where('advert_id',$id)->first();

            if($Estate){

                if($Estate->typeAdvert ==1){
                    $type = "فروشی";
                }elseif($Estate->typeAdvert == 2){
                        $type = "اجاره";
                }else{
                    $type = "درخواستی";
                }

                echo "<li class= 'left'>مبلغ گروی : $Estate->deposite افغانی </li>";

                if($type == "اجاره" || $type == "درخواستی"){
                        echo "<li class= 'right'>مبلغ اجاره : $Estate->rent افغانی </li>";
                        echo "<li class= 'left'> نوع : $type </li>";
                }
                echo "<li class= 'right'> تعداد اوتاق : $Estate->number </li>";

                }
            }


                    public static function Car($id){

                    $car = Car::where('advert_id',$id)->first();

                    if($car){
                            
                        if($car->type == 0){

                        $type = "فروشی";

                        }elseif($car->type == 1){
                        $type = "اجاره";
                        }else{
                        $type = "درخواستی";
                        }


                            echo "<li class= 'left'> برند : $car->brand </li>";
                            echo "<li class= 'right'> سال ساخت : $car->year </li>";
                            echo "<li class= 'left'> نوع : $type </li>";
                            echo "<li class= 'right'>  قیمت : $car->price </li>";
                            echo "<li class= 'left'>  کارکرد : $car->run_time کیلومتر </li>";

                    }

                    }

               public static function Images($id) {
                   $img = Image::where('advert_id', $id)->first();

                  if (!$img || !$img->image) return;

                  $images = explode(',', $img->image);

                  foreach ($images as $key => $image) {
                      $active = $key === 0 ? 'active' : '';
                      echo "<div class='carousel-item $active'>
                                <img src='/uploads/$image' class='d-block w-100' style='width: 100%; object-fit: cover;' alt='عکس'>
                            </div>";
                  }
                }


           
            // public static function modalcar($id){
            //     $car = Car::where('advert_id', $id)->first();

            //     if($car){
            //         $type = match($car->type){
            //             0 => 'فروشی',
            //             1 => 'اجاره',
            //             default => 'درخواستی',
            //         };

            //         echo "
            //         <table class='table table-bordered table-striped table-hover' style='text-align: center;'>
            //             <thead>
            //                 <tr>
            //                     <th class='text-center'>برند</th>
            //                     <th class='text-center'>سال ساخت</th>
            //                     <th class='text-center'>کارکرده (کیلومتر)</th>
            //                     <th class='text-center'>نوع تبلیغات</th>
            //                     <th class='text-center'>قیمت</th>
            //                 </tr>
            //             </thead>
            //             <tbody>
            //                 <tr>
            //                     <td>{$car->brand}</td>
            //                     <td>{$car->year}</td>
            //                     <td>{$car->run_time}</td>
            //                     <td>{$type}</td>
            //                     <td>{$car->price}</td>
            //                 </tr>
            //             </tbody>
            //         </table>";
            //     }
            // }



            //   public static function modalestate($id){
            //     echo
                
            //   '  
                
            //        <table class="table table-bordered table-striped table-hover" style="text-align: center;">
            //                 <thead>
            //                     <tr>
            //                         <th class="text-center">شماره تبلیغات</th>
            //                         <th class="text-center">موضع تبلیغات</th>
            //                         <th class="text-center">ایمیل</th>
            //                         <th class="text-center">شماره موبایل</th>
            //                         <th class="text-center">شهر</th>
            //                         <th class="text-center">نوع تبلیغات</th>
            //                         <th class="text-center">وضعیت</th>
            //                         <th class="text-center">حذف</th>
            //                     </tr>
            //                 </thead>
            //                 <tbody>
            //                     @foreach ($adverts as $advert)
            //                     <tr style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Modal{{$advert->id}}">
            //                         <td>{{$advert->id}}</td>
            //                         <td>{{$advert->subject}}</td>
            //                         <td>{{$advert->email}}</td>
            //                         <td>{{$advert->mobile}}</td>
            //                         <td>{{$advert->city}}</td>
            //                         <td>
                                        
            //                         @if ($advert->type==1)
            //                              <span style="color: #1c7430;">فرشی</span>
            //                              @else
            //                              <span style="color:darkred ;">درخواستی</span>
            //                         @endif
                                
            //                         </td>
            //                         <td>
                                        
            //                          @if ($advert->status==1)
            //                              <i class="fa fa-check" style="color: #1c7430;"></i>
            //                              @else
            //                              <i class="fa fa-remove" style="color:red;"></i>
            //                         @endif

            //                         </td>
            //                         <td  >
            //                         <form action="/removeadvert" method="post">
            //                             @csrf
            //                             <input type="hidden" value="{{$advert->id}}" name="advert_id">
            //                           <button type="submit"> <i class="fa fa-trash" style="color: darkred;"></i> </button>  
            //                         </form>
                                        
            //                         </td>
            //                     </tr>
            //                     @endforeach
            //                 </tbody>
            //             </table>

                
              
            //   ';
            //   }

            public static function modalContent($advert)
                        {
                            $car = Car::where('advert_id', $advert->id)->first();
                            $estate = Estate::where('advert_id', $advert->id)->first();

                            $output = "";

                            if ($car) {
                                $type = match($car->type){
                                    0 => 'فروشی',
                                    1 => 'اجاره',
                                    default => 'درخواستی',
                                };
                                $output .= "
                                <table class='table table-bordered table-striped table-hover' style='text-align: center;'>
                                    <thead>
                                        <tr>
                                            <th>برند</th>
                                            <th>سال ساخت</th>
                                            <th>کارکرد</th>
                                            <th>نوع تبلیغات</th>
                                            <th>قیمت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{$car->brand}</td>
                                            <td>{$car->year}</td>
                                            <td>{$car->run_time} کیلومتر</td>
                                            <td>{$type}</td>
                                            <td>{$car->price}</td>
                                        </tr>
                                    </tbody>
                                </table>";
                            } elseif ($estate) {
                                $type = match($estate->typeAdvert){
                                    1 => 'فروشی',
                                    2 => 'اجاره',
                                    default => 'درخواستی',
                                };
                                $output .= "
                                <table class='table table-bordered table-striped table-hover' style='text-align: center;'>
                                    <thead>
                                        <tr>
                                            <th>تعداد اتاق</th>
                                            <th>گروی</th>
                                            <th>اجاره</th>
                                            <th>نوع تبلیغات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{$estate->number}</td>
                                            <td>{$estate->deposite} افغانی</td>
                                            <td>" . ($estate->rent ?? '-') . "</td>
                                            <td>{$type}</td>
                                        </tr>
                                    </tbody>
                                </table>";
                            } else {
                                $type = $advert->type == 1 ? 'فرشی' : 'درخواستی';
                                $output .= "
                                <table class='table table-bordered table-striped table-hover' style='text-align: center;'>
                                    <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>موضوع</th>
                                            <th>ایمیل</th>
                                            <th>شماره موبایل</th>
                                            <th>شهر</th>
                                            <th>نوع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{$advert->id}</td>
                                            <td>{$advert->subject}</td>
                                            <td>{$advert->email}</td>
                                            <td>{$advert->mobile}</td>
                                            <td>{$advert->city}</td>
                                            <td>{$type}</td>
                                        </tr>
                                    </tbody>
                                </table>";
                            }

                            return $output;
                        }


                     
                    public static function myadvert($mobile)
                    {
                        $adverts = DB::table('adverts')
                            ->where('adverts.mobile', $mobile)
                            ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
                            ->leftJoin('estates', 'adverts.id', '=', 'estates.advert_id') 
                            ->leftJoin('categories', 'adverts.category_id', '=', 'categories.id')
                            ->leftJoin('cars', 'adverts.id', '=', 'cars.advert_id')
                            ->select(
                                'adverts.*',
                                'estates.deposite as estate_deposit',
                                'estates.rent as estate_rent',
                                'estates.number as estate_number',
                                'images.image as image',
                                'categories.name',
                                'categories.id as category_id', // برای لینک مدیریت
                                'cars.price as car_price',
                                'cars.type as car_type',
                                'cars.brand',
                                'cars.run_time',
                                'cars.year'
                            )
                            ->get();

                        if ($adverts->isEmpty()) {
                            echo "<p>هیچ آگهی‌ای یافت نشد.</p>";
                            return;
                        }

                        echo '<ul class="advert_myapp">';

                        foreach ($adverts as $advert) {
                            try {
                                $v = Verta::parse($advert->date);
                                $date_diff = $v->formatDifference();
                            } catch (\Exception $e) {
                                $date_diff = '';
                            }

                            $image = '/uploads/no-image.jpg';
                            if (!empty($advert->image)) {
                                $images = explode(',', $advert->image);
                                if (!empty($images[0])) {
                                    $image = '/uploads/' . $images[0];
                                }
                            }

                            if ($advert->check == 1) {
                                $status_text = 'پخش شده';
                                $status_class = 'status-green';
                            } else {
                                $status_text = 'در حال بررسی...';
                                $status_class = 'status-orange';
                            }

                            $manage_url = "/manage/{$advert->category_id}/{$advert->id}";

                            echo "
                            <li style='position: relative;'>
                                <div class='subject_myapp'>{$advert->subject}</div>
                                <div class='advert_image'>
                                    <img src='{$image}' alt=''>
                                </div>
                                <div class='date_myapp'>{$date_diff}</div>
                                <div class='satate_myapp'><span>وضعیت: </span><span class='{$status_class}'>{$status_text}</span></div>
                                <a href='{$manage_url}' class='manage_myapp'>مدیریت تبلیغات</a>
                            </li>
                            ";
                        }

                        echo '</ul>';
                    }


           



    }


    


?>
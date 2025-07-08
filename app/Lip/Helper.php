<?php 
namespace App\Lip;
use App\Models\Estate;
use App\Models\Car;
use App\Models\Image;

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




    }


    


?>
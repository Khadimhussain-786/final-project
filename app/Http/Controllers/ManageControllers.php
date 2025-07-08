<?php

namespace App\Http\Controllers;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Image;
use App\Http\Requests\Editrequest;

use Illuminate\Http\Request;

class ManageControllers extends Controller
{
    public function manage($category_id, $id)
    {
        $advert = Advert::find($id);
        $category = Category::find($category_id);
        return view('manage', [
            'advert' => $advert,
            'id' => $id,
            'category' => $category,
            'category_id' => $category_id
        ]);
    }

    public function edit($category_id, $id)
    {
        $advert = Advert::find($id);
        $category = Category::find($category_id);
        $estate = Estate::where('advert_id', $id)->first();

        return view('edit', [
            'advert' => $advert,
            'id' => $id,
            'category' => $category,
            'category_id' => $category_id,
            'estate' => $estate
        ]);
    }
public function editadvert(Editrequest $request)
                {
                    $noemail = $request->noemail ?? 0;
                    $chat = $request->chatEnabled ?? 0;

                    // آپدیت جدول adverts
                    Advert::where('id', $request->advert_id)->update([
                        'city'    => $request->city,
                        'mobile'  => $request->mobile,
                        'email'   => $request->email,
                        'type'    => $request->adType,
                        'subject' => $request->subject,
                        'text'    => $request->text,
                        'noemail' => $noemail,
                        'chat'    => $chat,
                    ]);

                    // فقط آپدیت estate اگر وجود داشته باشد
                       
                    if($request->area){
                       Estate::where('advert_id', $request->advert_id)->update([
                            'area'          => $request->area,
                            'deposite'      => $request->deposite,
                            'rent'          => $request->rent,
                            'typeAdvert'    => $request->adType,
                            'number'        => $request->numberRoom,
                        ]);
                    }

                   


                    // آپدیت تصاویر اگر ارسال شده باشد
                    if ($request->has('image')) {
                        $images = $request->input('image');
                        if (!is_array($images)) {
                            $images = explode(',', $images);
                        }
                        $imageString = implode(',', $images);

                        Image::where('advert_id', $request->advert_id)->update([
                            'image' => $imageString
                        ]);
                    }

                    $category = Advert::find($request->advert_id)->category_id;
                    return redirect("/manage/$category/{$request->advert_id}");
                }


    public function editimage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imageName);

            return response()->json(['filename' => $imageName]);
        } else {
            return response()->json([
                'message' => 'هیچ فایلی ارسال نشده است'
            ], 400);
        }
    }


    public function deleteadvert(Request $request){
        $id = $request->advert_id;

        $advert = Advert::find($id)->delete();

        return redirect('/advert');
    }
}

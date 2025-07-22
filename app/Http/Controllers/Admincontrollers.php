<?php

namespace App\Http\Controllers;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Container\Attributes\Auth;

class Admincontrollers extends Controller
{
            public function index(){
                return view('admin.index');
            }

            public function manageadvert(){
                $advert = Advert::orderby('id','desc')->paginate(10);

                return view('admin.manageadvert.index',['adverts'=>$advert]);
            }

            public function removeadvert(Request $request){
                $id = $request->advert_id;

                $advert = Advert::find($id);

                $advert->delete();
                
                if ($advert) {
                    return redirect('/manageadvert')->with('success', 'آگهی حذف شد');
                }
            }

            public function chechadvert(Request $request)
            {
                $advert = Advert::find($request->advert_id); // اصلاح شد

                if ($advert && $advert->check == 1) {
                    $ad = Advert::where('id', $request->advert_id)->update([
                        'check' => 0,
                    ]);
                } elseif ($advert) {
                    $ad = Advert::where('id', $request->advert_id)->update([
                        'check' => 1,
                    ]);
                }

                if (isset($ad)) {
                    return redirect('manageadvert');
                }

                return redirect()->back()->with('error', 'آگهی مورد نظر یافت نشد.');
            }


            public function user(){
                return view('user.adduser');
            }

            public function adduser(Request $request){

                $user = new User();
                $user->name = $request->name;
                $user->mobile = $request->mobile;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->role = $request->role;
                $user->status = 1;

                if($user->save()){
                    return $user;
                };
            }

            public function showuser(){
              $user = User::orderby('u_id','desc')->paginate(10);
                return view('user.showuser',['users'=>$user]);
            }

            public function checkuser(Request $request){

                $user = User::find($request->user_id); // اصلاح شد

                if ($user && $user->status == 1) {
                    $ad = User::where('u_id', $request->user_id)->update([
                        'status' => 0,
                    ]);
                } elseif ($user) {
                    $ad = User::where('u_id', $request->user_id)->update([
                        'status' => 1,
                    ]);
                }

                if (isset($ad)) {
                    return redirect('/admin/showuser');
                }

                return redirect()->back()->with('error', 'آگهی مورد نظر یافت نشد.');
            }


            public function changerole(Request $request){
 
                 $user = User::find($request->id);

                 $ad = User::where('u_id', $request->id)->update([
                        'role' => $request->role,
                    ]);

                    if($ad){
                        return redirect('/admin/showuser');
                    }
            }
}

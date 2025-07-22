<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Events\MessagePosted;
use App\Models\Chat;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function chat()
    {
        // $adverts = DB::table('adverts')
        //     ->where('adverts.id', $id)
        //     ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
        //     ->leftJoin('chats', 'adverts.id', '=', 'chats.advert_id')
        //     ->select(
        //         'adverts.*',
        //         'chats.*',
        //         'images.image'
        //     )
        //     ->get(); // چند ردیف

        // // روی هر آگهی عملیات انجام بده (گرفتن عکس اول یا عکس پیش‌فرض)
        // foreach ($adverts as $advert) {
        //     if (!empty($advert->image)) {
        //         $images = explode(',', $advert->image);
        //         $advert->image = $images[0];
        //     } else {
        //         $advert->image = 'no-image.jpg';
        //     }
        // }

        // return view('chat', ['id' => $id, 'adverts' => $adverts]);

        return view('chat');

    }

    public function showusers(Request $request){


        $adverts = DB::table('adverts')
            ->leftJoin('images', 'adverts.id', '=', 'images.advert_id')
            ->leftJoin('chats', 'adverts.id', '=', 'chats.advert_id')
            ->get();

            return $adverts;

    }

        public function sendmessage(Request $request,User $user){
            $chat_text = $request->chat_text;
            $advert_id = $request->advert_id;  
            $user_id = $request->sender_id;


            $message =Chat::create([

                'chat_text'=>$chat_text,
                'advert_id'=>$advert_id,
                'user_id'=>$user_id,
                'receiver_id'=>$user->u_id

            ]);

            if($message){

                if (session::has('chat')) {

                    $chat = session::get('chat');

                    if (array_key_exists($message->advert_id, $chat)) {

                        $chat[$message->advert_id]++;

                    } else {

                        $chat[$message->advert_id]=1 ;

                    }

                    session::put('chat', $chat);

                }else{

                    $chat=array();

                    $chat[$message->advert_id]=1 ;

                    session::put('chat', $chat);
                }

                return redirect('chat');
            }
        }


    public function privateMessages(User $user){

        // return $user->id;

        $privateCommunication = Chat::with('user')
              ->where(['user_id'=>auth()->user()->u_id,'receiver_id'=>$user->u_id])
              ->orWhere(function($query) use($user){
                $query->where(['user_id'=>$user->u_id,'receiver_id'=>auth()->user()->u_id]);
              })->get();
              return $privateCommunication;
    }
   public function sendPrivateMessages(Request $request, User $user)
        {
            if(request()->has(key:'file')){
                $filename = request(key:'file')->store('chat');
                $message=Chat::create([
                    'user_id' => request()->user()->u_id,
                    'receiver_id' => $user->u_id
                ]);
            }else{
                $input=$request->all();
                $input['receiver_id']=$user->u_id; 

                  $message = new Chat();

                  $message->user_id = $request->sender_id;
                  $message->receiver_id = $user->u_id;
                  $message->chat_text = $request->chat_text;
                  $message->advert_id = $request->advert_id; 

               // $message=auth()->user()->messages()->create($input);
            }

            if($message->save()){

              //   broadcast(new MessageSent($message->load('user')))->toOthers();

              event(new MessageSent($message->load('user')));
      
                 return response(['status'=>'Message private sent successfully','message'=>$message]);
         
                }

        }

}

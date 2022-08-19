<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Carbon\Carbon;
use Storage;
use DB;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages($store_id)
    {
        $messages=Message::where([['from',auth()->user()->id],['to',$store_id],['source','user']])
                                                  ->orWhere([['from',$store_id],['to',auth()->user()->id],['source','store']])->get();


        //Mark All As Read
        foreach ($messages as $message) {
          if(!$message->read_at && $message->source!='user'){
            $message->update([
              'read_at'=>Carbon::now()
            ]);
          }
        }
        return view('site.pages.chat',compact('messages','store_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendmessage($store_id,Request $request)
    {

      if(!$request->Message){
        session()->flash('error','من فضلك ادخل نص الرسالة');
        return back();
      }

      $message=Message::create([
        'from'=>auth()->user()->id,
        'to'=>$store_id,
        'body'=>$request->Message,
        'source'=>'user'
      ]);

      if($request->fileUpload){
          $file = $request->fileUpload;
          $filename = "file".time()."_".$file->getClientOriginalName();
          $ext= $file->getClientOriginalExtension();
          $path = public_path('storage/messages/');
          $file->move($path, $filename);

          $message->update([
            'file'=>$filename,
            'type'=>$ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif'?'image':'file'
          ]);
      }

      session()->flash('success','تم ارسالة الرسالة');
      return back();
    }

    public function inbox(){
      $messages=Message::where([['to',auth()->user()->id],['source','store']])->select('from','to','source','body','file','type','created_at',DB::raw('count(*) as total'))->groupBy('from')->get();
      return view('site.pages.inbox',compact('messages'));
    }
}

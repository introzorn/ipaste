<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paste;

class pasteController extends Controller
{
    //


    public function submitPaste(Request $r){
      //  dd($r->request);
   $val =$r->validate(['pname'=>'required|min:5|max:255',
                        'pcode'=>'required|min:5',
                        'pcodetype'=>'required|min:2',
                        'pview'=>'required',
                        'expiration'=>'required']);



        $d=strtotime("+".$val['expiration']);




        $pasta= new paste();
        $pasta->name=$val['pname'];
        $pasta->alias='';
        $pasta->user='';
        $pasta->code=$val['pcode'];
        $pasta->codetype=$val['pcodetype'];
        $pasta->view=$val['pview'];
        $pasta->utime=strtotime("+0");

        if ( $val['expiration']=='0' )
        {
            $pasta->expiration=0;
        }else{
            $pasta->expiration=$d;
        }


        $pasta->save();

        $pasta->alias = $this->GetHash($pasta->id);

        $pasta->save();
        return redirect()->route('alias', ['alias' => $pasta->alias]);
    }


    public function viewPasta(string $id){
        if($id==''){return view('p404');} //на всякий случай проверяем если id пустой

        $pasta = new paste;
        $pdata=$pasta->where('alias',$id)->first();
        if(!$pdata) {return view('p404');}   //заглушка если элемент не найден
        $datastring='Всегда';
        if($pdata->expiration>0){$datastring='до '.date("H:i:s m.d.Y");}
        $userstring='';
        if($pdata->user!=''){ $userstring='Пользователь:'.$pdata->user.'<br>';}

        return view('pasta',['pdata'=>$pdata,'extime'=> $datastring,'userstring'=>$userstring]);
    }


 public static function getLastPaste(){
    $udat=strtotime("+0");
    $pasta = paste::where('view',0)->where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->take(10)->get();
    return $pasta;
 }

public function MainCont(){
    $udat=strtotime("+0");
    $allpasta = paste::where('view',0)->where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->paginate(10);
    $allpasta->setPath('');
    return view('main', ['allpasta'=>$allpasta]);
}





    private function GetHash(int $id){

    $kol=1+ceil(log10($id)); //длинна хэша по id


     for($u=0;$u<10;$u++){ //навсякий случай добавляем рандомности

            $hash=bin2hex(random_bytes($kol));

            if (!paste::where('alias', '=', $hash)->exists()) {
                return $hash;
             }

      }


   }
}

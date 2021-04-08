<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paste;
use Illuminate\Support\Facades\Auth;

class pasteController extends Controller
{
    //
    public static $ViewTEXT=['Публичная','Скрытая','Приватная'];
    public static $AutoTEXT=[];

    public static function AText($key){
        $val=session()->get($key);
        if($val==''){
            if($key=='pcodetype'){$val='plain';}
            if($key=='pview'){$val=0;}
            if($key=='expiration'){$val=0;}
        }

        return $val;

    }

    public function submitPaste(Request $r)
    {
        //  dd($r->request);

//немного автозаполнения
        $r->session()->put('pname', $r->pname);
        $r->session()->put('pcode', $r->pcode);
        $r->session()->put('pcodetype', $r->pcodetype);
        $r->session()->put('pview', $r->pview);
        $r->session()->put('expiration', $r->expiration);



        $val = $r->validate([
            'pname' => 'required|min:5|max:255',
            'pcode' => 'required|min:5|max:16777215',
            'pcodetype' => 'required|min:2',
            'pview' => 'required',
            'expiration' => 'required'
        ]);



        $d = strtotime("+" . $val['expiration']);




        $pasta = new paste();
        $pasta->name = $val['pname'];
        $pasta->alias = '';
        $pasta->user = '';
        $pasta->code = $val['pcode'];
        $pasta->codetype = $val['pcodetype'];
        $pasta->view = $val['pview'];
        $pasta->utime = strtotime("+0");

        if (Auth::Check()) {
            $pasta->user = Auth::User()->user;
        }


        if ($val['expiration'] == '0') {
            $pasta->expiration = 0;
        } else {
            $pasta->expiration = $d;
        }


        $pasta->save();

        $pasta->alias = $this->GetHash($pasta->id);

        $pasta->save();

        $this->ClearPast(); //удаляем просроченные пасты из бд . тут чтобы реже нагружать бд



        $r->session()->put('pname', '');
        $r->session()->put('pcode', '');
        $r->session()->put('pcodetype', '');
        $r->session()->put('pview', '');
        $r->session()->put('expiration', '');


        return redirect()->route('alias', ['alias' => $pasta->alias]);
    }


    public function viewPasta(string $id)
    {
        if ($id == '') {
            return view('p404');
        } //на всякий случай проверяем если id пустой

        $pasta = new paste;
        $pdata = $pasta->Where('alias', $id)->first();
        if (!$pdata) {
            return view('p404');
        }   //заглушка если элемент не найден

        if ($pdata->view == 2 && !Auth::Check()) {
            return view('p404');
        }


        $datastring = 'Всегда';
        if ($pdata->expiration > 0) {
            $datastring = 'до ' . date("H:i:s m.d.Y");
        }
        $userstring = '';
        $userstring2 = '';
        if ($pdata->user != '') {
            $userstring = 'Автор:' . $pdata->user . '<br>';
        }
        if ($pdata->user != '') {
            $userstring2 = $pdata->user;
        }

        return view('pasta', ['pdata' => $pdata, 'extime' => $datastring, 'userstring' => $userstring, 'userstring2' => $userstring2]);
    }


    public static function getLastPaste()
    {
        $udat = strtotime("+0");
        //$pasta = paste::where('view',0)->where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->take(10)->get();
        $taker = 10;
        if (Auth::Check()) {
            $taker = 4;
        }
        $pasta = paste::where('view', 0, function ($r, $udat) {
            $r->Where('expiration', '>', $udat)->orWhere('expiration', 0)->get();
        })->orderBy('id', 'desc')->take($taker)->get();
        return $pasta;
    }

    public static function getMyLastPaste()
    {

        if (!Auth::check()) {
            return [];
        }
        $udat = strtotime("+0");
        //$pasta = paste::where('user',Auth::User()->user)->Where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->take(10)->get();
        //хреновый запрос. лучше на эскюэл сделать
        $pasta = paste::where('user', Auth::User()->user, function ($r, $udat) {
            $r->Where('expiration', '>', $udat)->orWhere('expiration', 0)->get();
        })->orderBy('id', 'desc')->take(10)->get();
        return $pasta;
    }



    public function ClearPast()
    {
        $udat = strtotime("+0");
        $p = paste::where('expiration', '<', $udat)->where('expiration', '>', 0)->delete();
    }



    public function MainCont() //все пасты
    {

        $udat = strtotime("+0");
        // $allpasta = paste::where('view',0)->where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->paginate(10);
        $allpasta =  paste::where('view', 0, function ($r, $udat) {
            $r->Where('expiration', '>', $udat)->orWhere('expiration', 0)->get();
        })->orderBy('id', 'desc')->paginate(10);
        $allpasta->setPath('');
        return view('main', ['allpasta' => $allpasta]);
    }

    public function UserCont() //пасты ползователя
    {
        if (!Auth::Check()) {
            return redirect(route('main'));
        }
        $udat = strtotime("+0");
        // $allpasta = paste::where('view',0)->where('expiration','>',$udat)->orWhere('expiration',0)->orderBy('id','desc')->paginate(10);
        $allpasta =  paste::where('user', Auth::User()->user, function ($r, $udat) {
            $r->Where('expiration', '>', $udat)->orWhere('expiration', 0)->get();
        })->orderBy('id', 'desc')->paginate(10);
        $allpasta->setPath('');
        return view('mypaste', ['allpasta' => $allpasta]);
    }


    public function FindPaste(Request $r){ //поиск

        $find=trim($r->get("find",""));
        $inname=$r->get("inname","");
        $incode=$r->get("incode","");
        $retreq=['find'=>$find,'inname'=>$inname,'incode'=>$incode];


        if($find=='' || ($inname=='' && $incode=='')){
            return view('find', ['finditem' => [], 'retreq'=>$retreq, 'notresult'=>'1']);

        }//проверяем на вакум


        $finda=explode(' ',$find);

        $dop =[];
        for($i=0;$i<sizeof($finda);$i++){
            if(strlen($finda[$i])>5){
                $l=strlen($finda[$i]);
                array_push($dop,mb_substr($finda[$i], 0, $l - 1),mb_substr($finda[$i], 0, $l - 2));
            }

        }

        $fmass=array_merge($finda, $dop);

        $fmodel1=new paste();

        if ($inname=='checked'){
            for($i=0;$i<sizeof($fmass);$i++){
                $fmodel1=$fmodel1->orwhere('name', 'LIKE', '%'.$fmass[$i].'%');
            }
        }
        if ($incode=='checked'){
            for($i=0;$i<sizeof($fmass);$i++){
                $fmodel1=$fmodel1->orwhere('code', 'LIKE', '%'.$fmass[$i].'%');
            }
        }


        $udat = strtotime("+0");
        $finditem=  $fmodel1->where('view', 0, function ($rw, $udat) {
            $rw->Where('expiration', '>', $udat)->orWhere('expiration', 0)->get();
        })->orderBy('id', 'desc')->paginate(10);

        return view('find', ['finditem' => $finditem, 'retreq'=>$retreq, 'notresult'=>'1']);
    }





    private function GetHash(int $id)
    {
        $mass = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $kol = ceil(log10($id)); //длинна хэша по id
        $idstr  = '' . $id;

        $alias = '';
        if ($kol < 4) {
            $idstr  = '0000' . $id;
            $idstr = substr($idstr, -4, 4);
        }

        for ($u = 0; $u < strlen($idstr); $u++) { //навсякий случай добавляем рандомности
            $alias[$u] = $mass[$idstr[$u]];
        }

        return $alias;
    }




    private function GetHash2(int $id)
    {

        $kol = 1 + ceil(log10($id)); //длинна хэша по id


        for ($u = 0; $u < 10; $u++) { //навсякий случай добавляем рандомности

            $hash = bin2hex(random_bytes($kol));

            if (!paste::where('alias', '=', $hash)->exists()) {
                return $hash;
            }
        }
    }


    Public static function ShtPasta($str){
        $a=explode(PHP_EOL,$str);
        $a=array_slice($a,0,9);
        return implode(PHP_EOL,$a);
    }
    Public static function PLtoTXT($str){
     if(strtolower($str)=='plain'){return 'Текст';}else{return $str;}
    }

}

<?php
namespace wsiz\etester\Http\Controllers;

use App;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use wsiz\etester\Model\User;

class testController extends Controller {

    
    public function logowaniedziekana(){
        $pass =\Request::get('pass',null);
        
        if($pass==null)
            return response()->json(['status'=>false]);
        
        return response()->json(['status'=>true]);
        
    }
    
    public function index()
    {
        $page = \wsiz\etester\Model\Page::first();
        
        return view('testTemplate::welcome',  compact('page'));
    }

    
    public function generujpytania()
    {
        $liczbapobran=\Session::get('liczbaPobran',1);
        $liczbapobran++;
        \Session::put('liczbaPobran',$liczbapobran);
        
        $liczbaLosowa=\Session::get('ll',false);
        $liczbaLosowaTyp=\Session::get('llTyp',false);
        
        if(!$liczbaLosowa || ($liczbapobran % 10) == 0)
        {
            $liczbaLosowa = rand(10000000,99999999);
            \Session::put('ll',$liczbaLosowa);
        }
        
        if(!$liczbaLosowaTyp || ($liczbapobran % 10) == 0)
        {
            $liczbaLosowaTyp = rand(100,999);
            \Session::put('llTyp',$liczbaLosowa);
        }
        
        $res = [
            'egzamin'=>null,
            ];
        
        $dziekanpass = \Request::get('pass','');
        
        if(!empty($dziekanpass))
        {
            $egzamin = \wsiz\etester\Model\authDean::whereRaw("md5(auth) = '".$dziekanpass."'")->first();
            if($egzamin!=null)
                $egzamin->dziekan=true;
            \Session::put('dziekanpass',$egzamin!=null);
        
        }
        else
            $egzamin = \wsiz\etester\Model\authDean::where("auth","")->orWhere("auth",null)->first();
            \Session::put('dziekanpass',false);
            
// 
//      
//                       dd($dziekanpass);

        unset($egzamin->auth);
        
        $zadanePytania = [];
        
        
        if($egzamin!=null)
        {
            $egzamin->czas = $egzamin!=null? strtotime($egzamin->testtime)-time() : 0; 

            $res['egzamin']=$egzamin;
            $typy = \wsiz\etester\Model\field::get();
            foreach($typy as $item)
            {
                $item->listapytan = $item->losowanie()->limit($egzamin->questcount/count($typy))->get();
                $typId = $item->id;
               // $item->tid=$item->id;
                $item->id^=$liczbaLosowaTyp;
               // $item->id1=$item->id^$liczbaLosowaTyp;
                $zadanePytania[$item->id]['id']=$typId;
                foreach($item->listapytan as $pytanie) {
                    $oldId=$pytanie->id;
                  //  $pytanie->ids = $pytanie->id;
                    $pytanie->id^=$liczbaLosowa;
                  //  $pytanie->id1=$pytanie->id^$liczbaLosowa;
                    $zadanePytania[$item->id]['pytanie'][$pytanie->id]=$oldId;
                    $pytanie->question=$pytanie->dodaj_biale_znaki($pytanie->question);
                    $pytanie->response1=$pytanie->dodaj_biale_znaki($pytanie->response1);
                    $pytanie->response2=$pytanie->dodaj_biale_znaki($pytanie->response2);
                    $pytanie->response3=$pytanie->dodaj_biale_znaki($pytanie->response3);
                }
                $res['pytania'][]=$item;
                
            }
            \Session::put('startTime', time());
            \Session::put('zadanePytania',$zadanePytania);
        }           
        
        
        
        
        return response()->json($res);
    }
}


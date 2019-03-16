<?php

namespace wsiz\etester\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $kolejnosci_odpowiedzi = [[1,2,3],[2,1,3],[3,1,2],[1,3,2],[2,3,1],[3,2,1]];
    public $selektory = ["ad","ad2","fi","bd","us","ox","inny","test","ukryty","wsiz","tunicniema","moznatak"];
    public $klasy = ['a','b','c','d','e','f'];
    public $wypelniacz = ['a','b','c','d','w','f','g','h','i','j','k','s','w'];    
    //
    protected $fillable = ['title','question','response1','response2','response3','correct','type','active'];


    public function types() {
        
        return $this->hasOne(\wsiz\etester\Model\field::class, 'id','type');
    }
    
    public function dodaj_biale_znaki($tekst)
    {
        
        $dane = "";
        $dlugosc_tekstu = strlen($tekst);
        for($i=0; $i<$dlugosc_tekstu-1;$i++)
        {
            $addon = "";
            $rnd = rand(1,3);
            for($j=0; $j<$rnd; $j++)
            {
            $selektor = $this->selektory[rand(0,count($this->selektory)-1)];
            $klasa = $this->klasy[rand(0,count($this->klasy)-1)];
            $addon .=  "<{$selektor} class=\"{$klasa}\">".$this->wypelniacz[rand(0,count($this->wypelniacz)-1)]." </{$selektor}>";
            
            }
            
            if(preg_match("/([a-z0-9 !@#$%^&()_=]{1})/", $tekst[$i]) && rand(0,3)==0)
            {
                $dane .= "<{$selektor}>{$tekst[$i]}</$selektor>{$addon}";
            }
            else
                $dane .= $tekst[$i];
        }
        return $dane;
    }
}

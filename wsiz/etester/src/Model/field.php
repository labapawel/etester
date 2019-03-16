<?php

namespace wsiz\etester\Model;

use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    protected $fillable = ['title'];


    public function __construct()
    {
        $this->wypelniacz = explode(" ","Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker");
//        dd($this->wypelniacz);
        
    }
    
    public function questoin() {
        return $this->hasMany(\wsiz\etester\Model\Question::class, 'type');
    }
    
    public function losowanie() {
        return $this->questoin()->select('id','question','response1','response2','response3')->where('active',1)->inRandomOrder();
    }
    
    
}

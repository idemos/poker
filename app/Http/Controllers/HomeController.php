<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Hand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');       

        $this->semi = [
            'H' => 4, //CUORI
            'D' => 3, //QUADRI
            'C' => 2, //FIORI
            'S' => 1  //PICCHE
        ];
    }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin');
    }

    public function checkIsSame($cards = []){

        $array_new = array_count_values($cards);
        $array2 = array();
        foreach($array_new as $key=>$val){
            if($val < 5){ //or do $val >2 based on your desire
              $array2[] = $key;
            }
        }
        print_r($array2);
    }

    public function checkConsec($cards = []) {

        $key = array_keys($this->semi);
        $val = array_values($this->semi);

        sort($cards);

        $cards = implode(' ', $cards);
        $cards = str_replace($key, $val, $cards);
        $cards = explode(' ', $cards);


        for($i=0;$i<count($cards);$i++) {
            if(isset($cards[$i+1]) && $cards[$i]+1 != $cards[$i+1]) {
                return false;
            }
        }

        return true;
    }

    public function isScalaReale(){

        if($this->isScala() && $this->isColore()){

        }
        
    }

    public function convert($value){

        //dd($array);

        $key = array_keys($this->semi);
        $val = array_values($this->semi);

        return strrev(str_replace($key, $val, $value));
    }

    public function isScala($item){

        $hand_user_1 = array_map(
            array($this,'convert'), 
            [$item->card_1, $item->card_2, $item->card_3, $item->card_4, $item->card_5]
        );

        $hand_user_2 = array_map(
            array($this,'convert'), 
            [$item->card_6, $item->card_7, $item->card_8, $item->card_9, $item->card_10]
        );

        if($this->checkConsec($hand_user_1)){
            return true;
        }elseif($this->checkConsec($hand_user_2)){
            return true;
        }
    }

    public function analize(){



        Hand::paginate(1000)->each(function ($item, $key){

            //dd($item);
            
            $hand_user_1 = array_map(array($this,'convert'), 
                [$item->card_1, $item->card_2, $item->card_3, $item->card_4, $item->card_5]);
            $hand_user_2 = array_map(array($this,'convert'), 
                [$item->card_6, $item->card_7, $item->card_8, $item->card_9, $item->card_10]);

            $hand_user_both = $this->isColore($item);

            if(!empty((int)$hand_user_both)){
                //echo $hand_user_both . '<br>'.$item->id_challenge;
                $field = ((string)$hand_user_both[0] == '1'?'hand_1':'hand_2');

                Hand::find($item->id_challenge)->update([$field => 'colore']);
            }

            //$this->isFull($item);

        });
    }


    public function isColore($item){

        $out_1 = 0;
        foreach($this->semi as $seme => $val){

            $pocker_user_1 = collect([$item->card_1, $item->card_2, $item->card_3, $item->card_4,$item->card_5])->every(function($item_card) use ($seme){
                return $item_card[1] == $seme;
            });


            if($pocker_user_1 === true){
                $out_1 = 1;
                break;
            }
        }


        $out_2 = 0;
        foreach($this->semi as $seme => $val){
            
            $pocker_user_2 = collect([$item->card_6, $item->card_7, $item->card_8, $item->card_9,$item->card_10])->every(function($item_card) use ($seme){
                return $item_card[1] == $seme;
            });

            if($pocker_user_2 === true){
                $out_2 = 1;
                break;
            }
        }

        return $out_1.$out_2;

    }

    public function store(Request $request){
        
        set_time_limit(0);
  

        $request->validate([
            'hand' => 'required',
        ]);


        if($request->hasFile('hand')){
            $hand_store = $request->hand->store('hands');
            $hand_path  = Storage::path($hand_store);

            $content = file_get_contents($hand_path);
            if(!empty($content)){
                
                // rows array
                $aRows = explode("\n", $content);

                $iCount = 1;
                collect($aRows)->map(function($sItem,$key) use (&$iCount){

                    
                    if(!empty($sItem)){

                        $aCols = explode(' ', $sItem);
                        //print_r($aCols);

                        Hand::create([
                            'id_challenge'=> $iCount,
                            'id_user_1' => 1,
                            'card_1' => $aCols[0], 
                            'card_2' => $aCols[1], 
                            'card_3' => $aCols[2], 
                            'card_4' => $aCols[3],
                            'card_5' => $aCols[4],
                            'id_user_2' => 2,
                            'card_6' => $aCols[5],
                            'card_7' => $aCols[6],
                            'card_8' => $aCols[7],
                            'card_9' => $aCols[8],
                            'card_10' => $aCols[9]
                        ]);

                        $iCount++;
                    }

                });

            }


        }

        return redirect()->route('admin')->with(['status'=> 'file uploaded successfully']);

    }
}

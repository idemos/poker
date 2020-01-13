<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hand extends Model
{
    protected $table = 'hands';
    protected $primaryKey = 'id_challenge';
    protected $fillable = [
    	'id_user_1','card_1','card_2','card_3','card_4','card_5','hand_1',
    	'id_user_2','card_6','card_7','card_8','card_9','card_10','hand_2',
    	'id_user_win'
	];
}

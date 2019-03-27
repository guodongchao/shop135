<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\GoodsModel;
class CartModel extends Model{
    public $table = 'cart';
    public $timestamps = false;

}

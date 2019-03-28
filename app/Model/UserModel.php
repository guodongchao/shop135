<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
class UserModel extends Model
{
    public $table = "p_users";
    public $timestamps = false;
}
?>
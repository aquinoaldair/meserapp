<?php


namespace App\Helpers;


use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Support\Str;

class RoomHelper
{
    static function getKey(){
        $room = app(RoomRepositoryInterface::class);
        $key = Str::random('6');
        $item = $room->findByKey($key);
        if ($item){
            return self::getKey();
        }
        return $key;
    }

    static function getKeyTable(){
        $room = app(TableRepositoryInterface::class);
        $key = Str::random('6');
        $item = $room->findByKey($key);
        if ($item){
            return self::getKeyTable();
        }
        return $key;
    }

}

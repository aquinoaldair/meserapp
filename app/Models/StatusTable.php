<?php


namespace App\Models;


class StatusTable
{
    CONST STATUS_ENABLED = "enabled";
    CONST STATUS_DISABLED = "disabled";
    CONST STATUS_OCCUPIED = "occupied";
    CONST STATUS_ORDERED = "ordered";
    CONST STATUS_RESERVED = "reserved";
    CONST STATUS_PAYING = "paying";


    public static function getTranslation($status){
        switch ($status){
            case self::STATUS_ENABLED:
                $value = "Libre";
                break;
            case self::STATUS_DISABLED:
                $value = "Deshabilitada";
                break;
            case self::STATUS_ORDERED:
                $value = "Pendiente";
                break;
            case self::STATUS_OCCUPIED:
                $value = "Ocupada";
                break;
            case self::STATUS_RESERVED:
                $value = "Reservada";
                break;
            case self::STATUS_PAYING:
                $value = "Pagando";
                break;
            default:
                $value = "Libre";
        }
        return $value;
    }
}

<?php

class DataTableHelper
{

    public static function prepareBooleanColumn($value)
    {
        switch ($value) {
            case 0:
                return '<span class="label label-danger"><i class="fa fa-times"></i></span>';
                break;
            case 1:
                return '<span class="label label-success"><i class="fa fa-check"></i></span>';
                break;
            default:
                return $value;
        }
    }
} 
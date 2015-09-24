<?php

/*
    AUTHOR: Ivan Paul Bay
    DATE CREATED: August 29, 2014
    My Custon Libray
*/


class CustomHelpers{
    
    public static function format_db_date($date){
        
        $format_date = date('Y-m-d', strtotime($date));
        
        return $format_date;
    
    }
    
    
    public static function format_date($date){
        
        if( empty($date) ){
            $format_date = '-';
        } else {
            $format_date = date('M.d.Y', strtotime($date));
        }
        
        return $format_date;
        
    }
    
    
    public static function format_datetime($date){
        
        $format_date = date("M.d.Y H:i:s", strtotime($date));
        
        return $format_date;
    }

    public static function gen_json_file($type, $array){

        $data[$type] = $array;

        $fp = fopen(public_path() . '/data/records.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);

    }
    
}

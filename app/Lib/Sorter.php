<?php
/**
 * Created by PhpStorm.
 * User: nettrac
 * Date: 5/14/19
 * Time: 2:50 PM
 */

namespace App\Lib;



use Request;

class Sorter{

    private $header = '';


    public function __construct($config, &$sort_field, &$sort_order){

        extract($config);

        $sort_field_index = "sort.{$controller}.sort_field";
        $sort_order_index = "sort.{$controller}.sort_order";

        if($field = Request::get('field')){
            $sort_field = $field;
            Request::session()->put($sort_field_index,$field);
        }elseif(Request::session()->get($sort_field_index)){
            $sort_field = Request::session()->get($sort_field_index);
        }

        if($order = Request::get('order')){
            $sort_order = $order;
            Request::session()->put($sort_order_index,$order);
        }elseif(Request::session()->get($sort_order_index)){
            $sort_order = Request::session()->get($sort_order_index);
        }

        $sort_header[$sort_field][1] = ($sort_order=='asc')?'desc':'asc';

        $sort_header[$sort_field][2] = config("app.sort_icon.{$sort_order}");

        $header = '';

        foreach ($sort_header as $i => $row){

            if($i && isset($row[1]) && $row[1] && isset($row[0])){
                $header .= '<th><a href="'.url("admin/{$controller}/?field={$i}&order={$row[1]}").'">'.$row[0].'</a>'.$row[2].'</th>';
            }elseif(isset($row[0])){
                $header .= '<th>'.$row[0].'</th>';
            }
        }

        $this->header = $header;
    }

    public function getHeader(){
        return $this->header;
    }

}
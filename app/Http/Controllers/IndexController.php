<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    function index(){
        $response = array();
        $response['title'] = __('Index');
        return view("index2")->with($response);
    }


    function welcome(){
        $response = array();
        return view("welcome2")->with($response);
    }

    function announce(){
        $response = array();
        $response['title'] = __('Announce');
        return view("announce")->with($response);
    }

    function updateNote(){
        $response = array();
        $response['title'] = __('Update Announce');
        return view("announce")->with($response);
    }

    function blackList(){
        $response = array();
        $response['title'] = __('BlackList');
        return view("blackList")->with($response);
    }
}

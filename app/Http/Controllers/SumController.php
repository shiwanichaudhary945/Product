<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumController extends Controller
{
    public function sum(){


        $numbers = [10, 20, 30];
        $sum = 0;

        foreach ($numbers as $number) {
            $sum += $number;
        }


        return view('frontend.sum',['sum'=>$sum]);

        }



    }




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index(){
        return view('billing.index');
    }
   public function billingPlan($plan)
    {
        $shop = Auth::user();
        if($plan == "Basic") {
            return redirect()->route('billing', ['plan' => 1, 'shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        }
        else  if($plan == "BasicAnnual") {
            return redirect()->route('billing', ['plan' => 2, 'shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        }
        else if($plan == "Standard"){
            return redirect()->route('billing', ['plan' => 3, 'shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        }
        else if($plan == "StandardAnnual"){
            return redirect()->route('billing', ['plan' => 4, 'shop' => Auth::user()->name, 'host'=>app('request')->input('host')]);
        }
     
    }

  
}

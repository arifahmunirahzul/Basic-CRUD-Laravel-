<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutUs()
    {
    	$company = 'Elyzian Interactive';
    	$founder = 'En Ferdy Fauzi';

        //Method 1
    	return view ('pages.index')
    			->with('company', $company)
    			->with('founder', $founder);

    	//Method 2
    	// return view('pages.index',[
    	// 	'company'=>$company ,
    	// 	'founder'=>$founder
    	// ]);

    	//Method 3
    // 	return view('pages.index', compact('company', 'founder'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
    public function execute()
    {
        if(view()->exists('admin.portfolios')) {
            $portfolio = Portfolio::all();
            $data = [
                'title' => 'Портфолио',
                'portfolios' => $portfolio
            ];

            return view('admin.portfolios', $data);
        }
        abort(404);
    }
}

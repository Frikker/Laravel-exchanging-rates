<?php

namespace App\Http\Controllers;

use App\Models\Rates;
use Illuminate\Http\Request;

class ConvertorController extends Controller
{

    public function index(){
        return view('layout');
    }

    public function convert(Request $request)
    {
        $valid = $request->validate([
            'amount' => 'required',
        ]);
        $rate = Rates::where('date', '=', $request->input('date'))->first();
        $currencies = json_decode($rate->rate, true)['rates'];
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount');
        $value = round( $amount * $currencies[$to] / $currencies[$from], 2);

        return view('index',
            [
                'currencies' => $currencies,
                'value' => $value,
                'from' => $from,
                'to' => $to,
                'amount' => $amount,
            ]);
    }

    public function loadRates(Request $request)
    {
        $date = $request->input('date');
        $rate = Rates::where('date', '=', $date)->get();
        if (!$rate || $date == null) {
            $currenciesJSON = file_get_contents("https://api.exchangeratesapi.io/latest?base=USD");
            $rate = Rates::create([
                'rate' => $currenciesJSON,
                'date' => $date,
                'base' => 'USD',
            ]);
        } elseif ($date < date('Y-m-d')) {
            $currenciesJSON = file_get_contents("https://api.exchangeratesapi.io/latest?base=USD");
            return view('layout', ['errors' => 'There is no exchange rates on your date', 'currencies' => json_decode($currenciesJSON)['rates']]);
        } else {
            $currenciesJSON = $rate->rate;
        }
        return view('layout', ['currencies' => json_decode($currenciesJSON, true)['rates']]);
    }

    public function getCurrencies()
    {
        return $this->currencies;
    }
}

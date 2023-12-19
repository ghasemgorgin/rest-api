<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index(Request $request){
        $entry = $request->input('entry', 0);
        $stoop = $request->input('stoop', 0);
        $sarmayeah = $request->input('sarmayeah', 0);
        $arbear = $request->input('arbear', 0);
        $symbol = $request->input('symbol', '');
        $risk = $request->input('risk', '');

        // ثابت URL برای ارسال درخواست
        $url = 'https://babitcash.com/panel/funnctionme.php';

        // پارامترهایی که باید به درخواست اضافه شوند
        $params = [
            'entry' => $entry,
            'sarmayeah' => $sarmayeah,
            'stoop' => $stoop,
            'arbear' => $arbear,
            'symbol' => $symbol,
            'risk' => $risk
        ];
        //    dd($params); 
        // ارسال درخواست GET و دریافت پاسخ
        $response = Http::get($url, $params);

        // بررسی موفقیت‌آمیز بودن درخواست
        if ($response->successful()) {
            // بازگرداندن پاسخ به صورت JSON
            return response()->json($response->json());
        }

        // در صورت خطا یک پیام با کد مناسب برگردانده می‌شود
        return response()->json(['error' => 'Unable to retrieve data from the API.'], $response->status());
    }
}
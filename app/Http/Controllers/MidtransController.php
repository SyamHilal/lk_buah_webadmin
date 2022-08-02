<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\M_Transaction;
use App\Models\M_Detail_Transaction;
use Illuminate\Http\Request;
use App\Models\M_Users;
use Carbon\Carbon;
use App\Models\M_Cart;
use App\Models\M_Wallet;
use App\Models\M_Detail_Wallet;

use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\Transaction;
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;
use App\Http\Controllers\Midtrans\Sanitizer;
use App\Http\Controllers\DashboardController;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class MidtransController extends Controller
{

    public function finish(Request $request)
    {
        return view('success');
    }

    public function unfinished(Request $request)
    {
        echo "Transaction Unfinished yet :( <br>";
        echo json_decode($request);
    }

    public function error(Request $request)
    {
        echo "Transaction Fail :| <br>";
        echo json_decode($request);
    }

}


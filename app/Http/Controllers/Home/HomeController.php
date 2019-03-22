<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\User;

// Testing
use App\MyHelpers\ProgressBar\ProgressBar;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function home(Request $request)
    {
        // Check for account expiration, device id, and multiple logins
        $isUser = auth()->user()->roles === 'user';
        $isExpired = Carbon::parse(auth()->user()->expired_at)->lessThan(now());
        if ($isUser && $isExpired) {
            session(['error' => 'Akun anda telah kadaluwarsa.']);
            auth()->logout();
            
            return redirect()->route('login');
        }

        return view('home.home');
    }


    public function downloads(Request $request)
    {
        return view('home.downloads');
    }


    public function tutorials(Request $request)
    {
        return view('home.tutorials');
    }


    public function test(Request $request)
    {
        $options = ['autoCalc' => true, 'totalStages' => 4, 'handleErrors' => false];
        $progress = new ProgressBar($options);


        $stageOptions = [
            'name' => 'Fetch data URL',
            'message' => 'Fetch data link produk..',
            'totalItems' => 100
        ];

        $progress->nextStage($stageOptions);

        for ($i = 0; $i <= $stageOptions['totalItems']; $i++) {
            usleep(50 * 1000);
            $progress->incrementStageItems(1, true);
        }


        $stageOptions = [
            'name' => 'Scraping..',
            'message' => 'Mengambil info produk http://bukalapak.com/trstfs/ghsghshs/jskjkss....',
            'totalItems' => 50
        ];

        $progress->nextStage($stageOptions);

        for ($i = 0; $i <= $stageOptions['totalItems']; $i++) {
            usleep(50 * 1000);
            $progress->incrementStageItems(1, true);
        }


        $stageOptions = [
            'name' => 'Menyimpan ke database..',
            'message' => 'Menyimpan data produk http://bukalapak.com/trstfs/ghsghshs/jskjkss....',
            'totalItems' => 200,
        ];

        $progress->nextStage($stageOptions);

        for ($i = 0; $i <= $stageOptions['totalItems']; $i++) {
            usleep(50 * 1000);
            $progress->setStageMessage("Memproses link $i");
            $progress->incrementStageItems(1, true);
        }


        $stageOptions = [
            'name' => 'Menyelesaikan proses scraping...',
            'message' => 'Menutup koneksi data..',
            'totalItems' => 150,
        ];

        $progress->nextStage($stageOptions);

        for ($i = 0; $i <= $stageOptions['totalItems']; $i++) {
            usleep(50 * 1000);
            $progress->incrementStageItems(1, true);
        }

        $progress->totallyComplete();
    }


    public function showTestPage(Request $request)
    {
        return view('home.test', ['jsonfile' => Storage::url('progress.json')]);
    }

    public function jsonProgress(Request $request)
    {
        $content = Storage::get('progress.json');
        return response($content, 200, ['Connection' => 'Keep-Alive', 'Content-Type' => 'application/json']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaundryDb;
use App\Traits\JsonResult;
use App\Traits\Helper;
use Illuminate\Support\Facades\Session;
use App\Enums\ConstSessions;
use App\Enums\ConstLogAuditrail;
use App\Traits\LogAuditrail;
use App\Enums\ConstActivityStatus;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class LaundryController extends Controller
{
    use JsonResult;
    use Helper;
    private $laundryDb;

    public function __construct()
    {
        $this->laundryDb = new LaundryDb();
    }

    public function viewLaundry(Request $request)
    {
        $tahunList = $this->laundryDb->getListTahun();

        return view('laundry.linen', compact('tahunList'));
    }

    public function viewTambahLinen()
    {
        return view('laundry.tambah-data-linen');
    }
    
    public function getListLinen(Request $request)
    {
        $resultLinen = $this->laundryDb->getLinen($request->key);
        return $this->resultWithData($resultLinen, true, 200);
    }

}

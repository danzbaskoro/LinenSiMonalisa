<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generateQRCode()
    {
        $qrCode = QrCode::size(300)->generate('coba qr code');
        return view('qrcode', compact('qrCode'));
    }
}

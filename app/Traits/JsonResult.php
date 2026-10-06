<?php

declare(strict_types=1);

namespace App\Traits;

use function response;

trait JsonResult
{
    //Bisa untuk return data dari controller ke AJAX JS. Gunakan ini jika return dari controller ada datanya.
    public function resultWithData($data, $result, $code)
    {
        //code 200 untuk success
        //result tipedatanya boolean, true or false
        //data berisi data balikan dari controller
        return response()->json([
            'code' => $code,
            'result' => $result,
            'data' => $data
        ], $code);
    }

    //Bisa untuk return data dari controller ke AJAX JS. Gunakan ini jika return dari controller berupa datatable server side.
    public function resultWithDataTable($draw, $total, $data)
    {
        $result = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        );
        return response()->json($result);
    }

    //Bisa untuk return data dari controller ke AJAX JS. Gunakan ini jika return dari controller tidak ada datanya.
    public function resultNoData($result, $code)
    {
        //code 200 untuk success
        //result tipedatanya boolean, true or false
        return response()->json([
            'code' => $code,
            'result' => $result
        ], $code);
    }

    //Bisa untuk return data dari controller ke AJAX JS. Gunakan ini jika ingin menampilkan pesan error dari controller.
    public function resultError($message)
    {
        //message tipedatanya string, isi pesan errornya disini
        return response()->json([
            'code' => 400,
            'result' => false,
            'message' => $message
        ], 400);
    }
}
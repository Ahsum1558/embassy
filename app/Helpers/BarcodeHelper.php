<?php

namespace App\Helpers;

use Milon\Barcode\DNS1D;
use Mpdf\Mpdf;
class BarcodeHelper
{
    // public static function generateBarcode128($value)
    // {
    //     $generator = new DNS1D();
    //     return $generator->getBarcodeHTML($value, 'C128');
    // }

    public static function generateBarcode128($value, $width, $height)
    {
        // Include the code128.php file
        require_once(public_path('code128.php'));

        // Create a new instance of the PDF class
        $mpdf = new \Mpdf\Mpdf();

        // Generate the barcode
        $barcode = code128(strtoupper($value), false, $width, $height);

        // Set the barcode as HTML content in the PDF
        $mpdf->WriteHTML($barcode);

        // Output the PDF
        $mpdf->Output();
    }

     public static function code128($value)
    {
        require_once(public_path('code128.php'));

        // Create a new instance of the PDF class
        $mpdf = new \Mpdf\Mpdf();

        // Generate the barcode
        $barcode = code128(strtoupper($value), false, $width, $height);

        // Set the barcode as HTML content in the PDF
        $mpdf->WriteHTML($barcode);
        return $barcode;
    }
}

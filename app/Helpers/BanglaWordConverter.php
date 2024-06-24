<?php

namespace App\Helpers;

use Milon\Barcode\DNS1D;
use Mpdf\Mpdf;
class BanglaWordConverter
{
    public function convertBnWord(float $amount){
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => 'শূন্য', 1 => 'এক', 2 => 'দুই', 3 => 'তিন',
            4 => 'চার', 5 => 'পাঁচ', 6 => 'ছয়', 7 => 'সাত',
            8 => 'আট', 9 => 'নয়', 10 => 'দশ',
            11 => 'এগার', 12 => 'বার', 13 => 'তের', 14 => 'চৌদ্দ',
            15 => 'পনের', 16 => 'ষোল', 17 => 'সতের',
            18 => 'আঠার', 19 => 'ঊনিশ', 20 => 'বিশ',
            21 => 'একুশ', 22 => 'বাইশ', 23 => 'তেইশ',
            24 => 'চব্বিশ', 25 => 'পঁচিশ', 26 => 'ছাব্বিশ',
            27 => 'সাতাশ', 28 => 'আটাশ', 29 => 'ঊনত্রিশ',
            30 => 'ত্রিশ',
            31 => 'একত্রিশ', 32 => 'বত্রিশ', 33 => 'তেত্রিশ',
            34 => 'চৌত্রিশ', 35 => 'পঁয়ত্রিশ', 36 => 'ছত্রিশ',
            37 => 'সাঁইত্রিশ', 38 => 'আটত্রিশ', 39 => 'ঊনচল্লিশ',
            40 => 'চল্লিশ',
            41 => 'একচল্লিশ', 42 => 'বিয়াল্লিশ', 43 => 'তেতাল্লিশ',
            44 => 'চুয়াল্লিশ', 45 => 'পঁয়তাল্লিশ', 46 => 'ছেচল্লিশ',
            47 => 'সাতচল্লিশ', 48 => 'আটচল্লিশ',
            49 => 'ঊনপঞ্চাশ', 50 => 'পঞ্চাশ',
            51 => 'একান্ন', 52 => 'বায়ান্ন', 53 => 'তিপ্পান্ন',
            54 => 'চুয়ান্ন', 55 => 'পঞ্চান্ন', 56 => 'ছাপ্পান্ন',
            57 => 'সাতান্ন', 58 => 'আটান্ন', 59 => 'ঊনষাট',
            60 => 'ষাট',
            61 => 'একষট্টি', 62 => 'বাষট্টি', 63 => 'তেষট্টি',
            64 => 'চৌষট্টি', 65 => 'পঁয়ষট্টি', 66 => 'ছেষট্টি',
            67 => 'সাতষট্টি', 68 => 'আটষট্টি', 69 => 'ঊনসত্তর',
            70 => 'সত্তর',
            71 => 'একাত্তর', 72 => 'বাহাত্তর', 73 => 'তিয়াত্তর',
            74 => 'চুয়াত্তর', 75 => 'পঁচাত্তর', 76 => 'ছিয়াত্তর',
            77 => 'সাতাত্তর', 78 => 'আটাত্তর', 79 => 'ঊনআশি',
            80 => 'আশি',
            81 => 'একাশি', 82 => 'বিরাশি', 83 => 'তিরাশি',
            84 => 'চুরাশি', 85 => 'পঁচাশি', 86 => 'ছিয়াশি',
            87 => 'সাতাশি', 88 => 'আটাশি', 89 => 'ঊননব্বই',
            90 => 'নব্বই',
            91 => 'একানব্বই', 92 => 'বিরানব্বই', 93 => 'তিরানব্বই',
            94 => 'চুরানব্বই', 95 => 'পঁচানব্বই', 96 => 'ছিয়ানব্বই',
            97 => 'সাতানব্বই', 98 => 'আটানব্বই', 99 => 'নিরানব্বই',
            100 => 'একশ', 200 => 'দুইশ', 300 => 'তিনশ',
            400 => 'চারশ', 500 => 'পাঁচশ', 600 => 'ছয়শ',
            700 => 'সাতশ', 800 => 'আটশ', 900 => 'নয়শ');
        $here_digits = array('', 'শত', 'হাজার','লক্ষ','কোটি');
        while( $x < $count_length ) {
               $get_divider = ($x == 2) ? 10 : 100;
           $amount = floor($num % $get_divider);
           $num = floor($num / $get_divider);
           $x += $get_divider == 10 ? 1 : 2;
           if ($amount) {
             $add_plural = (($counter = count($string)) && $amount > 9) ? '' : null;
             $amt_hundred = ($counter == 1 && $string[0]) ? ' ' : null;
             $string [] = ($amount < 101) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
             '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
             '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
             }else $string[] = null;
           }
           $implode_to_Rupees = implode('', array_reverse($string));
           $get_paise = ($amount_after_decimal > 0) ? " " . ($change_words[$amount_after_decimal / 10] . " 
           " . $change_words[$amount_after_decimal % 10]) . '' : '';
           return ($implode_to_Rupees ? $implode_to_Rupees . '' : '') . $get_paise;
    }

    public function convertToWord(float $amount){
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
         3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
         7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
         10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
         13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
         16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
         19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
         40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
         70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore', 'Hundred Crore');
        while( $x < $count_length ) {
               $get_divider = ($x == 2) ? 10 : 100;
           $amount = floor($num % $get_divider);
           $num = floor($num / $get_divider);
           $x += $get_divider == 10 ? 1 : 2;
           if ($amount) {
             $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
             $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
             $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
             '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
             '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
             }else $string[] = null;
           }
           $implode_to_Rupees = implode('', array_reverse($string));
           $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
           " . $change_words[$amount_after_decimal % 10]) . '' : '';
           return ($implode_to_Rupees ? $implode_to_Rupees . '' : '') . $get_paise;
    }

    public function convertAmountToBengaliWords(float $amount): string
	{
	    $amountAfterDecimal = round($amount - ($num = floor($amount)), 2) * 100;

	    $changeWords = array(0 => 'শূন্য', 1 => 'এক', 2 => 'দুই', 3 => 'তিন',
	            4 => 'চার', 5 => 'পাঁচ', 6 => 'ছয়', 7 => 'সাত',
	            8 => 'আট', 9 => 'নয়', 10 => 'দশ',
	            11 => 'এগার', 12 => 'বার', 13 => 'তের', 14 => 'চৌদ্দ',
	            15 => 'পনের', 16 => 'ষোল', 17 => 'সতের',
	            18 => 'আঠার', 19 => 'ঊনিশ', 20 => 'বিশ',
	            21 => 'একুশ', 22 => 'বাইশ', 23 => 'তেইশ',
	            24 => 'চব্বিশ', 25 => 'পঁচিশ', 26 => 'ছাব্বিশ',
	            27 => 'সাতাশ', 28 => 'আটাশ', 29 => 'ঊনত্রিশ',
	            30 => 'ত্রিশ',
	            31 => 'একত্রিশ', 32 => 'বত্রিশ', 33 => 'তেত্রিশ',
	            34 => 'চৌত্রিশ', 35 => 'পঁয়ত্রিশ', 36 => 'ছত্রিশ',
	            37 => 'সাঁইত্রিশ', 38 => 'আটত্রিশ', 39 => 'ঊনচল্লিশ',
	            40 => 'চল্লিশ',
	            41 => 'একচল্লিশ', 42 => 'বিয়াল্লিশ', 43 => 'তেতাল্লিশ',
	            44 => 'চুয়াল্লিশ', 45 => 'পঁয়তাল্লিশ', 46 => 'ছেচল্লিশ',
	            47 => 'সাতচল্লিশ', 48 => 'আটচল্লিশ',
	            49 => 'ঊনপঞ্চাশ', 50 => 'পঞ্চাশ',
	            51 => 'একান্ন', 52 => 'বায়ান্ন', 53 => 'তিপ্পান্ন',
	            54 => 'চুয়ান্ন', 55 => 'পঞ্চান্ন', 56 => 'ছাপ্পান্ন',
	            57 => 'সাতান্ন', 58 => 'আটান্ন', 59 => 'ঊনষাট',
	            60 => 'ষাট',
	            61 => 'একষট্টি', 62 => 'বাষট্টি', 63 => 'তেষট্টি',
	            64 => 'চৌষট্টি', 65 => 'পঁয়ষট্টি', 66 => 'ছেষট্টি',
	            67 => 'সাতষট্টি', 68 => 'আটষট্টি', 69 => 'ঊনসত্তর',
	            70 => 'সত্তর',
	            71 => 'একাত্তর', 72 => 'বাহাত্তর', 73 => 'তিয়াত্তর',
	            74 => 'চুয়াত্তর', 75 => 'পঁচাত্তর', 76 => 'ছিয়াত্তর',
	            77 => 'সাতাত্তর', 78 => 'আটাত্তর', 79 => 'ঊনআশি',
	            80 => 'আশি',
	            81 => 'একাশি', 82 => 'বিরাশি', 83 => 'তিরাশি',
	            84 => 'চুরাশি', 85 => 'পঁচাশি', 86 => 'ছিয়াশি',
	            87 => 'সাতাশি', 88 => 'আটাশি', 89 => 'ঊননব্বই',
	            90 => 'নব্বই',
	            91 => 'একানব্বই', 92 => 'বিরানব্বই', 93 => 'তিরানব্বই',
	            94 => 'চুরানব্বই', 95 => 'পঁচানব্বই', 96 => 'ছিয়ানব্বই',
	            97 => 'সাতানব্বই', 98 => 'আটানব্বই', 99 => 'নিরানব্বই',
	            100 => 'একশ', 200 => 'দুইশ', 300 => 'তিনশ',
	            400 => 'চারশ', 500 => 'পাঁচশ', 600 => 'ছয়শ',
	            700 => 'সাতশ', 800 => 'আটশ', 900 => 'নয়শ');

	    $hereDigits = array('', 'শত', 'হাজার', 'লক্ষ', 'কোটি');

	    $string = array();
	    $countLength = strlen($num);
	    $x = 0;

	    while ($x < $countLength) {
	        $getDivider = ($x == 2) ? 10 : 100;
	        $amount = floor($num % $getDivider);
	        $num = floor($num / $getDivider);
	        $x += $getDivider == 10 ? 1 : 2;

	        if ($amount) {
	            $addPlural = (($counter = count($string)) && $amount > 9) ? '' : null;
	            $amtHundred = ($counter == 1 && $string[0]) ? ' ' : null;

	            if ($amount < 101) {
	                $string[] = $changeWords[$amount] . ' ' . $hereDigits[$counter] . $addPlural . ' ' . $amtHundred;
	            } else {
	                $string[] = $changeWords[floor($amount / 10) * 10] . ' ' . $changeWords[$amount % 10] . ' ' . $hereDigits[$counter] . $addPlural . ' ' . $amtHundred;
	            }
	        } else {
	            $string[] = null;
	        }
	    }

	    $implodeToRupees = implode('', array_reverse($string));
	    $getPaise = ($amountAfterDecimal > 0) ? " " . ($changeWords[$amountAfterDecimal / 10] . " " . $changeWords[$amountAfterDecimal % 10]) . '' : '';

	    return ($implodeToRupees ? $implodeToRupees . '' : '') . $getPaise;
	}

	public function convertToBanglaWord($number)
    {
        $banglaDigits = [
            0 => 'শূন্য', 1 => 'এক', 2 => 'দুই', 3 => 'তিন',
            4 => 'চার', 5 => 'পাঁচ', 6 => 'ছয়', 7 => 'সাত',
            8 => 'আট', 9 => 'নয়', 10 => 'দশ',
            11 => 'এগার', 12 => 'বার', 13 => 'তের', 14 => 'চৌদ্দ',
            15 => 'পনের', 16 => 'ষোল', 17 => 'সতের',
            18 => 'আঠার', 19 => 'ঊনিশ', 20 => 'বিশ',
            21 => 'একুশ', 22 => 'বাইশ', 23 => 'তেইশ',
            24 => 'চব্বিশ', 25 => 'পঁচিশ', 26 => 'ছাব্বিশ',
            27 => 'সাতাশ', 28 => 'আটাশ', 29 => 'ঊনত্রিশ',
            30 => 'ত্রিশ',
            31 => 'একত্রিশ', 32 => 'বত্রিশ', 33 => 'তেত্রিশ',
            34 => 'চৌত্রিশ', 35 => 'পঁয়ত্রিশ', 36 => 'ছত্রিশ',
            37 => 'সাঁইত্রিশ', 38 => 'আটত্রিশ', 39 => 'ঊনচল্লিশ',
            40 => 'চল্লিশ',
            41 => 'একচল্লিশ', 42 => 'বিয়াল্লিশ', 43 => 'তেতাল্লিশ',
            44 => 'চুয়াল্লিশ', 45 => 'পঁয়তাল্লিশ', 46 => 'ছেচল্লিশ',
            47 => 'সাতচল্লিশ', 48 => 'আটচল্লিশ',
            49 => 'ঊনপঞ্চাশ', 50 => 'পঞ্চাশ',
            51 => 'একান্ন', 52 => 'বায়ান্ন', 53 => 'তিপ্পান্ন',
            54 => 'চুয়ান্ন', 55 => 'পঞ্চান্ন', 56 => 'ছাপ্পান্ন',
            57 => 'সাতান্ন', 58 => 'আটান্ন', 59 => 'ঊনষাট',
            60 => 'ষাট',
            61 => 'একষট্টি', 62 => 'বাষট্টি', 63 => 'তেষট্টি',
            64 => 'চৌষট্টি', 65 => 'পঁয়ষট্টি', 66 => 'ছেষট্টি',
            67 => 'সাতষট্টি', 68 => 'আটষট্টি', 69 => 'ঊনসত্তর',
            70 => 'সত্তর',
            71 => 'একাত্তর', 72 => 'বাহাত্তর', 73 => 'তিয়াত্তর',
            74 => 'চুয়াত্তর', 75 => 'পঁচাত্তর', 76 => 'ছিয়াত্তর',
            77 => 'সাতাত্তর', 78 => 'আটাত্তর', 79 => 'ঊনআশি',
            80 => 'আশি',
            81 => 'একাশি', 82 => 'বিরাশি', 83 => 'তিরাশি',
            84 => 'চুরাশি', 85 => 'পঁচাশি', 86 => 'ছিয়াশি',
            87 => 'সাতাশি', 88 => 'আটাশি', 89 => 'ঊননব্বই',
            90 => 'নব্বই',
            91 => 'একানব্বই', 92 => 'বিরানব্বই', 93 => 'তিরানব্বই',
            94 => 'চুরানব্বই', 95 => 'পঁচানব্বই', 96 => 'ছিয়ানব্বই',
            97 => 'সাতানব্বই', 98 => 'আটানব্বই', 99 => 'নিরানব্বই',
            100 => 'একশ', 200 => 'দুইশ', 300 => 'তিনশ',
            400 => 'চারশ', 500 => 'পাঁচশ', 600 => 'ছয়শ',
            700 => 'সাতশ', 800 => 'আটশ', 900 => 'নয়শ',
            1000 => 'এক হাজার', 10000 => 'দশ হাজার',
            100000 => 'এক লক্ষ', 1000000 => 'দশ লক্ষ',
            10000000 => 'এক কোটি', 100000000 => 'দশ কোটি',
        ];

        if (isset($banglaDigits[$number])) {
            return $banglaDigits[$number];
        } elseif ($number >= 100 && $number <= 999) {
            $hundreds = intval($number / 100) * 100;
            $remainder = $number % 100;

            if ($remainder > 0) {
                return convertToBanglaWord($hundreds).' '.convertToBanglaWord($remainder);
            } else {
                return convertToBanglaWord($hundreds);
            }
        } elseif ($number > 1000 && $number <= 999999) {
            $thousands = intval($number / 1000);
            $remainder = $number % 1000;

            if ($remainder > 0) {
                return convertToBanglaWord($thousands).' হাজার'.' '.convertToBanglaWord($remainder);
            } else {
                return convertToBanglaWord($thousands).' হাজার';
            }
        } elseif ($number > 999999 && $number <= 99999999) {
            $lakhs = intval($number / 100000);
            $remainder = $number % 100000;

            if ($remainder > 0) {
                return convertToBanglaWord($lakhs).' লক্ষ'.' '.convertToBanglaWord($remainder);
            } else {
                return convertToBanglaWord($lakhs).' লক্ষ';
            }
        } elseif ($number > 99999999 && $number <= 9999999999) {
            $crores = intval($number / 10000000);
            $remainder = $number % 10000000;

            if ($remainder > 0) {
                return convertToBanglaWord($crores).' কোটি'.' '.convertToBanglaWord($remainder);
            } else {
                return convertToBanglaWord($crores).' কোটি';
            }
        } else {
            return $number; // Return the number as is if no conversion is defined
        }
    }
}
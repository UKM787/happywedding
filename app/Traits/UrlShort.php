<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait UrlShort {
    public function generateUniqueShortCode($lastShortCode){
        $letters1 = 'abcdefghijklmnopqrstuvwxyz';
        $letters2 = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        
        if (!$lastShortCode) {
        return 'hwa1aa';
        // return 'hw8uvr';
        // return 'hwz9zzz';
        }

        // Extract the individual parts of the last code
        $prefixPre = substr($lastShortCode, 0, -4);
        //dd($prefixPre);
        $prefix = substr($lastShortCode, -4, 1);
        $number = substr($lastShortCode, -3, 1);
        $letter1 = substr($lastShortCode, -2, 1);
        $letter2 = substr($lastShortCode, -1, 1);
        //dd($prefix, $number, $letter1, $letter2);
        // dd($prefix)
        // Check if we need to increment the number
        if($letter2 == 'z'){
            if($letter1 == 'z'){
                if($number == 9 || $prefix == 9 || $number == 'z' || $prefix == 'z'){
                    if($prefix == 'z' || $number == 'z'){
                        if($prefix == 9 && $number == 'z'){
                            $subpre = substr($prefixPre, -1);
                            if($prefixPre == 'hw'){
                                $prefixPre = 'hwa';
                            }elseif($subpre == 'z'){
                                $prefixPre .= 'a';
                            }else{
                                $sub =  substr($lastShortCode, -5, 1);
                                $sub++;
                                $prefixPre = substr_replace($prefixPre, $sub, -1);
                            }
                            $letter2 = 'a';
                            $letter1 = 'a';
                            $prefix = 'a';
                            $number = 1;
                        }elseif ($prefix == 'z' && $number == 9){
                            $prefix = 1;
                            $number = 'a';
                        }else{
                            if($prefix <= 9){
                                $prefix++;
                            }
                            if($number != 'z'){
                                $number++;
                            }
                        }   
                    }else{
                        $prefix++;
                        $letter2 = 'a';
                        $letter1 = 'a';
                        $number = 1;
                    }
                }else{
                    $number++;
                    $letter2 = 'a';
                    $letter1 = 'a';
                }
            }else{
                $letter1++;
                $letter2 = 'a';
            }
        }else{
            $letter2++;
        }
        return $prefixPre.$prefix . $number . $letter1 . $letter2;

    }

}

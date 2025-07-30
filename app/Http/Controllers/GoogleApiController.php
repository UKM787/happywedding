<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleApiController extends Controller
{

    public function putaddress(){
        return view('maps.getcordinates');
    }


   public function getcordinates(){

        if (isset($_POST['submit'])) {
            $add = urlencode($_POST['address']);
            $city = urlencode($_POST['city']);
            $state = urlencode($_POST['state']);
            $country = urlencode($_POST['country']);
            $zip = $_POST['zip'];
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $add . ',+' . $city . ',+' . $state . ',+' . $country . '&sensor=false');
            $output = json_decode($geocode); //Store values in variable

            print_r($output);

            if ($output->status == 'OK') { // Check if address is available or not

                echo "<div class=\"display_map_details\">";
                echo "<br/>";
                echo "Latitude : " . $lat = $output->results[0]->geometry->location->lat; //Returns Latitude
                echo "<br/>";
                echo "Longitude : " . $long = $output->results[0]->geometry->location->lng; // Returns Longitude
                echo "<br/>";
                echo "Address : " . $loc = $output->results[0]->formatted_address;
                echo "</div>";
            }
   }
}

}
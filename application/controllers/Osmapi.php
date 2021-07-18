<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Osmapi extends CI_Controller {


public function index(){
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://nominatim.openstreetmap.org/search/sanur?format=json&polygon=1&polygon_geojson=1&limit=1");

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // tutup curl
    curl_close($ch);

    // menampilkan hasil curl
    echo $output;

    // $url = "http://nominatim.openstreetmap.org/search/Piazza%20Duomo%20Trento?format=json&addressdetails=1&limit=1&polygon_svg=1";
// $html = file_get_contents($url);
// $jsonout = json_decode($html);
// print_r($jsonout[0]);


}

}

?>

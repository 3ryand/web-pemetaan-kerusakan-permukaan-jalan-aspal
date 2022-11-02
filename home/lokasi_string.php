<?php
include 'database.php';
    $query = mysqli_query($con,"select * from gambar_data");
    while ($data = mysqli_fetch_array($query))
    {
        $id_gambar = $data['id'];
        $file = $data['nama_gambar'];
        $lokasi = explode(",", $data['lokasi']);
        $lat = $lokasi[0];
        $lon = $lokasi[1];
        if (!empty($lat)){
            $response = get_web_page("https://api.geoapify.com/v1/geocode/reverse?lat=".$lat[0]."&lon=".$lon[1]."&apiKey=fa093c4bcca34c4ca537f192f33232cc");
            $resArr = array();
            $resArr = json_decode($response);
            $lokasistring = ($resArr->features[0]->properties->road).", ".($resArr->features[0]->properties->formatted);
            echo $lat,$lon.'\n';
            //$sql = "UPDATE gambar_data SET lokasi_string = '$lokasistring' WHERE id = '$id_gambar'";
            //$hasil = mysqli_query($con, $sql);
            //echo $file.', '.$hasil;
        }
    }
    function get_web_page($url) {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ); 
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content  = curl_exec($ch);
        curl_close($ch);
        return $content;
    }
?>
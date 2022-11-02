<?php
    $koor = "-7.634158,111.529033";
    $koorsplit = explode(",", $koor);
    //$response = get_web_page("http://api.positionstack.com/v1/reverse?access_key=ec202e18fb385ea88c736cc48bc79c05&query=".$koor);
    $response = get_web_page("https://api.geoapify.com/v1/geocode/reverse?lat=".$koorsplit[0]."&lon=".$koorsplit[1]."&apiKey=fa093c4bcca34c4ca537f192f33232cc");
    $resArr = array();
    $resArr = json_decode($response);
    //echo ($resArr->data[0]->label);
    //echo "<br>";
    //echo print_r($resArr->data[0]);
    //echo "<br>";
    echo "<pre>"; print_r($resArr); echo "</pre>";
    echo "<br>";
    echo ($resArr->features[0]->properties->road).", ".($resArr->features[0]->properties->formatted);
    
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
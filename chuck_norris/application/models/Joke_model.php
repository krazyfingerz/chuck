<?php

class Joke_model extends Base_model
{

    function __construct()
    {
        parent::__construct();

        $this->host_2 = "http://api.icndb.com/jokes/";

    }

    function joke()
    {

        // url endpoint is random
        $url = "random";

        // run the link.
        $res = $this->api_query_2($url, array());
        // take out the data from the response.
        $formatted = array(
            'joke' => $res['value']['joke']
        );

        // return response to function.
        return $formatted;

    }
    

    // query out the endpoint data.
    function api_query_2($url, $param)
    {
        $url = $this->host_2 . $url;
        $ch = curl_init($url);



        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: text/plain",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($ch);

        if ($res) {
            // if got response, return response.
            $res = json_decode($res, true);
            return $res;
        } else {
            return false;
        }
    }
}

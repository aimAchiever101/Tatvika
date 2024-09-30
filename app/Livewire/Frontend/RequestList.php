<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class RequestList extends Component
{
    public $result;

    public function mount()
    {
        $API_KEY="test_4f01a3897b975cb155caffbd459";
        $API_AUTH_TOKEN="test_50048e65f549e74220ff3969bb7";
        $API_SALT="50b96f2f863044f89662de4d10608541";
        $API_WEBSITE="test.instamojo.com";

    
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://$API_WEBSITE/api/1.1/payment-requests/");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key: $API_KEY",
                  "X-Auth-Token: $API_AUTH_TOKEN"));

$response = curl_exec($ch);
curl_close($ch); 

$result = json_decode($response,true);
$this->result =$result;
// echo $response;
dd($result);


    }



    public function render()
    {
        return view('livewire.frontend.request-list');
    }


}

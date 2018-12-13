<?php
require_once('./vendor/autoload.php');


//Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token ='mgfm1Bp+N7dJOqZP59o2t3n42y9hZ/S/gpbP4/XPSUFFRCsyiHwdxiyOQBoiBjPmKBC+hgF1X+6axLs88EHCpPSsqp4o+iv8qVameG09UuF1mEFmE118ZuNNXIJvLR25+BwC6RRTtUHwqR9fyPRIPgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '608522996c2e2cb13d29b6a1dd1cb09f';

//Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if(!is_null($events['events'])){
    //Loop through each event
    foreach($events['events']as $event){
        //Line API send a lot of event type , we interested un message only.
        if($event['type']=='message'){

             //Get replyToken
             $replyToken=$event['replyToken'];
             $userId = $event['source']['userId'];
             
             

            switch($event['message']['type']){

                case 'text':
                    //Reply message
                    // $respMessage='Hello, your message is ' .$event['message']['text'];
                    $respMessage='Hello, send by you ID';
                   
                break;

            }
            $httpClient=new CurlHTTPClient($channel_token);
            $bot=new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            $textMessageBuilder=new TextMessageBuilder($respMessage);
            $response=$bot->pushMessage('U26068722829d8ddbf7acf39a1fe1df3d',$textMessageBuilder);
        }
    }
}

echo "OK";



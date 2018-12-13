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
                    $respMessage='Hello, your UserID is ' .$event['source']['userId'];

                   
                break;

                case 'image':
                    //Reply image
                    $messageID=$event['message']['id'];
                    $respMessage='Hello, your image ID is ' .$messageID;
                break;
               

                case 'sticker':
                    //Reply sticker
                    $messageID=$event['message']['packageId'];
                    $respMessage='Hello, your Sticker Package ID is ' .$messageID;
                 break;
                 
                 case 'video':
                    //Reply video
                    $messageID=$event['message']['id'];

                    // // Create Video file on server
                    // $fileID = $event['message']['id'];
                    // $response=$bot -> getMessageContent($fileID);
                    // $fileName='linebot.mp4';
                    // $file=fopen($fileName, 'w');
                    // fwrite($file, $response->getRawBody());

                    $respMessage='Hello, your Video ID is ' .$messageID;
                break;
            
                case 'audio':
                    //Reply audio
                    $messageID=$event['message']['id'];

                    // // Create Video file on server
                    // $fileID = $event['message']['id'];
                    // $response=$bot -> getMessageContent($fileID);
                    // $fileName='linebot.m4a';
                    // $file=fopen($fileName, 'w');
                    // fwrite($file, $response->getRawBody());

                    $respMessage='Hello, your Audio ID is ' .$messageID;
                break;

                case 'location':
                    //Reply location
                    $messageID=$event['message']['addresss'];

                    $respMessage='Hello, your Location is ' .$messageID;
                break;

                 default:
                     $respMessage='Please send text, image,sticker ,video ,audio , Location only';
                 break;



            }
            $httpClient=new CurlHTTPClient($channel_token);
            $bot=new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            $textMessageBuilder=new TextMessageBuilder($respMessage);
            $response=$bot->replyMessage($replyToken,$textMessageBuilder);
        }
    }
}

echo "OK";



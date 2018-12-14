<?php
require_once('./vendor/autoload.php');


//Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

//Token
$channel_token ='mgfm1Bp+N7dJOqZP59o2t3n42y9hZ/S/gpbP4/XPSUFFRCsyiHwdxiyOQBoiBjPmKBC+hgF1X+6axLs88EHCpPSsqp4o+iv8qVameG09UuF1mEFmE118ZuNNXIJvLR25+BwC6RRTtUHwqR9fyPRIPgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '608522996c2e2cb13d29b6a1dd1cb09f';

//Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if(!is_null($events['events'])){
    //Loop through each event
    foreach($events['events']as $event){
       
             //Get replyToken
             $replyToken=$event['replyToken'];
             $ask = $event['message']['text'];
             
            switch(strtolower($ask)){

                case 'm':
                    $respMessage='What sup man.Go away!';                                      
                break;
                
                case 'f':
                    $respMessage='Love you lady.';                                      
                break;
            
                default:
                    $respMessage='What is you sex? M or F';                                      
                break;
            }

            $httpClient=new CurlHTTPClient($channel_token);
            $bot=new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            
            $textMessageBuilder=new TextMessageBuilder($respMessage);
            $response=$bot->replyMessage($replyToken,$textMessageBuilder);
            
        
    }
}

echo "OK";



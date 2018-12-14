<?php
require_once('./vendor/autoload.php');


//Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
// use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

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
            
             //Image
            //  $originalContentUrl = 'https://cdn.shopify.com/assets2/online-store/online_your-business-managed-small-07e0eaa8ce99bdfca24cdc84ef617ca9f15d287dd91999b6d203bc7e28af475c.jpg';
            //  $previewImageUrl = 'https://cdn.shopify.com/assets2/online-store/online_your-business-managed-small-07e0eaa8ce99bdfca24cdc84ef617ca9f15d287dd91999b6d203bc7e28af475c.jpg';
             
            $originalContentUrl = 'https://select2web-autobot1.herokuapp.com/picv.jpeg';
            $previewImageUrl = 'https://select2web-autobot1.herokuapp.com/picv.jpeg';
              


            $httpClient=new CurlHTTPClient($channel_token);
            $bot=new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            
            $textMessageBuilder=new ImageMessageBuilder($originalContentUrl,$previewImageUrl);
            $response=$bot->replyMessage($replyToken,$textMessageBuilder);
            
        
    }
}

echo "OK";



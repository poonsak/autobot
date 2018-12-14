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
    
        //Line API send a lot of event type , we interested un message only.
        if($event['type']=='message' && $event['message']['type']=='text'){

             //Get replyToken
             $replyToken=$event['replyToken'];
            //  $userId = $event['source']['userId'];
             
            //Split message then keep it in database.
            $appointments = explode(',',$event['message']['text']);

            if(count($appointments)==2){
                $host='ec2-54-83-197-230.compute-1.amazonaws.com';
                $dbname='dbujg2s2tqvhqf';
                $user='egksxrkouiprpf';
                $pass='d83d5caf218a9961c028cb9a47496c849e2479edd7003182916529828647da3a';
                $connection=new PDO("pgsql:host=$host;dbname=$dbname",$user , $pass);

                $params = array(
                    'time' => $appointments[0],
                    'content' => $appointments[1],
                );

                $statement=$connection->prepare("INSERT INTO appointment (time,content) VALUES(:time,:content)");
                
                $result=$statement->execute($params);

                $respMessage='You appointment has saved.';
            }else{
                $respMessage='You can send appointment like this "12.00,House Keeping."';
            }


            $httpClient=new CurlHTTPClient($channel_token);
            $bot=new LINEBot($httpClient, array('channelSecret' => $channel_secret));

            $textMessageBuilder=new TextMessageBuilder($respMessage);
            $response=$bot->replyMessage($replyToken,$textMessageBuilder);
        }
    }
}

echo "OK";


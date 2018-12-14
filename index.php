<?php

                $host='ec2-54-83-197-230.compute-1.amazonaws.com';
                $dbname='dbujg2s2tqvhqf';
                $user='egksxrkouiprpf';
                $pass='d83d5caf218a9961c028cb9a47496c849e2479edd7003182916529828647da3a';
                $connection=new PDO("pgsql:host=$host;dbname=$dbname",$user , $pass);

                   
                $result=$connection->query("SELECT * FROM polls");
            if($result != null){
                echo $result->rowCount();
            }


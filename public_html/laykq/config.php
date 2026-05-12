<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn=mysql_connect("localhost","xoso","jGsCpNTfdjpBzwnj") or die("cannot connect");;
mysql_select_db("xosov2",$conn) or die("cannot select DB");
mysql_set_charset('utf8',$conn);
mysql_query("set names 'utf8'");

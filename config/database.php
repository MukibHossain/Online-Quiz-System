<?php


if(
session_status()
!== PHP_SESSION_ACTIVE
){

session_start();

}



$conn=

new mysqli(

"localhost",
"root",
"",
"online_quiz_system"

);



if(
$conn->connect_error
){

die(
"Database Connection Failed"
);

}
<?php
// connect to database
$conn = new mysqli("localhost","root","","test");

if ($conn->connect_error){
    die("DB Connection failed ".$conn->connect_error);
}
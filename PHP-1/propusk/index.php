<?php
session_start();
include('view/v_index.php');
$dt = date("d.m.y");
echo $dt;
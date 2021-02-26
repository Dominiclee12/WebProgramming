<?php
//------------logout----------------------------

/* value set for later verification use e.g: update personal information */
$user="";			
if(isset($_SESSION['username'])){
    $user=$_SESSION['username'];
}
?>
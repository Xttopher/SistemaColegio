<?php
session_start();
if($_GET['s']==1)
{
    session_destroy();
    header('location:index.php');
}
?>
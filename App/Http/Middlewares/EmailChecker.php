<?php

if (! isset($_SESSION['email'])){

    header("Location:layouts/errors/notfound.php");
}
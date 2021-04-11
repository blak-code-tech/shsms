<?php
    //creating the connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //check for errors
    if(mysqli_connect_errno()){
        die('<div class=alert alert-warning>
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	Connection failed</div>');
    }
?>
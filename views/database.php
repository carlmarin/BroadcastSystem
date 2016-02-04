<?php

        $serverName = 'kwpozef8zb.database.windows.net';
        $user = 'TOD';
        $pass = 'AbadSantos17@';
        $database = 'BroadcastSystemDB';
        $connection_string = "DRIVER={SQL Server};SERVER=$serverName;DATABASE=$database";
        $conn = odbc_connect($connection_string, $user, $pass);

?>


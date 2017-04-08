<?php
$serverName = "Gerry_win81";
$serverName = "tcp:192.168.56.1,1433";

$connectionInfo = array(
    "Database" => "Test_01",
    "Uid" => "sa",
    "PWD" => "sqlmetodo"
);


//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn)
    die(FormatErrors(sqlsrv_errors()));

//Select Query
//$tsql= "SELECT * FROM TabZone";
$tsql= "SELECT @@Version as SQL_VERSION";

//Executes the query
$getResults= sqlsrv_query($conn, $tsql);

//Error handling 
if ($getResults == FALSE)
    die(FormatErrors(sqlsrv_errors()));
?> 

<h1> Results : </h1>

<?php
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['SQL_VERSION']);
    echo ("<br/>");
}

sqlsrv_free_stmt($getResults);
function FormatErrors( $errors )  
{  
    /* Display errors. */  
    echo "Error information: <br/>";  
  
    foreach ( $errors as $error ) {  
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";  
        echo "Code: ".$error['code']."<br/>";  
        echo "Message: ".$error['message']."<br/>";  
    }  
}  
?>
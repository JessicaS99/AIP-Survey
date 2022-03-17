

<?php

if (isset($_POST['export'])){
/* vars for export */
// database record to be exported
$db_record = 'seite1';
$db_record2 = 'seite2';
// optional where query
//$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = "survey".'_'.date('Y-m-d').'.csv';

// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "survey";


$conn = mysqli_connect($hostname, $user, $password, $database);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// create empty variable to be filled with export data
$csv_export = '';

// query to get data from database
$query = mysqli_query($conn, "SELECT * FROM ".$db_record." ");
$field = mysqli_field_count($conn);

// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
}

// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';

// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
    }
    $csv_export.= '
';
}
$csv_export2 = '';

// query to get data from database
$query2 = mysqli_query($conn, "SELECT * FROM ".$db_record2." ");
$field2 = mysqli_field_count($conn);

// create line with field names
for($i = 0; $i < $field2; $i++) {
    $csv_export2.= mysqli_fetch_field_direct($query2, $i)->name.';';
}

// newline (seems to work both on Linux & Windows servers)
$csv_export2.= '
';

// loop through database query and fill export variable
while($row2 = mysqli_fetch_array($query2)) {
    // create line with field values
    for($i = 0; $i < $field2; $i++) {
        $csv_export2.= '"'.$row2[mysqli_fetch_field_direct($query2, $i)->name].'";';
    }
    $csv_export2.= '
';
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo("Seite1\n".$csv_export."\n\n"."Seite2\n".$csv_export2);

}
/*
if(isset($_POST['export']))
{
    $conn = new mysqli('localhost', 'root', '');  
    mysqli_select_db($conn, 'survey');  
    $sql = "SELECT `user`,`datum`,`q1`,`q2`,`q3`,`q4`,`q5` FROM `seite1`";  
    $setRec = mysqli_query($conn, $sql);  
    $columnHeader = '';  
    $columnHeader = "User" . "\t" . "Datum" . "\t" . "Q1" . "\t" . "Q2" . "\t" . "Q3" . "\t" . "Q4" . "\t" . "Q5" . "\t";  
    $setData = '';  
      while ($rec = mysqli_fetch_row($setRec)) {  
        $rowData = '';  
        foreach ($rec as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;  
        }  
        $setData .= trim($rowData) . "\n";  
    }  
    $sql2 = "SELECT `user`,`datum`,`q6`,`q7`,`q8`,`q9`,`q10` FROM `seite2`";  
    $setRec2 = mysqli_query($conn, $sql2);  
    $columnHeader2 = '';  
    $columnHeader2 = "User" . "\t" . "Datum" . "\t" . "Q6" . "\t" . "Q7" . "\t" . "Q8" . "\t" . "Q9" . "\t" . "Q10" . "\t";  
    $setData2 = '';  
      while ($rec2 = mysqli_fetch_row($setRec2)) {  
        $rowData2 = '';  
        foreach ($rec2 as $value2) {  
            $value2 = '"' . $value2 . '"' . "\t";  
            $rowData2 .= $value2;  
        }  
        $setData2 .= trim($rowData2) . "\n";  
    }   
    header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=survey.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
   
      echo ucwords("Seite1"."\n" .$columnHeader . "\n" . $setData . "\n\n"."Seite2"."\n" .$columnHeader2 . "\n" . $setData2 . "\n");  
}*/
     ?> 



<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst");

$result  = pg_query($dbconn, "SELECT * FROM students");

$students = array();

while ($row = pg_fetch_row($result)) {
        $students[] = array("firstname" => $row[0], "lastname" => $row[1], "id" => $row[2]);
}

echo json_encode($students);

?>

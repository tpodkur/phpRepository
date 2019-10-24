<?php

include 'Connect.php';
include 'Query.php';

$studentsConnection = new Connection("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst");
$bdconn = $studentsConnection->getConnect();

$query  = new Query($bdconn, "SELECT * FROM students");
$result = $query->perform();

$students = array();

while ($row = pg_fetch_row($result)) {
        $students[] = array("firstname" => $row[0], "lastname" => $row[1], "id" => $row[2]);
}

echo json_encode($students);

?>
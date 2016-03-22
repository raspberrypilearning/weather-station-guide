<?php
$con=mysqli_connect("localhost","root","raspberry","weather");
$select_all_template = "SELECT *, DATE(CREATED) AS DATE, TIME(CREATED) AS TIME FROM WEATHER_MEASUREMENT;";
$select_from_to_template = "SELECT *, DATE(CREATED) AS DATE, TIME(CREATED) AS TIME FROM WEATHER_MEASUREMENT WHERE CREATED >= %s AND CREATED <= %s;";
$select = "";

$time_from = $_GET["from"];
$time_to = $_GET["to"];

if (empty($time_from) && empty($time_to)) { // Select all
    $select = $select_all_template;
}
else { // Select from to
    $select = sprintf($select_from_to_template, empty($time_from) ? "FROM_UNIXTIME(0)" : $time_from, empty($time_to) ? "NOW()" : $time_to);
}

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, $select);
$headers = array();
while ($property = mysqli_fetch_field($result)) {
    $headers[] = $property->name;
}

$fp = fopen("php://output", "w");
ob_start();

// Double quotes should enclose headers to avoid Microsoft Excel complaining a lot when you load the CSV
// Annoyingly can't use: fputcsv($fp, $headers) for this. Any double quotes are double escaped as """"
// So manually write out the headers below.

$count = count($headers);

for ($i = 0; $i < $count; $i++) {
    fwrite($fp, "\"");
    fwrite($fp, $headers[$i]);
    fwrite($fp, "\"");
    if ($i < ($count - 1)) {
         fwrite($fp, ",");
    }
}

fwrite($fp, "\r");

while ($row = $result->fetch_array(MYSQLI_NUM)) {
    fputcsv($fp, array_values($row));
}

$string = ob_get_clean();
$filename = "weather_csv_" . date("Ymd") . "_" . date("His");

header("Pragma: public");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename.csv\";" );
header("Content-Transfer-Encoding: binary");

mysqli_close($con);
exit($string);
?>

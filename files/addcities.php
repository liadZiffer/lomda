<body dir="rtl">
<?php
header('Content-Type: text/html; charset=UTF-8');  

include_once '../DB/dbconnect.php';

$db=new dbconnect();

$url = 'israel-cities.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed



foreach ($characters as $value)
{
echo $value->semel_yeshuv."<br>";
echo $value->name."<br>";
echo $value->english_name."<br>";
echo $value->semel_napa."<br>";
echo $value->shem_napa."<br>";
echo $value->semel_lishkat_mana."<br>";
echo $value->lishka."<br>";
echo $value->semel_moatza_ezorit."<br>";
echo $value->shem_moaatza."<br>";

if($db->InsertCity($value->semel_yeshuv, $value->name, $value->english_name, $value->semel_napa, $value->shem_napa, $value->semel_lishkat_mana, $value->lishka, $value->semel_moatza_ezorit,$value->shem_moaatza))
{
    echo "Added<br>";
}

echo "<br>";
}
?>
</body>
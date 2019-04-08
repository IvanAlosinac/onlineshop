<?php
error_reporting(E_ERROR);
ini_set("display_errors",1);

$value =array($_POST["b1"],$_POST["b2"],$_POST["b3"],$_POST["b4"],$_POST["b5"]); 

foreach($value as $value):
$cijena1 = 6;
$cijena2 = 5;
$cijena3 = 4;

if($value<=19){
    $rezultat=$cijena1*$value;   
}else if($value>19 && $value<100){
    $rezultat=$cijena2*$value;    
}else if($value>=100){
    $rezultat=$cijena3*$value;   
}
$pieces = explode(" ", $rezultat);
echo $pieces[0];
echo "<pre>";
echo $pieces[1]; 
echo "</pre>";
echo "<pre>";
echo $pieces[2]; 
echo "</pre>";
echo "<pre>";
echo $pieces[3]; 
echo "</pre>";
echo "<pre>";
echo $pieces[4]; 
echo "</pre>";
$naruceno1 = $pieces[0]+;
endforeach;
echo $_POST["b1"];
echo $_POST["b2"];
echo $_POST["b3"];
echo $_POST["b4"];
echo $_POST["b5"];
 
?>

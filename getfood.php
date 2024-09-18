<?php 
require 'dbconnect.php';

class FOOD
{
    public $idfood;
    public $namefood;
    public $pricefood;
    public $description;
    public $imgfood;
    
    function __construct($idfood, $namefood, $pricefood, $description, $imgfood)
    {
        $this->idfood = $idfood; 
        $this->namefood = $namefood;
        $this->pricefood = $pricefood; 
        $this->description = $description;
        $this->imgfood = $imgfood; 
    }
}
$querydata = mysqli_query($connect, 'select * from food');
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new FOOD($row['IDFOOD'],$row['NAMEFOOD'],$row['PRICEFOOD'],$row['DESCRIPTION'],$row['IMGFOOD'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
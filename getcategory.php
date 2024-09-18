<?php 
require 'dbconnect.php';

class CATEGORYFILM
{
    public $idcategory;
    public $namecategory;
    public $imgcategory;
    
    function __construct($idcategory, $namecategory, $imgcategory)
    {
        $this->idcategory = $idcategory; 
        $this->namecategory = $namecategory;
        $this->imgcategory = $imgcategory;
    }
}
$querydata = mysqli_query($connect, 'select * from category_film');
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new CATEGORYFILM($row['IDCategory'],$row['NameCategory'],$row['IMGCategory'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
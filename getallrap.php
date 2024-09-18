<?php
require 'dbconnect.php';

class ALLRAP{
    public $idrap;
    public $namerap;
    public $phone;
    public $adress;
    function __construct($idrap, $namerap, $adress, $phone){
        $this->idrap=$idrap;
        $this->namerap=$namerap;
        $this->adress=$adress;
        $this->phone=$phone;
    }
}
$querydata = mysqli_query($connect, 'select * from all_rap');
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new ALLRAP($row['IDRAP'],$row['TENRAP'],$row['DIACHI'], $row['PHONE'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
<?php 
require 'dbconnect.php';
$iduser = isset($_POST['iduser']) ? $_POST['iduser'] : null;
if($iduser){
    $query = "select *from don_hang where iduser  ='$iduser'";
}else{
    $query = "select * from don_hang";
}
class HISTORY
{
    public $iddonhang;
    public $idphim;
    public $iduser;
    public $timestartwatching;
    public $dateview;
    public $namerap;
    public $namefilm;
    public $name;
    public $email;
    public $seats;
    public $combofood;
    public $totalmoney;

    function __construct($iddonhang, $idphim, $iduser, $timestartwatching, $dateview,$namerap, $namefilm, $name, $email, $seats, $combofood, $totalmoney)
    {
        $this->iddonhang = $iddonhang; 
        $this->idphim = $idphim;
        $this->iduser = $iduser; 
        $this->timestartwatching = $timestartwatching;
        $this->dateview = $dateview; 
        $this->namerap = $namerap; 
        $this->namefilm = $namefilm; 
        $this->name = $name; 
        $this->email = $email; 
        $this->seats = $seats; 
        $this->combofood = $combofood; 
        $this->totalmoney = $totalmoney;  
    }
}
$querydata = mysqli_query($connect, $query);
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    $seats = str_replace(['[', ']', '"'], '', $row['SEATS']);
    array_push($arraylist, new HISTORY($row['IDDONHANG'],$row['IDPHIM'],$row['IDUSER'],$row['TIMESTARTWATCHING'],$row['DATEVIEW'],$row['NAMERAP'],$row['NAMEFILM'],$row['NAME'],$row['EMAIL'],$seats,$row['COMBOFOOD'],$row['TOTALMONEY'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
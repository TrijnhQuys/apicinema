<?php 
require 'dbconnect.php';

class SLIDE_HOME
{
    public $id;
    public $imgslide;
    
    function __construct($id, $imgslide)
    {
        $this->id = $id; 
        $this->imgslide = $imgslide;
    }
}
$querydata = mysqli_query($connect, 'select * from slide_home');
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new SLIDE_HOME($row['ID'],$row['IMGSLIDE'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
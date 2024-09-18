<?php 
require 'dbconnect.php';
$matheloai = isset($_POST['matheloai']) ? $_POST['matheloai'] : null;
// Lấy ngày hiện tại
// $ngayhientai = date('Y-m-d');
$ngayhientai = '2024-05-10';
if($matheloai){
    $query = "select *from all_film where idcategory  ='$matheloai' && '$ngayhientai'<endshowtime";
}else{
    $query = "select * from all_film";
}
class ALLFILM
{
    public $id;
    public $title;
    public $price;
    public $description;
    public $images;
    public $category;
    public $idcategory;
    public $actor;
    public $director;
    public $producer;
    public $nation;
    public $showtime;
    public $endshowtime;
    public $duration;
    public $videotrailer;
    
    function __construct($id, $title, $price, $description, $images, $category, $idcategory, $actor, $director, $producer, $nation, $showtime,$endshowtime, $duration, $videotrailer)
    {
        $this->id = $id; 
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->images = $images;
        $this->category = $category;
        $this->idcategory = $idcategory;
        $this->actor = $actor;
        $this->director = $director;
        $this->producer = $producer;
        $this->nation = $nation;
        $this->showtime = $showtime;
        $this->endshowtime = $endshowtime;
        $this->duration = $duration;
        $this->videotrailer=$videotrailer;
    }
}
$querydata = mysqli_query($connect, $query);
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new ALLFILM($row['ID'],$row['Title'],$row['Price'],$row['Description'],$row['Images'],$row['Category'],$row['idcategory'],$row['Actor'],$row['Director'],$row['Producer'],$row['Nation'],$row['ShowTime'],$row['EndShowTime'],$row['Duration'], $row['VideoTrailer']));
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
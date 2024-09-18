<?php 
require 'dbconnect.php';

$idnew = $_POST['idnew'];
// $idnew=1;
if(isset($idnew)){
    $query = "select *from all_news where idcatenew  ='$idnew'";
}else{
    $query = "select * from all_news";
}
class NEWS
{
    public $id;
    public $title;
    public $summary;
    public $content;
    public $images;
    public $idcatenew;
    
    function __construct($id, $title, $summary, $content, $images, $idcatenew)
    {
        $this->id = $id; 
        $this->title = $title;
        $this->summary = $summary;
        $this->content = $content; 
        $this->images = $images;
        $this->idcatenew = $idcatenew;
    }
}
$querydata = mysqli_query($connect, $query);
$arraylist = array();
while($row = mysqli_fetch_assoc($querydata)){
    array_push($arraylist, new NEWS($row['ID'],$row['Title'],$row['Summary'],$row['Content'],$row['Images'],$row['IDCateNew'])
);
} 
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arraylist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($connect);
?>
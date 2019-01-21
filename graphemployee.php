<?php
session_start();
// Cek Login Apakah Sudah Login atau Belum
if (!isset($_SESSION['ID'])){
  header("location: index.php");
}

$submit_id = $_GET['id'];
require_once 'app/init.php';

$itemsQuery = $db->prepare("
  SELECT name, progress
  FROM items
  WHERE user = :user AND delete_status='0'
");

$itemsQuery->execute([
  'user' => $submit_id
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

$itemsdata = array();
foreach($items as $item){
   $itemsdata[] = array('label'=>$item['name'], 'y'=>$item['progress']);
}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>VIO To Do List Graph | Dashboard</title>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title: {
    text: "VIO To Do List"
  },
  axisY: {
    maximum: 100,
    title: "Persentase Selesai",
    suffix: "%",
    scaleBreaks: {
      autoCalculate: true
    }
  },
  data: [{
    type: "column",
    yValueFormatString: "#,##0\"%\"",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($itemsdata, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

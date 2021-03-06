<?php
session_start();
// Cek Login Apakah Sudah Login atau Belum
if (!isset($_SESSION['ID'])){
  header("location: index.php");
}

$submit_id = $_GET['id'];
require_once 'app/init.php';

$itemsQuery = $db->prepare("
  SELECT id, project, progress
  FROM items
  WHERE user = :user AND delete_status='0' AND parentchild='0'
");

$itemsQuery->execute([
  'user' => $submit_id
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

$itemsdata = array();
foreach($items as $item){
   $itemsdata[] = array('label'=>$item['project'], 'y'=>$item['progress'], 'id'=>$item['id'],);
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
    text: "VIO Project"
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
    click: onClick,
    yValueFormatString: "#,##0\"%\"",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($itemsdata, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
function onClick(e) {
  window.open("graphemployeedetail.php?id=<?php echo $submit_id; ?>" + "&idpro=" + e.dataPoint.id ,"_self");
}
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>


<?php
//composer require dompdf/dompdf // (past this in the terminal to download DomPDF library)
include 'includes/db.php';
$time_zone = date_default_timezone_set("Asia/Dhaka");
$date = $_POST['date'];
$today = date('Y-m-d');
$query = "SELECT * FROM buggy WHERE e_date = '$date'";
$select = mysqli_query($conn, $query);

$output = "
<style>
    table{
        border-collapse: collapse;
        width: 100%;
        color: #666;
    }
    td, th {
        border: 1px solid #666;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even){
        background-color: #dddddd;
    }
    h2{
        text-align: center;
        color: #666;
    }
    h5{
        text-align: center;
        color: #aaa;
    }
</style>
<h2>Buggy Request - <small>".date('d M Y', strtotime($date))."</small></h2>
    <table>
    <thead>
        <tr>
            <th>Villa</th>
            <th>Guest Name</th>
            <th>From</th>
            <th>Requested</th>
            <th>Done at</th>
            <th>Duration</th>
            <th>Done by</th>
        </tr>
    </thead>
    <tbody> ";
    while ($row = mysqli_fetch_assoc($select)) {

   $output .= "<tr>
    <td>".$row['villa']."</td>
    <td>".$row['name']."</td>
    <td>".$row['r_from']."</td>
    <td>".date('H:i', strtotime($row['rtime']))."</td>
    <td>".date('H:i', strtotime($row['dtime']))."</td>
    <td>".$row['duration']." Mins</td>
    <td>".$row['done_by']."</td>
    </tr>";
    }
$output .= "</tbody>
            </table>
            <br>
            <hr>
            <h5>Report generated on ". date('d M Y  H:i'). "</h5>";
   
require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);


$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "portrait");


// $html = file_get_contents("template.html");

$dompdf ->loadHtml($output);
// $dompdf->loadHtmlFile("template.html");

$dompdf ->render();

$dompdf->addInfo("Title" , "Buggy Request Report");
$dompdf->addInfo("Author" , "Ahmed Areef");

$dompdf ->stream("report.pdf" , ["Attachment" => 0]);

?>


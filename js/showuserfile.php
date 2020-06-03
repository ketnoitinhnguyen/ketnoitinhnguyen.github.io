<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "test");
$results_per_page = 10; // number of results per page
if (isset($_GET['page'])) { $page  = $_GET['page']; } else { $page = 1; } 
$start_from = ($page-1) * 10; 
$username = $_SESSION['username'];
$sql = "SELECT id, documentname, grade, subject, fileNameNewSave, fileActualExt FROM tailieu where username = '$username' 
          LIMIT $start_from, ".$results_per_page;

$result = $conn->query($sql); 
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if (mysqli_num_rows($result) > 0) {
// output data of each row
echo "<table>
      <tr>
        <th>Mã tài liệu</th>
        <th>Tên tài liệu</th>
        <th>Lớp</th>
        <th>Môn</th>
        <th>Loại file</th>
        <th>Tải tài liệu</th>
      </tr>";
 while($row = $result->fetch_assoc()) {
    if ($row["grade"] == 'lop8') {$row["grade"] = 'Lớp 8';}
    if ($row["grade"] == 'lop9') {$row["grade"] = 'Lớp 9';}
    if ($row["grade"] == 'lop10') {$row["grade"] = 'Lớp 10';}
    if ($row["grade"] == 'lop11') {$row["grade"] = 'Lớp 11';}
    if ($row["grade"] == 'lop12') {$row["grade"] = 'Lớp 12';}
    if ($row["subject"] == 'toan') {$row["subject"] = 'Toán';}
    if ($row["subject"] == 'ly') {$row["subject"] = 'Lý';}
    if ($row["subject"] == 'hoa') {$row["subject"] = 'Hóa';}
    if ($row["subject"] == 'av') {$row["subject"] = 'Anh Văn';}
    echo "
      <tr>
        <td> ". $row["id"] . "</td>
        <td> ". $row["documentname"] . "</td>
        <td> ". $row["grade"]. "</td>
        <td> ". $row["subject"]. "</td>
        <td> ".$row["fileActualExt"]."</td>
        <td> <a href = './uploads/".$row["fileNameNewSave"]."'><button class = 'button_download'>Tải về</button></a> </td>
      </tr>"; 
    }
echo "</table>";
} else { echo "0 results"; }

$sql1 = "SELECT SUM(username = '$username') AS total FROM tailieu";
$result = $conn->query($sql1) or die($conn->error);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<button class = 'button'><a href='user.html?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a></button> "; 
}; 
$_SESSION["totaldocuments"] = $row["total"];
$conn->close();
?>
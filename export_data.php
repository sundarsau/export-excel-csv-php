<?php
include 'cfg/dbconnect.php';
$sql = "SELECT *  FROM users order by name";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_POST['export_csv'])){
    // download csv
    $filename = "users.csv";
    $fp = fopen('php://output','w');
    $header_line = array("ID","Name","Email","Age","Gender");
    fputcsv($fp, $header_line);
    while($row = $result->fetch_assoc()){
        $line = array($row['id'], $row['name'], $row['email'], $row['age'], $row['gender']);
        fputcsv($fp, $line);
    }
    fclose($fp);
    header('Content-type:application/csv');
    header('Content-disposition:attachment;filename="'. $filename.'"');

}

if (isset($_POST['export_xls'])) {
    
    $filename = "users.xls";
    $output = '<table border = "1">';
    $output .= '<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Gender</th>
			    </tr>';
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td> 
                    <td>'.$row['email'].'</td>
                    <td>'.$row['age'].'</td>
                    <td>'.$row['gender'].'</td></tr>';
    }           
    $output .= '</table>';
    echo $output;
    header('Content-type:application/xls');
    header('Content-disposition:attachment;filename="' . $filename . '"');
}
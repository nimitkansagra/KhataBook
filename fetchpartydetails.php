<?php
    require_once "config.php";
    if (isset($_GET['query'])) {

        $query = "SELECT * FROM party WHERE name LIKE '{$_GET['query']}%' LIMIT 25";
        $result = mysqli_query($conn, $query);
        //$output = '<ul class="list-unstyled">';
        $res = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                //$output .= '<li>'.$row['id'].'<br>'.$row['name'].'<br>'.$row['email'].'<br>'.$row['address'].'</li>';
                $data['id'] = $row['id'];
                $data['name'] = $row['name'];
                $data['email'] = $row['email'];
                $data['phone'] = $row['phone'];
                $data['address'] = $row['address'];
                array_push($res, $data);
            }
        } else {
            //$output .= '<li>Country Record Found</li>';
        }
        //$output .= '<hr></ul><br>';
        //echo $output;
        echo json_encode($res);
    }
    /*
    $skillData = array();
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $data['id'] = $row['id'];
            $data['value'] = $row['skill'];
            array_push($skillData, $data);
        }
    }
    */
?>

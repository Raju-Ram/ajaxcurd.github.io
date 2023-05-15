<?php
$conn = mysqli_connect('localhost', 'root', "", 'ajaxcrud');

extract($_POST);

if(isset($_POST['readrecord'])){


    $data = '<table class="table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>first name</th>
    <th>last name</th>
    <th>Email Address</th>
    <th>Mobile number</th>
    <th>Edit Action</th>
    <th>Delete Action</th>
    </tr>';

    $displayquery = "SELECT * FROM `ajaxtable`";
    $result = mysqli_query($conn,$displayquery);

    if(mysqli_num_rows($result) > 0){
        $number = 1;
        while ($row = mysqli_fetch_array($result)){
            $data .= '<tr>
            <td>'.$number.'</td>
            <td>'.$row['firstname'].'</td>
            <td>'.$row['lastname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['mobile'].'</td>
            <td>
            <button onclick="getuserdetails('.$row['id'].')" data-toggle="modal" data-target="#update_user_modal"
            class="btn btn-warning">Edit</button>

            
            </td>
            <td>
            <button onclick="deleteuser('.$row['id'].')"
            class="btn btn-danger">Delete</button>
            
            
            </td>
            </tr>';
            $number++;




        }
    }

    $data .= "</table>";
    echo $data;
}


if (
    isset($_POST['firstname']) && isset($_POST['lastname'])
    && isset($_POST['email']) && isset($_POST['mobile'])
) {

    $query = "INSERT INTO `ajaxtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES ( '$firstname', '$lastname', '$email', '$mobile' )";

    $query_run = mysqli_query($conn, $query);
    if($query_run){
        echo "ok";
    }
    else{
        echo "else";
    }
}


if(isset($_POST['deleteid'])){

    $userid = $_POST['deleteid'];
    $deletequery = "delete from ajaxtable where id='$userid'";
    mysqli_query($conn,$deletequery);
}




////get user id 

if(isset($_POST['id']) && isset($_POST['id']) !="")
{

    $user_id = $_POST['id'];
    $query = "select * from ajaxtable where id='$user_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        exit(mysqli_error($conn));
    }
    $response = array();
    if(mysqli_num_rows($result)> 0){
        while ($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
    }
    else {
        $response['status'] = 200;
        $response['message'] ="data not found";
    }
    echo json_encode($response);
}
else{
    $response['status'] = 200;
    $response['message'] ="Invalid request";

}


 

?>
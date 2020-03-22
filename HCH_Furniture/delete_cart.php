<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$user = $_SESSION['user_login'];
    $sql="SELECT * FROM user WHERE id='$user'";
    $result= $conn->query($sql);

        $get_user_email =$result->fetch(PDO::FETCH_ASSOC);
            $uname_db = $get_user_email['firstName'];
}


if (isset($_REQUEST['cid'])) {
		$cid = ($_REQUEST['cid']);
		 $sql="DELETE FROM cart WHERE pid='$cid' AND uid='$user'";
    $result= $conn->query($sql);

		if($result){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}



?>
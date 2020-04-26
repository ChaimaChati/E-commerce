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
else{
     $sql="DELETE FROM cart WHERE uid='$user'";
    $result= $conn->query($sql);

		if($result){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}
if (isset($_REQUEST['aid'])) {
		$aid = ($_REQUEST['aid']);
		 $sql="SELECT * FROM cart WHERE pid='$aid'";
   		 $result= $conn->query($sql);
		$get_p = $result->fetch(PDO::FETCH_ASSOC);
		$num = $get_p['quantity'];
		$num += 1;

		 $sql1="UPDATE cart SET quantity='$num' WHERE pid='$aid' AND uid='$user";
   		 $result1= $conn->query($sql);
		if($result1){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}
if (isset($_REQUEST['sid'])) {

		$sid =($_REQUEST['sid']);
		 $sql="SELECT * FROM cart WHERE pid='$sid'";
   		 $result= $conn->query($sql);
		$get_p =  $result->fetch(PDO::FETCH_ASSOC);
		$num = $get_p['quantity'];
		$num -= 1;
		if ($num <= 0){
			$num = 1;
		}
		 $sql1="UPDATE cart SET quantity='$num' WHERE pid='$sid' AND uid='$user'";
   		 $result1= $conn->query($sql);
		if($result){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}


?>

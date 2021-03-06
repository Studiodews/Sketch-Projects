<?php
include_once('reviews.functions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="../styles/main/mainStyle.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/main/dashboard.css" type="text/css"/>
</head>

<body>

<div id="upperPanel">
<?php
include_once('./layout/upperPanel.php');
?>
</div>
<div id="wrapper">
<div id="navigationBar">
<?php
include_once('./layout/menu.php');
?>
</div>
<div id="content">
<?php
printError();
printSuccess();
if(isset($_GET['action']))
{
    switch ($_GET['action'])
    {
        case "approve":
        if(isset($_GET['id']))//redirect if id isn't defined
        {
         approveReview($_GET['id'],$_SESSION['userID']);   
        }
        header("location:./reviews.php");
        exit();
        break;
        case "unapprove":
         if(isset($_GET['id']))//redirect if id isn't defined
        {
            unapproveReview($_GET['id']);
           
        }
         header("location:./reviews.php");
            exit();
        break;
        case "del":
        if(isset($_GET['id']))//redirect if id isn't defined
        {
            delReview($_GET['id']);
           
        }
         header("location:./reviews.php");
            exit();
        break;
        case "pending":
        $sql='select reviews.reviewID,reviews.reveiwContent,reviews.approvedBy,reviews.reviewDate,users.userFirstName,users.userLastName,apps.appName
  from reviews,users,apps where reviews.authorID = users.userID and reviews.reviewAppID=apps.appID AND reviews.approvedBy IS NULL';
    $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
    if($result->num_rows==0)
    {
        echo "no review pending requests";
    }
    else
    {
        displayReviews($result);
    }
    
        break;
    }
}
else
{
   $sql='select reviews.reviewID,reviews.reveiwContent,reviews.approvedBy,reviews.reviewDate,users.userFirstName,users.userLastName,apps.appName
  from reviews,users,apps where reviews.authorID = users.userID and reviews.reviewAppID=apps.appID';
    $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
    if($result->num_rows==0)
    {
        echo "no review till now";
    }
    else
    {
        displayReviews($result);
    }
    
}
    
?>
</div>
</div>
<?php
include_once('./layout/footer.php');
?>


</body>
</html>
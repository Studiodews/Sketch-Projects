<?php

/**
 * reviews management functions[approve,disapprove,del,display]
 * 
 * @author mohamed hussein 
 * @copyright 2017
 */
include_once('../includes/common.functions.php');

/**
 * print all reviews related to an app id
 * @param int $appID app id
 */
 function printAppReviews($appID)
 {
    global $mysqli;
    $sql="SELECT appID,appName,appIcon,appRating FROM apps WHERE appID=$appID AND appState=1 ";
    $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
    if($result->num_rows==0)
    {
        logError("unknown or unpublished app id");
    }
    else
    {
        $row=$result->fetch_assoc();
        echo "<p><strong>{$row['appName']}</strong>,{$row['appRating']} reviews</p>";
        $sql="SELECT reviews.reviewID,reviews.reveiwContent,reviews.reviewValue,reviews.reviewDate,users.userFirstName,users.userLastName
            FROM reviews,users WHERE reviews.authorID=users.userID AND reviews.reviewState=1 AND reviews.reviewAppID=$appID";
    $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
        if($result->num_rows==0)
        {
            echo "no reviews related to this app";
        }
        else
        {
            $count=1;
          echo '<table class="appsList"><tr><th>N</th><th>Review</th> <th>rate</th> <th>author</th> <th>date</th></tr>';
          while( $row=$result->fetch_assoc())
          {
            echo "<tr><td>$count</td>";
            $count++;
            echo "<td>{$row['reveiwContent']}</td>";
            echo "<td>{$row['reviewValue']}</td>";
            echo '<td>'.$row['userFirstName'].' '.$row['userLastName'].'</td>';
            echo '<td>'.Date('d-m-y',strtotime($row['reviewDate'])).'</td></tr>';
          }
          echo '</table>';  
        }
    }
 }
?>
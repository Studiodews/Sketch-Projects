<?php
include_once('category.functions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Categories</title>
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
        case "new":
        newCatForm();
        break;
        case "edit":
        if(!isset($_GET['id']))//redirect if id isn't defined
        {
            header("location:./category.php");
            exit();
        }
        else
        {//get category record from db
        
            editCategoryForm($_GET['id']);
            
        }
        break;
        
        case "update":
        if(isset($_GET['id'])&&isset($_POST['submit']))//redirect if id  or no submit isn't defined
        {
        $name=$_POST['name'];
        $parent=$_POST['mainCat'];
        if($parent=="-1")
        {
            $parent='NULL';
        }
        $id=$_GET['id']; 

        updateCategory($id,$name,$parent);
        }
    
        header("location:./category.php");
        exit();  
        break;
        
        case "del":
        if(isset($_GET['id']))//redirect if id isn't defined
        {
        $id=$_GET['id'];
        delCategory($id);
         
        }
     header("location:./category.php");
     exit();
        break;
        case "add":
         if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $parent=$_POST['mainCat'];
        if($parent=="-1")
        {
            $parent='NULL';
        }
       
        addcategory($name,$parent);
        }
    header("location:./category.php");
    exit();
        break;
    }
}
else
{
   $sql="SELECT * FROM categories";
   $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
   if($result->num_rows==0)
    {
        echo 'NO categories defined yet , <a href="./category.php?action=new" id="hrefBtn">add new category</a>';
    }
    else
    {
        echo '<p><a href="./category.php?action=new" id="hrefBtn">add new category</a></p>';
        displayCategories($result);
    }
    
}
?>
</div>
</div>
<footer>
<?php
include_once('./layout/footer.php');
?>
</footer>

</body>
</html>
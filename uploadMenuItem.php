<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$returnArray = array('imageUploaded' => false);
$target_dir = "assets/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file) || ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $returnArray['imageUploaded'] = true;
    }
}

if($returnArray['imageUploaded'] === true) {
    $orderComponents = false;
    $ingred = false;
    $category = false;
    if(isset($_POST['title'])){
        if(isset($_POST['description'])){
            if(isset($_POST['price'])){
                $orderComponents = true;
                if(isset($_POST['category'])){
                    $category = true;
                    if(isset($_POST['ingred'])){
                        $ingred = true;
                    }
                }
            }
        }
    }
    if($orderComponents && $category && $returnArray['imageUploaded']){
        require_once 'db-connect.php';
        $con = dbConnect();
        $sql = "INSERT INTO menuItems (`title`,`desc`,`Price`) VALUES (?,?,?)";
        $menu = $con->prepare($sql);
        $menu->bind_param('sss',$_POST['title'],$_POST['description'],$_POST['price']);
        $success = $menu->execute();
        $menuItemId = $menu->insert_id;
        $menu->close();
        if($success){
            $sql = "INSERT INTO pictures (menuItemId,`path`) VALUES (?,?)";
            $pics = $con->prepare($sql);
            $pics->bind_param('ss', $menuItemId,$target_file);
            $success = $pics->execute();
            $pics->close();
            foreach($_POST['category'] as $category){
                $sql = "INSERT INTO menuItemCategory (categoryId,menuItemId) VALUES (?,?)";
                $cat = $con->prepare($sql);
                $cat->bind_param('ss',$category,$menuItemId);
                $cat->execute();
                $cat->close();    
            }
            if($ingred){
                $ingreds = explode(",", $_POST['ingred']);
                foreach($ingreds as $ing){
                    $parts = explode(":",$ing);
                    $sql = "INSERT INTO ingredients (menuItemId,ingredient,amount) VALUES (?,?,?)";
                    $ingredient = $con->prepare($sql);
                    $ingredient->bind_param('sss',$menuItemId,$parts[0],$parts[1]);
                    $ingredient->execute();
                    $ingredient->close();
                }
            }
            exit(header('Location: menuEditor.php?uploaded'));
        }


    } else {
        $args = '?error';
        $args .= $orderComponents ? '' : '&order';
        $args .= $category ? '' : '&category';
        exit(header('Location: staffMenuItemMaker.php' . $args));
    }

} else {
    $args = $returnArray['imageUploaded'] ? '' : '&image';
    exit(header('Location: staffMenuItemMaker.php' . $args));
}
?>
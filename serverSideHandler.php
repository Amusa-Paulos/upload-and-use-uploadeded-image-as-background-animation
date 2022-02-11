<?php

$connection = mysqli_connect("localhost","root","","prototype");

if (mysqli_errno($connection) > 0) {
    die("An Error occured while trying to connect to the database, db Error: ". mysqli_error($connection));
}

if (isset($_POST["submit_pic"])) {
    $picture_file = $_FILES["picture"];

    $fileName = $picture_file["name"];
    $fileTmpName = $picture_file["tmp_name"];
    // $fileType = $picture_file["type"];
    // $fileError = $picture_file["error"];
    // $fileSize = $picture_file["size"];

    $split_file_name = explode(".",$fileName);

    $real_file_name = uniqid($split_file_name[0]) . ".". end($split_file_name);
    $file_loc = "uploads/" . $real_file_name;
    
    if(move_uploaded_file($fileTmpName, $file_loc)){
        $sql = "INSERT INTO bgAnimatnPics (picture_name) VALUES (?)";

        $stmt = mysqli_stmt_init($connection);
        if (mysqli_stmt_prepare($stmt,$sql)) {
            mysqli_stmt_bind_param($stmt, "s", $real_file_name);
            
            if (mysqli_stmt_execute($stmt)) {
                $fetch_sql = "SELECT * FROM bgAnimatnPics ORDER BY id DESC LIMIT 8";
                $query = mysqli_query($connection, $fetch_sql);

                $counter = 0;
                $style_animation = "";

                $style_animation = "
                body{animation: change_background_image 10s infinite}
                @keyframes change_background_image{ ";
                while ($pictures  = mysqli_fetch_assoc($query)) { 
                    
                    $style_animation .= $counter . "%{background-image: url('";
                    $style_animation .= "uploads/" . $pictures["picture_name"] . "');
                          background-attachment: fixed;
                          background-position: top;
                          background-size: cover;
                          background-repeat: no-repeat;}";

                    $counter = ($counter + 12);

                }
                $style_animation .= "}";

                echo json_encode(["status"=>1, "style"=>$style_animation]);

            }else {
                exit;
            }

        }else {
            exit;
        }
    }else {
        exit;
    }
}

if (isset($_POST["fetch_animation"])) {
    
    $fetch_sql = "SELECT * FROM bgAnimatnPics ORDER BY id DESC LIMIT 8";
    $query = mysqli_query($connection, $fetch_sql);

    $style_animation = "";
    $counter = 0;

    $style_animation = "
    body{animation: change_background_image 5s infinite}
    @keyframes change_background_image{ ";
    while ($pictures  = mysqli_fetch_assoc($query)) { 
        
        $style_animation .= $counter . "%";
        $style_animation .= "{background-image: url('";
        $style_animation .= "uploads/" . $pictures["picture_name"] . "');
              background-attachment: fixed;
              background-position: top;
              background-size: cover;
              background-repeat: no-repeat;}";
        $counter += 12.5;

    }
    $style_animation .= "}";

    echo json_encode(["status"=>1, "style"=>$style_animation]);
}
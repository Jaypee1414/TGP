<?php
    session_start();
    include 'connect.php';

    $file=isset($_FILES['image_birth']);

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $contact = $_POST['contact'];


    if(isset($_POST['regist']) && $file){
        echo "<prev>";
        print_r($_FILES['image_birth']);
        echo "</prev>";

        $image_name = $_FILES['image_birth']['name'];
        $image_size = $_FILES['image_birth']['size'];
        $temp_name = $_FILES['image_birth']['tmp_name'];
        $error = $_FILES['image_birth']['error'];


        if($error === 0){
            if ($image_size > 125000) {
                # code...
                $em = "The file is too large ";
                 header("location: /user/html/practical.php?error=$em");
            } else {
                # code...
                $img_ex =pathinfo($image_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg","jpeg","png");

                if (in_array($img_ex_lc,$allowed_exs)) {
                    # code...
                    $new_img_name = uniqid("PSA-",true).'.'.$lastname.'.'.$img_ex_lc;
                    $img_upload_path ='PSA/'.$new_img_name;
                    move_uploaded_file($temp_name,$img_upload_path);


                    //insert into database 

                    if (2023-$year>18) {
                        # code...
                        
                    $sql = "INSERT INTO `practical2` (firstname,middlename,familyname,contact,addres,years,months,d,psa) VALUES ('$firstname','$middlename','$lastname','$contact','$address','$year','$month','$day','$new_img_name')";
                    $data = mysqli_query($conn,$sql);

                    echo '<script language="Javascript">;
                    alert("Enrolled, Wait For the Text message of the Head");
                    location.href="/user/html/home.php";
                    </script>';

                    }else {
                        

                        echo '<script language="Javascript">;
                        alert("You must present your Parent Consent");
                        location.href="/user/html/practical.php";
                        </script>';


                    }
                    

                }else{
                    $em = "You cant upload type of this file";
                    header("location: /user/html/practical.php?error=$em");
                }
            }
            
        }else{
            $em = "Unknow eeror occured ";
            header("location: /user/html/practical.php?error=$em");
        }
        
    }else{
        header("location: /user/html/practical.php");
    }

?>

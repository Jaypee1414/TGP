 <?php
    if(isset($_POST['submit']) && isset($_FILES['image_birth'])){
        include "connect.php";
        
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $address = $_POST['address'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];



        
        //image
        $image_name = $_FILES['image_birth']['name'];
        $image_size = $_FILES['image_birth']['size'];
        $temp_name = $_FILES['image_birth']['tmp_name'];
        $error = $_FILES['image_birth']['error'];

        

        if ($error === 0){
            # code...
            if ($image_size > 125000) {
                # code...
                $em = "The File is Too large";
                header("location: theoretical.php?error=$em");
            } else {
                # code...
               $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
               $img_ex_lc = strtolower($img_ex);
               $allowed_exs = array("jpg","jpeg","png");

               if (in_array($img_ex_lc,$allowed_exs)) {
                # code...
                $new_img_name = uniqid("IMG-",true). '.' .$img_ex_lc;
                $img_path = 'Upload/'.$new_img_name;
                move_uploaded_file($temp_name,$img_path);

                //Insert Into database
                $sql = "INSERT INTO `theoretical` (firstname,middlename,familyname,address,year,month,day,psa_image) VALUES ('$firstname','$middlename''$lastname','$address','$year','$month','$day','$new_img_name')";
                 $data = mysqli_query($conn,$sql);

                echo '<script language="Javascript">;
                alert("Official Enrolled");
                location.href="enrolled.php";
                </script>';
               } else {
                # code...
                $em = "can't upload file in this type";
                header("location: theoretical.php?error=$em");
               }
               

            }
            
        } else {
            # code...
            $em = "Unknown error occured!";
            header("Location: theoretical.php?error=$em");
        }
        
    }else{
        echo '<script language="Javascript">;
        alert("No file Uploaded!");
        location.href="enrolled.php";
        </script>';
    }
?> 

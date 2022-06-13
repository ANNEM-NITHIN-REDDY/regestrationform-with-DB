<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark light">
    <title>regestration form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// ----------datbase details----------------------------------------------------------------------
    $server = 'localhost';
    $uname= 'nithin';
    $pass = 'nithin';
    $db = "DB";
    $fname = $lname = $email = $course = $pnumber = $age = $dob = $address = "";


// --------------------------registering into database ---------------------------------------------------------
if(isset($_POST['push'])){
    
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $pnumber = $_POST['pnumber'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dobdate = $_POST['dobyear'];
    $dobmonth = $_POST['dobmonth'];
    $dobyear = $_POST['dobdate'];
    $dob = " $dobyear$dobmonth$dobdate";
    $paddress = $_POST['address'];

    echo "$fname,$lname,$email,$course,$pnumber,$gender,$age,$dob";
    $connection = mysqli_connect($server,$uname,$pass,$db);
    if($connection){
        $sql = "INSERT INTO regestrationform(ID,fname,lname,email,course,pnumber,gender,age,dob,paddress)"."VALUES"."('$id','$fname','$lname','$email','$course','$pnumber','$gender','$age','$dob','$paddress');";
        $result = mysqli_query($connection,$sql);
        if($result){
            echo "Regestration completed";
        }
        else{
            echo "error";
        }
    }
    else{
        echo "connection failed";
    }
}

// -----------------updating data in the datbase----------------------------

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $pnumber = $_POST['pnumber'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dobdate = $_POST['dobyear'];
    $dobmonth = $_POST['dobmonth'];
    $dobyear = $_POST['dobdate'];
    $dob = "$dobyear$dobmonth$dobdate";
    $paddress = $_POST['address'];
    $connection = mysqli_connect($server,$uname,$pass,$db);
if($connection){
    $sql = "UPDATE regestrationform SET fname = '".$fname."',lname ='".$lname."',email = '".$email."',course = '".$course."',pnumber = $pnumber,gender ='".$gender."',age = $age,dob = $dob,paddress ='".$paddress."' WHERE ID = '" .$id."' ";
    $result = mysqli_query($connection,$sql);
    if($result){
        echo "updated sucessfully";
    }
    else{
    echo "not updated";
}
    
}
else{
    echo "details not present to update";
}
}

?>



<!---------------------------- HTML code goes here----------------------------- -->
<div class="form">
<fieldset>
    <legend>  Student Registration Form</legend>
<form action="second.php" method="post">
    
    <span class='side-heading'> ID Number : </span><input type="number" name="id" required ><br><br>

    
    <span class='side-heading'>First Name:</span> <input type="text" name="fname" required value = '<?php echo $fname?>'><BR></BR>


    <span class='side-heading'>Last Name:</span> <input type="text" name="lname" required value = '<?php echo $lname?>'><BR></BR>


    <span class='side-heading'> E-mail ID :</span> <input type="email"  name="email" 
     value = '<?php echo $email?>' ><BR></BR>


     <span class='side-heading'>Course :</span> <input type="text" name="course" required value = '<?php echo $course?>'><br><br>


     <span class='side-heading'>Phone Number :</span> <input type="number" name="pnumber" required  value = '<?php echo $pnumber?>' ><br><br>


     <span class='side-heading'>Gender : 
             <input type="radio" name="gender" value="male"          checked>Male
             <input type="radio" name="gender" value="female" >Female
             <input type="radio" name="gender" value="other" >other
             <br><br>


   <span class='side-heading'> Age: 
        <select name="age">
            <option value = '<?php echo $age?>'>age
                <?php
                
                for($i=0;$i<=25;$i++){
                    echo "<option name='age'>$i</option>";
                }
                ?>
            </option>
        </select>
        <br><br>


    <span class='side-heading'>Date of Birth :</span>
            <select name="dobdate" >
                <option value = '<?php echo $dobdate?>'>Date
                    <?php
                        for($i=1;$i<=31;$i++){
                            echo "<option name='dobdate'>$i</option>";
                        }
                    ?>
                </option>
            </select>

            <select name="dobmonth" >
                <option value = '<?php echo $dobmonth?>'>month</option>
                <?php 
                for($i=1;$i<13;$i++){
                    echo "<option name='dobmonth' >$i</option>";
                }
                ?>
            </select>

            <select name="dobyear" >
                    <option value = '<?php echo $dobyear?>'>Year
                        <?php
                            for($i=1995;$i<=2022;$i++){
                                echo "<option name='dobyear'>$i</option>";
                            }
                        ?>
                    </option>
                </select>
            <br><br>


    <span class='side-heading'>Address:</span></span> <textarea name="address" cols="25" rows="5"></textarea>
    <br><br>


    <input type="submit" value="check" name = 'check' class="button" title="click to check details">
    <input type="submit" value="register" name = 'push' class="button"
    title="click to register">
    <input type="submit" value="update" name="update" class="button" title="click to update">

</form>
</fieldset>
</div>

<!------------------------------ HTML code ends here------------------------------------- -->

<?php 

// checking whether the given details present in the database or not

if(isset($_POST["check"])){
    $connection = mysqli_connect($server,$uname,$pass,$db);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
if($connection){
    $sql = "SELECT * FROM regestrationform where fname='$fname' and lname='$lname'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0){
        echo "Details Found : <br>";
        while($row = mysqli_fetch_row($result)){
            foreach($row as $y){
                echo "$y <br>";    
            }
        }
    }
    else{
    echo "Details Not Present in Database";
    }
}
else{
    echo "connection failed";
}
}
?>

</body>
</html>
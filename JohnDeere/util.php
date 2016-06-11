<?php

  define('TEMP', 50);
	function NewDealer()
    {
            require 'DBConnect.php' ;
      
            if(session_id() == ''){
                  session_start();
            }
            $name = $_POST['name'];
            $username = $_POST['username'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $password =  $_POST['password'];
            $query = "INSERT INTO dealer(name,contact,email,username,password) VALUES ('$name','$mobile','$email','$username','$password')";
            if($conn->query($query) === TRUE)
            {
                  $_SESSION['uname']=$username;
                  $_SESSION['role']="dealer";
                  header("Location: index.php");

            }
            else
                  echo $conn->error."<h1 align='center'>Could Not Register</h1>";
    }

    function SignUp()
    {
          require 'DBConnect.php' ;
      
          if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
          {
                $result = $conn->query("SELECT * FROM dealer WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
                if($result->num_rows > 0)
                {
                        echo "<h1 align='center'>SORRY...YOU ARE ALREADY REGISTERED USER...</h1>";
                }
                else
                {
                        NewDealer();
                }
          }
    }
    function Login()
      {
            require 'DBConnect.php' ;
      
            if(session_id() == ''){
                  session_start();
            }
            if(!empty($_POST['isCustomer'])){
              $role= 'customer';
              $usernm = 'cusername';
              $pass = 'cpassword';
            }
            else{
               $role= 'dealer';
               $usernm = 'username';
               $pass = 'password';
            }
            if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
            {
                  $result = $conn->query("SELECT * FROM $role WHERE $usernm = '$_POST[username]' AND $pass = '$_POST[password]'");
                  echo "SELECT * FROM $role WHERE $usernm = '$_POST[username]' AND $pass = '$_POST[password]'";

                  if($result->num_rows > 0)
                  {
                      $row = $result->fetch_assoc();
                       $_SESSION['uname']=$_POST['username'];
                        $_SESSION['role']=$role;
                        if($role == 'customer')
                          $_SESSION['tid']=$row['tid'];
                      
                       header("Location: index.php");
                  }
                  else
                  {
                        echo "<h1 align='center' style='color:red'>Username or Password is incorrect</h1>";
                  }
            }
      }

    function addTractor() {
      
      require "DBConnect.php";
      $maxsize = 10000000; //set to approx 10 MB


      if(session_id() == ''){
                  session_start();
      }
      //check associated error code
      if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {

        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    

            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {  
  
              //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    

                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

                    
                    $TractorName = $_POST["TractorName"];
                    $Price = $_POST["Price"];
                    $Description  = $_POST["Description"];
                    $AddedBy = $_SESSION["uname"];

                    $query = "INSERT INTO tractor(TractorName,Price,AddedBy,AddedOn,filename,image) VALUES ".
                            "('$TractorName','$Price','$AddedBy',NOW(),'{$_FILES['userfile']['name']}','{$imgData}')";
                    if($conn->query($query) === TRUE)
                    {
                      $msg="<h1 align='center'>Successfully saved in database</h1>";
                    }
                    else
                    $msg="<p>Could saved in database</p>";    
                    
                }
                
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                ' bytes</div><hr />';
                }
        }
        else
            $msg="Could not Save.";

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    echo $msg;
}

  // Function to return error message based on error code

  function file_upload_error_message($error_code) {
      switch ($error_code) {
          case UPLOAD_ERR_INI_SIZE:
              return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
          case UPLOAD_ERR_FORM_SIZE:
              return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
          case UPLOAD_ERR_PARTIAL:
              return 'The uploaded file was only partially uploaded';
          case UPLOAD_ERR_NO_FILE:
              return 'No file was uploaded';
          case UPLOAD_ERR_NO_TMP_DIR:
              return 'Missing a temporary folder';
          case UPLOAD_ERR_CANT_WRITE:
              return 'Failed to write file to disk';
          case UPLOAD_ERR_EXTENSION:
              return 'File upload stopped by extension';
          default:
              return 'Unknown upload error';
      }
    }

  function addTractorInfo(){


      require "DBConnect.php";
     
      
      if(session_id() == ''){
                  session_start();
      }

      $TractorName = $_POST["TractorName"];
      $Price = $_POST["Price"];
      $Description  = $_POST["descr"];
      $AddedBy = $_SESSION["uname"];

      if(isset($_FILES['image'])) {
        
         $name = basename($_FILES["image"]["name"]);
         $fp=addslashes(file_get_contents($_FILES['image']['tmp_name'])); //will store the image to fp
      

         require "DBConnect.php";
         // our sql query
         $query = "INSERT INTO tractor(TractorName,description,Price,AddedBy,AddedOn,image_file_name,image) VALUES ".
                            "('$TractorName','$Description',$Price,'$AddedBy',NOW(),'{$name}','{$fp}')";
         if($conn->query($query) === TRUE)
            echo "<h1 align='center'>Successfully Saved</h1>";
          else
            echo "Error in Query insert: " . $conn->error;
      }
  }

  function AddCustomer(){

      require "DBConnect.php";


      if(session_id() == ''){
                  session_start();
      }

      $customer_name = $_POST['name'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $TractorName = $_POST['TractorName'];
      $price_paid = $_POST['Price'];
      $cusername = $_POST['username'];
      $cpassword = $_POST['password'];
      $AddedBy = $_SESSION['uname'];

       require "DBConnect.php";
         // our sql query
       $query = "INSERT INTO customer values('$customer_name','$mobile','$email',(select tractorID from tractor where TractorName='$TractorName')".
                ",$price_paid,'$cusername','$cpassword','$AddedBy',NOW())";
       if($conn->query($query) === TRUE)
             echo "<h1 align='center'>Successfully Registered</h1>";
        else
            echo "Error in Query insert: " . $conn->error;
  }

  function sendproblem(){

    if(session_id() == ''){
           session_start();
        }
    require "DBConnect.php";
    $prob = $_POST['problem'];
    $username = $_SESSION['uname'];

    $result = $conn->query("SELECT * FROM problem where question='$que'");
    if($result->num_rows > 0)
    {

        $row = $result->fetch_assoc();
        header("location:index.php");
    }   
    else{
        $query = "INSERT INTO problem(askedby,asked,problem) VALUES ('$username',NOW(),'$prob')";
        if($conn->query($query) === TRUE)
        {
                  header("Location: problems.php");

        }
        else
             echo "<h1 align='center'>Could Save Question</h1>";
    } 
    
  }
  function saveReply(){
            require "DBConnect.php";
            if(session_id() == ''){
                  session_start();
            }
            $sol = $_POST['reply'];
            $pid = $_POST['pid'];
            $user = $_SESSION['uname'];
      
        
            $query = "INSERT INTO Solution(solvedby,pid,solution,solved_at) VALUES ('$user',$pid,'$sol',NOW())";
            if($conn->query($query) === TRUE)
            {
                  
                  header("Location: Solution.php?pid=$pid");

            }
            else
                  echo "<h1 align='center'>Could Save Question</h1>";
      }

  function getEngineStatus($temp){

    $msg = "Cooling system Working Properly";
    if($temp >= TEMP)
      $msg="Problem in Cooling system";
    return $msg;
  }
  function addToDB($tid,$temp,$danger){
      require "DBConnect.php";
      $query = "update tractor set engine_temp=$temp,engine_temp_updated=NOW(),isdanger='$danger' where tractorID=$tid";
      if($conn->query($query)==TRUE)
          echo "succuss";
      else
          echo $conn->error;
  }
  function getTractorID($uname){
      require "DBConnect.php";
      $query = "select tid from customer where cusername='$uname'";
      $id=0;
      $result = $conn->query($query);
      if($result->num_rows > 0)
      {
          $row=$result->fetch_assoc();
          $id=$row['tid'];
      }  
      return $id;
  }
?>
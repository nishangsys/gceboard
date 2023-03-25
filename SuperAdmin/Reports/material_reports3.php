   <!-- page specific plugin styles -->
   <?php include '../../includes/functions.php'; ?>
    <!-- text fonts -->
    <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../assets/css/ace-part2.min.css" class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="../../assets/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="../../assets/css/jquery-ui.min.css"/>
    <style>
        body{
            
        }
              table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
              font-size:10px;
              }
              th, td {
              padding: 5px;
              text-align: left;    
              }

              .top_row {
              display: table;
              width: 100%;
              padding: 10px 0px;
              
              }

              .top_row > div {
              display: table-cell;
              border-collapse:collapse;
              width:100%;
              border: 1px solid #000;
              margin-top:0px;
              }


    </style>
    <img src="../../img/header.png">
   
    <?php  
    
    
    $year_id=$_GET['id'];
    
          
    $check_exits=$con->query("SELECT * FROM  ayear where id='$year' ") 
        or die(mysqli_error($con));
       while($rows=$check_exits->fetch_assoc()){
        $ayear_name=$rows['cur_ayear'];
       }
      
   
   

       $check_exits=$con->query("SELECT * FROM  subjects ") 
       or die(mysqli_error($con));
      $check_exits->num_rows;
       $i=1;
      
       ?>



<h3>Accomodation Centers Reports

    
</h3>

    <table style="width:100%">
    <thead>

    <!---speciality code starts--->

    <tr>
        
        <th colspan="6">ACC CENTRE</th>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th style="font-size:9px"><?php  echo $row['abbv']         ?></th>
        <?php } ?>
        
        
      </tr>
      <!---speciality code ends--->


        <!---subject code starts--->

      <tr >
        
        <th>S/N</th>
        
        <th colspan="5">Name</th>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th style="font-size:9px" ><?php  echo $row['subject_code']         ?></th>
        <?php } ?>
        
        
      </tr>
      <!---subject code ends--->

      



    </thead>



    <tbody>
    <?php
   //////////////////////////////Get All Regions 

			while($rows=$check_exits->fetch_assoc()){
	?>



 

                        <!-----GET ALL ACCOMODATIONS CENTERS RECORDS------------->

                         
                        <tr style=""> 
                        <td colspan="4"><?php echo $i++;?></td>
                        <td><?php echo $rows ['subject_name']; ?></td>
                        <td><?php echo $rows ['rate_per_student']; ?></td>
                        <?php
       
       $check=$con->query("UPDATE student_registration SET cost_price='".$rows ['rate_per_student']."' WHERE subject_id='".$rows ['id']."' ") 
       or die(mysqli_error($con));
       ?>
        

                         
      </tr>

         
         <?php } ?>

      nnn


     
      
    </tbody>
  </table>
  

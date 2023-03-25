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

              .rotate
              {
                  
                  -webkit-transform: rotate(-90deg); 
                  clear:both;
                  line-height:1.5;
                  -moz-transform: rotate(-90deg); 
                  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); //For IE support
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
      
   
   

       $check_exits=$con->query("SELECT * FROM  regions,student_registration, divisions,schools WHERE   schools.acc_center='1' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY regions.id  order by  regions.region ") 
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
       <th></th> 
        
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
        <th></th> 
        
      </tr>
      <!---subject code ends--->

      
      <tr >
        
        <th> </th>
        
        <th colspan="5"> </th>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th style="font-size:9px" class="rotate"><?php  echo $row['subject_name']         ?></th>
        <?php } ?>
        <th>Total</th> 
        
      </tr>
      <!---subject code ends--->

      


    </thead>



    <tbody>
    <?php
   //////////////////////////////Get All Regions 

			while($rows=$check_exits->fetch_assoc()){
	?>




               <!-----GET ALL ACCOMODATION CENTERS RECORDS------------->
               <?php 
               $get_acc_centers=$con->query("SELECT * FROM  regions,divisions,schools,student_registration 
               WHERE regions.id=divisions.region_id And divisions.id=schools.subdiv_id AND 
                 student_registration.year_id='$year_id' AND
                schools.id=student_registration.acc_center_id  AND regions.id='".$rows['region_id']."'  GROUP BY
                student_registration.acc_center_id  ") or die(mysqli_error($con));       
               $i=1;
                while($rows_acc_centers=$get_acc_centers->fetch_assoc()){ 
                  ?>  


                        <!-----GET ALL REGISTRATION CENTERS RECORDS------------->

                                                          
                        <?php 
                                                                
                        $get_reg_centers=$con->query("SELECT * FROM  schools,student_registration 
                        WHERE   schools.id=student_registration.school_id AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."'
                        GROUP BY   student_registration.school_id ") or die(mysqli_error($con));       
                      
                        while($rows_reg_centers=$get_reg_centers->fetch_assoc()){ 
                        ?>  
                        <tr style=""> 
                        <td colspan="4"></td>
                        <td><?php echo $rows_reg_centers['center_num']; ?></td>
                        <td><?php echo $rows_reg_centers['school_name']; ?></td>

                        <!-----GET NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 
                        <?php
      
                              $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                              or die(mysqli_error($con));
                              $num_of_courses=$check->num_rows;
                              while($row=$check->fetch_assoc()){

                              ?>
                              <td><?php

                              $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  regions,divisions,schools,student_registration 
                              WHERE subject_id='".$row['id']."' AND regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                              AND schools.id=student_registration.school_id
                              AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                              AND student_registration.school_id='".$rows_reg_centers['school_id']."' ") 
                              or die(mysqli_error($con));
                              $check_students->num_rows;

                              while($rowstudents=$check_students->fetch_assoc()){
                              echo $rowstudents['num_ofstudents'];
                                  }       ?></td>
                              <?php } ?> 

                             <!-----END GET NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 


                              <!-----START GRAND TOTAL PER  SCHOOL PER SUBJECT -----------> 
                          <td>
                          <?php

                          $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  regions,divisions,schools,student_registration 
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=student_registration.school_id
                          AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                          AND student_registration.school_id='".$rows_reg_centers['school_id']."' ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $rowstudents['num_ofstudents'];
                          }       ?></td>
                                 <!-----END GRAND TOTAL PER  SCHOOL PER SUBJECT -----------> 
                        </tr>
                        <?PHP } ?>


                        <!-----END GET ALL REGISTRATION CENTERS RECORDS------------->



                  <tr style="BACKGROUND:#F5F5DC">
               
                    <td ><?php echo $i++; ?></td>
 
                      <th><?php echo $rows_acc_centers['center_num']; ?></th>
                      <th><?php echo $rows_acc_centers['school_name']; ?></th>
                      <th colspan="3">TOTAL</th>

                      <!-----GET NUMBER OF TOTAL STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 
                      <?php

                      $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                      or die(mysqli_error($con));
                      $num_of_courses=$check->num_rows;
                      while($row=$check->fetch_assoc()){

                      ?>
                      <td><?php

                      $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM   student_registration 
                      WHERE subject_id='".$row['id']."'  
                      AND student_registration.year_id='".$year_id."'  
                      AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."' ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                      echo $rowstudents['num_ofstudents'];
                      }       ?></td>
                      <?php } ?> 

                      <td><?php

                        $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM   student_registration 
                        WHERE student_registration.year_id='".$year_id."'  
                        AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."' ") 
                        or die(mysqli_error($con));
                        $check_students->num_rows;

                        while($rowstudents=$check_students->fetch_assoc()){
                        echo $rowstudents['num_ofstudents'];
                        }       ?></td>

                      <!-----END GET TOTAL NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 
                       
                     
                  </tr>   
                      

                 <?php } ?>



                 <!-----END GET ALL ACCOMODATION CENTERS RECORDS------------->

       <!-----GET ALL REGIONS TOTAL RECORDS FOR ALL SUBJETS------------->


      <tr style="background:#F4A460">

<td colspan="6">Total <?php echo $rows['region']; ?></td>

                <?php

                $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                or die(mysqli_error($con));
                $num_of_courses=$check->num_rows;
                while($row=$check->fetch_assoc()){

                ?>
                <th><?php

                $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  regions,divisions,schools,student_registration 
                WHERE subject_id='".$row['id']."' AND regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                AND schools.id=student_registration.school_id
                AND student_registration.year_id='".$year_id."'  
                AND regions.id='".$rows['region_id']."' ") 
                or die(mysqli_error($con));
                $check_students->num_rows;

                while($rowstudents=$check_students->fetch_assoc()){
                echo $rowstudents['num_ofstudents'];
                      }       ?> </th>

                     
                <?php } ?> 
                <th><?php

                $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  regions,divisions,schools,student_registration 
                WHERE regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                AND schools.id=student_registration.school_id
                AND student_registration.year_id='".$year_id."'  
                AND regions.id='".$rows['region_id']."' ") 
                or die(mysqli_error($con));
                $check_students->num_rows;

                while($rowstudents=$check_students->fetch_assoc()){
                echo number_format($rowstudents['num_ofstudents']);
                      }       ?> </th>

                     
           
               
        
        

                
            </tr>

       <!-----END GET ALL REGIONS TOTAL RECORDS------------->
        

      
      </tr>

         
         <?php } ?>

      nnn


     
      
    </tbody>
  </table>
  

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
          background:#fff;
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
    
          
    $check_exits=$con->query("SELECT * FROM  ayear where id='$year_id' ") 
        or die(mysqli_error($con));
       while($rows=$check_exits->fetch_assoc()){
        $ayear_name=$rows['cur_ayear'];
       }
      
   
       $session_amt='5000';
       $due_script='200';
       $transport='2000';
    
    

       $check_exits=$con->query("SELECT * FROM  regions,student_registration,  divisions,schools WHERE   schools.acc_center='1' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id  
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY regions.id  order by  regions.region ") 
       or die(mysqli_error($con));
      $check_exits->num_rows;
       $i=1;
      
       ?>



<h3>Making Payments to Supervisions for <?php echo  $ayear_name; ?> Practicals in <br>Technical and Vocational Education Examination<br>
Intermediate Level

    
</h3>

    <table style="width:100%">
    <thead>

   

    <tr>        
        <th colspan="3">ACC CENTRE</th>
        <th rowspan="2"  >SPECIALITY</th>
        <th colspan="2">SUBJECT	</th>
        
        <th colspan="2">Supervisor</th>
        
        <th rowspan="2">Candidate</th>
        <th >Sessions</th>
                  
      </tr>


      <tr>        
      <th>SN</th>
        <th>No.</th> 
        
        <th colpsan="4">Name</th>
        
        <th>Code</th>
        <th>Name</th>
        <th>Name</th>
        <th>Address</th>
        <th>Sessions</th>
        <th>Amt </th>
        <th>Script Dues<br><?php echo $due_script; ?> frs</th>
        <th>Transp't <br><?php echo $transport; ?></th>
        <th>Total</th>         
           
           
      </tr>
      
      


    </thead>



    <tbody>
    <?php
   //////////////////////////////Get All Regions 

			while($rows=$check_exits->fetch_assoc()){
	?>




               <!-----GET ALL ACCOMODATION CENTERS RECORDS------------->
               <?php 
               $get_acc_centers=$con->query("SELECT * FROM  regions,  divisions,schools,student_registration 
               WHERE regions.id=divisions.region_id And divisions.id=schools.subdiv_id AND 
                 student_registration.year_id='$year_id'   AND
                schools.id=student_registration.acc_center_id  AND regions.id='".$rows['region_id']."'  GROUP BY
                student_registration.acc_center_id     ") or die(mysqli_error($con));       
               $i=1;
                while($rows_acc_centers=$get_acc_centers->fetch_assoc()){ 
                  ?>  


                        <!-----GET ALL SUBJECTS RECORDED IN EACH ACCOMO CENTER------------->

                                                          
                        <?php 
                                                                
                        $get_reg_centers=$con->query("SELECT * FROM  specialities ,subjects,student_registration 
                        WHERE   subjects.id=student_registration.subject_id AND student_registration.school_id='".$rows_acc_centers['acc_center_id']."'
                       AND specialities.id=subjects.specailty_id  AND  student_registration.year_id='$year_id'
                        
                        GROUP BY   student_registration.subject_id ") or die(mysqli_error($con));       
                      
                        while($rows_reg_centers=$get_reg_centers->fetch_assoc()){ 


                          
                        
                        ?>  
                        <tr style=""> 
                        <td colspan="3"></td>
                        <?php 
                        
                          
                            
                      ?>
                        <td><?php echo $rows_reg_centers['abbv']; ?></td>
                        
                        <td><?php echo $rows_reg_centers['subject_code']; ?></td>
                        <td><?php echo $rows_reg_centers['subject_name']; ?></td>
                        <td>Name</td> 
                        <td>Address</td>
                             <!-----END GET NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 


                              <!-----START GRAND TOTAL PER  SCHOOL PER SUBJECT -----------> 
                          <td>
                          <?php

                          $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  regions,divisions,schools,student_registration 
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=student_registration.school_id AND student_registration.subject_id='".$rows_reg_centers['subject_id']."'
                          AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                          ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $num_of_can=$rowstudents['num_ofstudents'];
                          }       ?></td>

                              <td>
                          <?php

                          $check_students=$con->query("SELECT SUM(sess_num) as sess_num FROM  regions,divisions,schools,student_registration  
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=student_registration .school_id AND student_registration .subject_id='".$rows_reg_centers['subject_id']."'
                          AND student_registration .year_id='".$year_id."'  AND student_registration .school_id='".$rows_reg_centers['school_id']."'
                         ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo  $session_num=$rowstudents['sess_num'];
                          }       ?></td>
                             <td><?php
                         $session_total= $session_num*$rows_reg_centers['session_cost'] ; 
                         echo number_format( $session_total) ;?></td>

                          <td><?php
                          $script_total=$num_of_can*$rows_reg_centers['script_cost'] ;
                            echo number_format($script_total) ;?></td>
                          <td><?php  echo number_format($rows_reg_centers['transport']) ;?></td>
                          <td><?php  echo number_format($rows_reg_centers['transport']+$script_total+$session_total) ;?></td>



                                 <!-----END GRAND TOTAL PER  SCHOOL PER SUBJECT -----------> 
                        </tr>
                        <?PHP } ?>


                        <!-----END GET ALL REGISTRATION IN THIS CENTERS  ------------->



                  <tr style="BACKGROUND:#F5F5DC">
               
                    <td ><?php echo $i++; ?></td>
 
                      <th><?php echo $rows_acc_centers['center_num']; ?></th>
                      <th colspan="11"><?php echo $rows_acc_centers['school_name']; ?> TOTAL</th>
                     
 
                      <td>
                      <?php
                     
                      $check_students=$con->query("SELECT SUM(num_ofstudents*script_cost) as num_ofstudents,
                      SUM(sess_num*session_cost) as total_sessioncost  FROM  regions,divisions,schools,student_registration 
                      WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                      AND schools.id=student_registration.school_id 
                      AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."'
                     ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                   $total_scripts= $rowstudents['num_ofstudents'];
                   $total_sessioncost = $rowstudents['total_sessioncost']+$total_scripts;
                      
                      } 

                      $check_students=$con->query("SELECT SUM(transport) as transport  FROM  subjects,student_registration 
                      WHERE   student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."'
                      AND subjects.id=student_registration.subject_id  AND student_registration.school_id='".$rows_acc_centers['acc_center_id']."'
                     ") 
                      or die(mysqli_error($con));
                      
                      while($rowstudents=$check_students->fetch_assoc()){
                   
                    $total_hours= $rowstudents['transport'];
                       
                      }
                    echo   $total=number_format($total_sessioncost +$total_hours);
                      
                     
                      
                      
                      ?> 
          
          </td>

                      <!-----EEND GET ALL REGISTRATION IN THIS CENTERS -----------> 
                       
                     
                  </tr>   
                      

                 <?php } ?>


 
      <tr style="background:#F4A460">

<td colspan="13">Total <?php echo $rows['region']; ?></td>

                
                <th><?php

                       
                        
                      $check_students=$con->query("SELECT SUM(num_ofstudents*script_cost) as num_ofstudents,
                      SUM(sess_num*session_cost) as total_sessioncost  FROM  regions,divisions,schools,student_registration 
                      WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                      AND schools.id=student_registration.school_id 
                      AND student_registration.year_id='".$year_id."' AND regions.id='".$rows['region_id']."'
                     ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                   $total_scripts= $rowstudents['num_ofstudents'];
                   $total_sessioncost = $rowstudents['total_sessioncost']+$total_scripts;
                      
                      } 

                      $check_students=$con->query("SELECT SUM(transport) as transport  FROM  regions,divisions,schools,subjects,student_registration 
                      WHERE   student_registration.year_id='".$year_id."' AND regions.id=divisions.region_id 
                      AND divisions.id=schools.subdiv_id AND schools.id=student_registration.acc_center_id  
                      AND schools.id=student_registration.school_id  
                      AND subjects.id=student_registration.subject_id  AND regions.id='".$rows['region_id']."'
                     ") 
                      or die(mysqli_error($con));
                      
                      while($rowstudents=$check_students->fetch_assoc()){
                   
                    $total_hours= $rowstudents['transport'];
                       
                      }
                    echo   $total=number_format($total_sessioncost +$total_hours);
                      
                     
                    ?> </th>

                     
                <?php } ?> 
                
        

                
            </tr>

       <!-----END GET ALL REGIONS TOTAL RECORDS------------->
        

      
      </tr>

         
          


     
      
    </tbody>
  </table>
  

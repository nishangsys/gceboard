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
    
    
    $year_id=$_GET['year_id'];
    
          
    $check_exits=$con->query("SELECT * FROM  ayear where id='$year_id' ") 
        or die(mysqli_error($con));
       while($rows=$check_exits->fetch_assoc()){
        $ayear_name=$rows['cur_ayear'];
       }
      $session_amt='5000';
      $due_script='200';
      $transport='2000';
   
   

       $check_exits=$con->query("SELECT * FROM  regions,student_registration, divisions,schools WHERE   schools.acc_center='1' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY regions.id  order by  regions.region  ") 
       or die(mysqli_error($con));
     echo  $check_exits->num_rows;
       $i=1;
      
       ?>



<h3>Invigilators Reports

    
</h3>

    <table style="width:100%">
    <thead>

   

    <tr>        
        <th colspan="3">ACC CENTRE</th>
        <th rowspan="2"  >SPECIALITY</th>
        <th colspan="2">SUBJECT	</th>
        
        <th colspan="2">Supervisor</th>
        
        <th rowspan="2">Candidate</th>
        <th colspan="5" style="text-align:center">Costing<th>
                  
      </tr>


      <tr>        
      <th>SN</th>
        <th>No.</th> 
        
        <th colpsan="4">Name</th>
        
        <th>Code</th>
        <th>Name</th>
        <th>Name</th>
        <th>Address</th>
        <th>Sess</th>
        <th>Amt @ <?php echo $session_amt; ?></th>
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

               
               $get_acc_centers=$con->query("SELECT * FROM  regions,divisions,schools,school_sessions 
               WHERE regions.id=divisions.region_id And divisions.id=schools.subdiv_id AND 
                 school_sessions.year_id='$year_id'   AND 
                schools.id=school_sessions.school_id  AND school_sessions.school_id='".$_GET['id']."'  GROUP BY
                school_sessions.school_id  ") or die(mysqli_error($con));       
               $i=1;
                while($rows_acc_centers=$get_acc_centers->fetch_assoc()){ 
                  ?>  


                        <!-----GET ALL SUBJECTS RECORDED IN EACH ACCOMO CENTER------------->

                                                          
                        <?php 
                                                                
                        $get_reg_centers=$con->query("SELECT * FROM  specialities,subjects,school_sessions 
                        WHERE   subjects.id=school_sessions.subject_id AND school_sessions.school_id='".$rows_acc_centers['school_id']."'
                       AND specialities.id=subjects.specailty_id  AND  school_sessions.year_id='$year_id'
                       
                        GROUP BY   school_sessions.subject_id ") or die(mysqli_error($con));       
                      
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
                        <td><?php 
                            $check_students=$con->query("  SELECT * from schools where id='".$rows_reg_centers['address_id']."'
                          ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $rowstudents['school_name'];
                          }    ?></td>

                          </td>


                       
                          <td><?php 
                            $check_students=$con->query("  SELECT SUM(num_ofstudents) as sess_num FROM  regions,divisions,schools,student_registration 
                        WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                        AND schools.id=student_registration.acc_center_id AND student_registration.subject_id='".$rows_reg_centers['subject_id']."'
                        AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['school_id']."'
                          ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $num_of_studs=$rowstudents['sess_num'];
                          }    ?></td>

                          </td>
                                
                          
                          <td>
                          <?php

                          $check_students=$con->query("SELECT SUM(sess_num) as sess_num FROM  regions,divisions,schools,school_sessions 
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=school_sessions.school_id AND school_sessions.subject_id='".$rows_reg_centers['subject_id']."'
                          AND school_sessions.year_id='".$year_id."'  AND school_sessions.school_id='".$rows_reg_centers['school_id']."'
                          ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $session_num=$rowstudents['sess_num'];
                          }       ?></td>
                          <td><?php
                         $session_total= $session_num*$session_amt ; 
                         echo number_format( $session_total) ;?></td>
                          <td><?php
                          $script_total=$session_num*$due_script;
                            echo number_format($script_total) ;?></td>
                          <td><?php  echo number_format($rows_reg_centers['transport']) ;?></td>
                          <td><?php  echo number_format($rows_reg_centers['transport']+$script_total+$session_total) ;?></td>



                        </tr>
                        <?PHP } ?>


                        <!-----END GET ALL REGISTRATION IN THIS CENTERS  ------------->



                  <tr style="BACKGROUND:#F5F5DC">
               
                    <td ><?php echo $i++; ?></td>
 
                      <th><?php echo $rows_acc_centers['center_num']; ?></th>
                      <th colspan="11"><?php echo $rows_acc_centers['school_name']; ?> TOTAL</th>
                     
 
                      <td>
                          <?php

                          $check_students=$con->query("SELECT SUM(sess_num) as sess_num FROM  regions,divisions,schools,school_sessions 
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=school_sessions.school_id 
                          AND school_sessions.year_id='".$year_id."'  AND school_sessions.school_id='".$rows_acc_centers['school_id']."'
                         ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $rowstudents['sess_num'];
                          }       ?> </td>






       <?php

                          $check_students=$con->query("SELECT SUM(sess_num) as sess_num FROM  regions,divisions,schools,school_sessions 
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=school_sessions.school_id 
                          AND school_sessions.year_id='".$year_id."'  AND school_sessions.school_id='".$rows_acc_centers['school_id']."'
                         ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo $rowstudents['sess_num'];
                          }       ?> </td>

                      <!-----EEND GET ALL REGISTRATION IN THIS CENTERS -----------> 
                       
                     
                  </tr>   
                      

                 <?php } ?>


 
      <tr style="background:#F4A460">

<td colspan="14">Total <?php echo $rows['region']; ?></td>

                
                <th><?php

                        $check_students=$con->query("SELECT SUM(sess_num) as sess_num FROM  regions,divisions,schools,school_sessions 
                        WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                        AND schools.id=school_sessions.school_id 
                        AND school_sessions.year_id='".$year_id."'   AND divisions.id='".$rows_acc_centers['division_id']."' ") 
                        or die(mysqli_error($con));
                        $check_students->num_rows;

                        while($rowstudents=$check_students->fetch_assoc()){
                        echo $rowstudents['sess_num'];
                        }   
                    ?> </th>

                     
                <?php } ?> 
                
        

                
            </tr>

       <!-----END GET ALL REGIONS TOTAL RECORDS------------->
        

      
      </tr>

         
          

      nnn


     
      
    </tbody>
  </table>
  

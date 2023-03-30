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
              font-size:14px;
              }
              th, td {
              padding: 5px;
              text-align: center;    
              }
              th{
                position:sticky;
                position:-webkit-sticky;
                font-family:Arial Black;
              }

                /* Fixed Headers */

                th {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 2;
                }
                  

                        th[scope=row] {
                position: -webkit-sticky;
                position: sticky;
                left: 0;
                z-index: 1;
                }

                th[scope=row] {
                vertical-align: top;
                color: inherit;
                background-color: inherit;
                background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);
                }

                table:nth-of-type(2) th:not([scope=row]):first-child {
                left: 0;
                z-index: 3;
                background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);
                }

                /* Strictly for making the scrolling happen. */

                th[scope=row] + td {
                min-width: 24em;
                }

                th[scope=row] {
                min-width: 20em;
                }
                /* Fixed Headers */

                th {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 2;
                }
                .headings{
                  font-weight:bold;
                  font-family: 'Arial Black', Gadget, sans-serif;
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
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id  AND  schools.acc_center='1'
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY regions.id  order by  regions.codes ") 
       or die(mysqli_error($con));
      $check_exits->num_rows;
       $i=1;
      
       ?>



<h3>Making Payments to Invigilators for <?php echo  $ayear_name; ?> Practicals in <br>Technical and Vocational Education Examination<br>
Intermediate Level

    
</h3>

    <table style="width:100%">
    <thead>

   <h1>

    <tr class="headings">        
        <td colspan="3">ACC CENTRE</td>
        <td rowspan="2"  >SPECIALITY</td>
        <td colspan="2">SUBJECT	</td>
        
        <td colspan="2">Supervisor</td>
         
        <td >Sessions</td>
                  
      </tr>
      </h1>

      <tr>        
      <th>SN</th>
        <th>No.</th> 
        
        <th colpsan="4">Name</th>
        
        <th>Code</th>
        <th>Name</th>
        <th>Name</th>
        <th>Address</th>
        <th>Cand.</th>
        <th>Sessions</th>
        <th>Amt </th>
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
                 student_registration.year_id='$year_id'   AND schools.id=student_registration.acc_center_id AND
                schools.id=student_registration.school_id  AND regions.id='".$rows['region_id']."'  GROUP BY
                student_registration.school_id  ORDER BY divisions.division_name,schools.center_num ") or die(mysqli_error($con));       
               $i=1;
                while($rows_acc_centers=$get_acc_centers->fetch_assoc()){ 
                  ?>  


                        <!-----GET ALL SUBJECTS RECORDED IN EACH ACCOMO CENTER------------->

                                                          
                        <?php 
                                                                
                        $get_reg_centers=$con->query("SELECT * FROM  specialities ,subjects,student_registration 
                        WHERE   subjects.id=student_registration.subject_id AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."'
                       AND specialities.id=subjects.specailty_id  AND  student_registration.year_id='$year_id'
                        
                        GROUP BY   student_registration.subject_id order by subjects.subject_code") or die(mysqli_error($con));       
                      
                        while($rows_reg_centers=$get_reg_centers->fetch_assoc()){ 


                          
                        
                        ?>  
                        <tr style=""> 
                        <td colspan="3" style="border:none"></td>
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

                          $check_students=$con->query("SELECT SUM(inv_sess ) as inv, inv_cost, SUM(inv_sess*inv_cost) as inv_sess FROM  regions,divisions,schools,student_registration  
                          WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                          AND schools.id=student_registration .school_id AND student_registration .subject_id='".$rows_reg_centers['subject_id']."'
                          AND student_registration .year_id='".$year_id."'  AND student_registration .school_id='".$rows_reg_centers['school_id']."'
                         ") 
                          or die(mysqli_error($con));
                          $check_students->num_rows;

                          while($rowstudents=$check_students->fetch_assoc()){
                          echo  $session_num=$rowstudents['inv'];
                          $inv_cost=$rowstudents['inv_cost'];
                            $session_cost=$rowstudents['inv_sess'];
                          }       ?> </td>
                          <td><?php    echo number_format( $inv_cost); ?> </td>  
                         <td><?php   
                          echo number_format( $session_cost); ?></td>

                          
                        



                                 <!-----END GRAND TOTAL PER  SCHOOL PER SUBJECT -----------> 
                        </tr>
                        <?PHP } ?>


                        <!-----END GET ALL REGISTRATION IN THIS CENTERS  ------------->

 
                       

                  <tr style="BACKGROUND:#F5F5DC"  class="headings">
               
                    <td ><?php echo $i++; ?></td>
 
                      <td><?php echo $rows_acc_centers['center_num']; ?></td>
                      <td colspan="8"><?php echo $rows_acc_centers['school_name']; ?> TOTAL</td>
                     
                      <?php
                  
                      $check_students=$con->query("  SELECT  SUM(student_registration.inv_cost*inv_sess) as inv_sess FROM  specialities ,subjects,student_registration 
                      WHERE   subjects.id=student_registration.subject_id AND student_registration.acc_center_id='".$rows_acc_centers['acc_center_id']."'
                    
                     AND specialities.id=subjects.specailty_id  AND  student_registration.year_id='$year_id' 
                    
                     
                      ") or die(mysqli_error($con));
                      $check_students->num_rows;
                      
                      while($rowstudents=$check_students->fetch_assoc()){
                      
                      
                        $session_cost=$rowstudents['inv_sess'];
                      }       ?> </td>
                      <td>  </td>  
                      <td><?php   
                      echo number_format( $session_cost); ?></td>

                      <!-----EEND GET ALL REGISTRATION IN THIS CENTERS -----------> 
                       
                     
                  </tr>   
                      

                 <?php }  ?>


 
      <tr style="background:#F4A460" class="headings">

              <td colspan="10">Total <?php echo $rows['region']; ?></td>
              <td></td>

                
                <td><?php

                       
                        
                      $check_students=$con->query("SELECT SUM(inv_cost*inv_sess) as num_ofstudents,
                      SUM(inv_sess*inv_cost) as total_sessioncost  FROM  regions,divisions,schools,student_registration 
                      WHERE  regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                      AND schools.id=student_registration.school_id 
                      AND student_registration.year_id='".$year_id."' AND regions.id='".$rows['region_id']."'
                     ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                   $totals= $rowstudents['num_ofstudents'];
                  ;
                      
                      } 

                       
                    echo   $total=number_format($totals);
                      
                     
                    ?> </td>

                     
                <?php } ?> 
                
        

                
            </tr>

       <!-----END GET ALL REGIONS TOTAL RECORDS------------->
        

      
      </tr>

         
          


     
      
    </tbody>
  </table>
  

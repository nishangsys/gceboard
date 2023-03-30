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
              font-size:12px;
              }
              th, td {
              padding: 5px;
              text-align: center;    
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
                line-height:2;
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
                line-height:2;
                }

                th[scope=row] {
                min-width: 20em;
                line-height:2;
                }
                /* Fixed Headers */

                th {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 2;
                clear:both;
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
         $tax_rate=$rows['taxes'];
         $tax_per=$tax_rate/100;
       }
      
   
   

       $check_exits=$con->query("SELECT * FROM  regions,student_registration, divisions,schools WHERE   schools.acc_center='1' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY regions.id  order by  regions.region ") 
       or die(mysqli_error($con));
      $check_exits->num_rows;
       $i=1;
      
       ?>



<h3>Materials Reports

    
</h3>

    <table style="width:100%">
    <thead>

    <!---speciality code starts--->

    <tr class="headings">
        
        <td colspan="7">ACC CENTRE</td>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <td style="font-size:9px"><?php  echo $row['abbv']         ?></td>
        <?php } ?>
        <td></td>
        <td></td>
        <td></td> 
      </tr>
      <!---speciality code ends--->


        <!---subject code starts--->

      <tr >
        
        <th>S/N</th>
        
        <th colspan="6">Name</th>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th style="font-size:9px" ><?php  echo $row['subject_code']         ?></th>
        <?php } ?>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <!---subject code ends--->



      <!---Rate per subject starts--->
      <tr class="headings">        
        <td colspan="6"></td>
         
        <td style="font-size:10px">Rate/Cand.</td>
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <td style="font-size:10px"><?php  echo $row['rate_per_student']         ?></td>
        <?php } ?>  
        <td >Total</td>
        <td >Tax<br>
      <?php echo $tax_rate; ?> % 
      </td>
        <td >Net<br>Payable</td>

      </tr>
        <!---Rate per subject ends--->


          
      <tr class="headings" >
        
        <td> </td>
        
        <td colspan="6"> </td>
       
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <td style="font-size:9px" class="rotate"><?php  echo $row['subject_name']         ?></td>
        <?php } ?>
        <td>Total</td> 
        
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
               divisions.id ") or die(mysqli_error($con));       
               $i=1;
                while($rows_acc_centers=$get_acc_centers->fetch_assoc()){ 
                  ?>  


                        <!-----GET ALL ACCOMODATIONS CENTERS RECORDS------------->

                                                          
                        <?php 
                                                                
                        $get_reg_centers=$con->query("SELECT * FROM   schools,student_registration 
                        WHERE  student_registration.year_id='$year_id' AND
                         schools.id=student_registration.acc_center_id  AND schools.subdiv_id='".$rows_acc_centers['subdiv_id']."'  GROUP BY
                        student_registration .acc_center_id") or die(mysqli_error($con));       
                      
                        while($rows_reg_centers=$get_reg_centers->fetch_assoc()){ 
                        ?>  
                        <tr style=""> 
                        <td colspan="4"><?php echo $i++;?></td>
                        <td><?php echo $rows_reg_centers['center_num']; ?></td>
                        <td><?php echo $rows_reg_centers['school_name']; ?></td>
                        <td>
                        CANDS<br>
                        AM'T                          
                      </td>

                        <!-----END GET ALL ACCOMODATIONS CENTERS RECORDS -----------> 
                        <?php
      
                              $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                              or die(mysqli_error($con));
                              $num_of_courses=$check->num_rows;
                              while($row=$check->fetch_assoc()){
                               

                              ?>
                           <!-----  GET TOTAL NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT PER ACC CENTER -----------> 
                              <td><?php

                              $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,cost_price as cp FROM  schools,student_registration 
                              WHERE subject_id='".$row['id']."'   
                              AND schools.id=student_registration.school_id
                              AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                              ") 
                              or die(mysqli_error($con));
                              $check_students->num_rows;

                              while($rowstudents=$check_students->fetch_assoc()){
                            echo  $total_num_of_studs=$rowstudents['num_ofstudents'];
                              $cost_price=$rowstudents['cp'];
                                  }       ?><br>

                                <?php $total_stu_accenter=$cost_price*$total_num_of_studs ;
                                if($total_stu_accenter<1){
                                  echo 0;
                                }
                                else {
                                  echo number_format($total_stu_accenter);
                                }
                                
                                ?>                              
                                
                                
                                </td>

                              
                              <?php } ?>
                               <!-----END GET NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 
                               
                                <!-----START GRAND TOTAL NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 
                              
                                <td><?php

                              $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,cost_price as cp FROM  schools,student_registration 
                              WHERE   schools.id=student_registration.school_id
                              AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                              ") 
                              or die(mysqli_error($con));
                              $check_students->num_rows;

                              while($rowstudents=$check_students->fetch_assoc()){
                            echo  $total_num_of_studs=$rowstudents['num_ofstudents'];
                             
                                  }   
                            /////////////total cost per acc center
                            
                            $check_students=$con->query("SELECT SUM(num_ofstudents*cost_price) as num_ofstudents  FROM  schools,student_registration 
                            WHERE   schools.id=student_registration.school_id
                            AND student_registration.year_id='".$year_id."'  AND student_registration.acc_center_id='".$rows_reg_centers['acc_center_id']."'
                            ") 
                            or die(mysqli_error($con));
                            $check_students->num_rows;

                            while($rowstudents=$check_students->fetch_assoc()){
                           $total_cost_of_studs=$rowstudents['num_ofstudents'];
                           
                                }                             
                                  
                                  
                                  
                                  ?><br>

                                <?php $total_stu_accenter=$total_cost_of_studs ;
                                if($total_stu_accenter<1){
                                  echo 0;
                                }
                                else {
                                  echo number_format($total_stu_accenter);
                                }
                                
                                ?>                              
                                
                                
                                </td>

                              <!-----END  GRAND TOTAL NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 

                            

                              <td></td>
                              <td></td>

                        </tr>

                        <?PHP } ?>


                        <!-----END GET ALL REGISTRATION CENTERS RECORDS------------->



                  <tr style="BACKGROUND:#F5F5DC">
               
                     
 
                      <th colspan="6"><?php echo $rows_acc_centers['division_name']; ?> TOTAL</th>
                      <td>
                        CANDS<br>
                        AM'T                          
                      </td>
                      
                    

                      <!-----GET NUMBER OF TOTAL STUDENTS REGISTERED IN SUB DIVISION -----------> 
                      <?php

                      $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.specailty_id  order by subjects.subject_code ") 
                      or die(mysqli_error($con));
                      $num_of_courses=$check->num_rows;
                      while($row=$check->fetch_assoc()){
                        

                      ?>
                      <td><?php

 
 
                      $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                      FROM  schools,student_registration 
                      WHERE student_registration.subject_id='".$row['id']."'  AND schools.subdiv_id='".$rows_acc_centers['subdiv_id']."' 
                      AND schools.id=student_registration.school_id AND student_registration.school_id=schools.id 
                      AND student_registration.year_id='".$year_id."'   ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                     echo  $total_studs_div=$rowstudents['num_ofstudents'];
                       $cp=$rowstudents['cp'];
                      }  
                      
                      
                      ?><br>
                      
                    <?php  $total_div=$cp*$total_studs_div ;
                    if($total_div<1){
                      echo 0;
                    }
                    else {
                      echo number_format($total_div);
                    }
                    
                    
                    
                    
                    ?></td>
                  
                      <?php } ?> 

                      <!-----END GET TOTAL NUMBER OF STUDENTS REGISTERED IN THIS SCHOOL PER SUBJECT -----------> 

                      <!------TOTAL NUMBER & COST PER SUB DIVISION ------------->
                      <td><?php
 
                      $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                      FROM  schools,student_registration 
                      WHERE  schools.subdiv_id='".$rows_acc_centers['subdiv_id']."' 
                      AND schools.id=student_registration.school_id
                      AND student_registration.year_id='".$year_id."'   ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                     echo  $total_studs_div=$rowstudents['num_ofstudents'];
                       
                      }  
                      

                      //////TOTAL COST 

                      
                      $check_students=$con->query("SELECT SUM(num_ofstudents*student_registration.cost_price) as num_ofstudents 
                      FROM  schools,student_registration 
                      WHERE schools.subdiv_id='".$rows_acc_centers['subdiv_id']."' 
                      AND schools.id=student_registration.school_id
                      AND student_registration.year_id='".$year_id."'   ") 
                      or die(mysqli_error($con));
                      $check_students->num_rows;

                      while($rowstudents=$check_students->fetch_assoc()){
                      
                       $total_cost_per_subdiv=$rowstudents['num_ofstudents'];
                      }  
                      
                      
                      
                      
                      ?><br>
                      
                    <?php  $total_div=$total_cost_per_subdiv ;
                    if($total_div<1){
                      echo 0;
                    }
                    else {
                      echo number_format($total_div);
                    }
                    
                    
                    
                    
                    ?></td>
                    <!--------------End total Cost per Sub Divsion------------>
                     <th><?php $taxed_per_subdiv=$total_div*$tax_per;
                      echo number_format($taxed_per_subdiv) ;?></th>  
                      <th><?php $bal_at_sub=$total_cost_per_subdiv-$taxed_per_subdiv;
                      echo number_format($bal_at_sub);
                      ?>
                     
                  </tr>   
                      

                 <?php } ?>



                 <!-----END GET ALL ACCOMODATION CENTERS RECORDS------------->

       <!-----GET ALL REGIONS TOTAL RECORDS FOR ALL SUBJETS------------->


      <tr style="background:#F4A460" class="headings">

                  <td colspan="6">Total <?php echo $rows['region']; ?></td>
                  <td>
                        CANDS<br>
                        AM'T                          
                      </td>

                <?php

                $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                or die(mysqli_error($con));
                $num_of_courses=$check->num_rows;
                while($row=$check->fetch_assoc()){

                ?>
                <td><?php

                $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                 FROM  regions,divisions,schools,student_registration 
                WHERE subject_id='".$row['id']."' AND regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                AND schools.id=student_registration.acc_center_id
                AND student_registration.year_id='".$year_id."'  
                AND regions.id='".$rows['region_id']."' ") 
                or die(mysqli_error($con));
                $check_students->num_rows;

                while($rowstudents=$check_students->fetch_assoc()){
                echo$stud_atregion= $rowstudents['num_ofstudents'];
                $cp=$rowstudents['cp'];
                $total_at_region=$cp*$stud_atregion;
                      }       ?> <br>

                  <?php 
                  if($total_at_region<1){
                    echo 0;

                  }
                  else {
                    echo number_format($total_at_region);
                  }

                ?>
                      
                </td>
               
                <?php } ?> 
               
                

                 <!------TOTAL NUMBER & COST PER REGION------------->
                 <td><?php
 
                            $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                            FROM  schools,divisions, regions,student_registration 
                            WHERE   schools.id=student_registration.school_id AND regions.id='".$rows['region_id']."'
                            AND student_registration.year_id='".$year_id."' AND divisions.region_id=regions.id AND 
                            divisions.id=schools.subdiv_id    ") 
                            or die(mysqli_error($con));
                            $check_students->num_rows;

                            while($rowstudents=$check_students->fetch_assoc()){
                            echo  $total_studs_div=$rowstudents['num_ofstudents'];
                              
                            }  
                            

                            //////TOTAL COST 

                            
                            $check_students=$con->query("SELECT SUM(num_ofstudents*student_registration.cost_price) as num_ofstudents 
                           FROM  schools,divisions, regions,student_registration 
                            WHERE   schools.id=student_registration.school_id AND regions.id='".$rows['region_id']."'
                            AND student_registration.year_id='".$year_id."' AND divisions.region_id=regions.id AND 
                            divisions.id=schools.subdiv_id   ") 
                            or die(mysqli_error($con));
                            $check_students->num_rows;

                            while($rowstudents=$check_students->fetch_assoc()){
                            
                              $total_cost_per_subdiv=$rowstudents['num_ofstudents'];
                            }  
                            
                            
                            
                            
                            ?><br>
                            
                            <?php  $total_div=$total_cost_per_subdiv ;
                            if($total_div<1){
                            echo 0;
                            }
                            else {
                            echo number_format($total_div);
                            }




                            ?></td>
                            <td><?php
                            $tax_region=$total_div*$tax_per;
                             echo number_format($tax_region); ?></td>
                             <td><?php 
                             $net_at_region=$total_cost_per_subdiv-$tax_region;
                             echo number_format($net_at_region);
                             
                             ?></td>
                            <!--------------End total Cost per Sub Divsion------------>
                              
                                    

                                            
                                        </tr>

                                  <!-----END GET ALL REGIONS TOTAL RECORDS------------->
                                    

      
      </tr>

         
         <?php } ?>




  <!-----STARTS GRAND TOTAL------------->



         <tr style="background:#FF0" class="headings">

            <td colspan="6">GRAND TOTAL</td>
            <td>
            CANDS<br>
            AM'T                          
            </td>

                <?php

                $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                or die(mysqli_error($con));
                $num_of_courses=$check->num_rows;
                while($row=$check->fetch_assoc()){

                ?>
                <td><?php

                $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                 FROM  regions,divisions,schools,student_registration 
                WHERE subject_id='".$row['id']."' AND regions.id=divisions.region_id  AND schools.subdiv_id=divisions.id 
                AND schools.id=student_registration.acc_center_id
                AND student_registration.year_id='".$year_id."'  
                  ") 
                or die(mysqli_error($con));
                $check_students->num_rows;

                while($rowstudents=$check_students->fetch_assoc()){
                echo$stud_atregion= $rowstudents['num_ofstudents'];
                $cp=$rowstudents['cp'];
                $total_at_region=$cp*$stud_atregion;
                      }       ?> <br>

                  <?php 
                  if($total_at_region<1){
                    echo 0;

                  }
                  else {
                    echo number_format($total_at_region);
                  }

                ?>
                      
                </td>
               
                <?php } ?> 
               
                

                 <!------TOTAL NUMBER & COST PER REGION------------->
                 <td><?php
 
                            $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents,student_registration.cost_price as cp 
                            FROM  schools,divisions, regions,student_registration 
                            WHERE   schools.id=student_registration.school_id 
                            AND student_registration.year_id='".$year_id."' AND divisions.region_id=regions.id AND 
                            divisions.id=schools.subdiv_id    ") 
                            or die(mysqli_error($con));
                            $check_students->num_rows;

                            while($rowstudents=$check_students->fetch_assoc()){
                            echo  $total_studs_div=$rowstudents['num_ofstudents'];
                              
                            }  
                            

                            //////TOTAL COST 

                            
                            $check_students=$con->query("SELECT SUM(num_ofstudents*student_registration.cost_price) as num_ofstudents 
                           FROM  schools,divisions, regions,student_registration 
                            WHERE   schools.id=student_registration.school_id  
                            AND student_registration.year_id='".$year_id."' AND divisions.region_id=regions.id AND 
                            divisions.id=schools.subdiv_id   ") 
                            or die(mysqli_error($con));
                            $check_students->num_rows;

                            while($rowstudents=$check_students->fetch_assoc()){
                            
                              $total_cost_per_subdiv=$rowstudents['num_ofstudents'];
                            }  
                            
                            
                            
                            
                            ?><br>
                            
                            <?php  $total_div=$total_cost_per_subdiv ;
                            if($total_div<1){
                            echo 0;
                            }
                            else {
                            echo number_format($total_div);
                            }




                            ?></td>
                            <td><?php
                            $tax_region=$total_div*$tax_per;
                             echo number_format($tax_region); ?></td>
                             <td><?php 
                             $net_at_region=$total_cost_per_subdiv-$tax_region;
                             echo number_format($net_at_region);
                             
                             ?></td>
                            <!--------------End total Cost per Sub Divsion------------>
                              
                                    

                                            
                                        </tr>

                                  <!-----END GET ALL REGIONS TOTAL RECORDS------------->
                                    

      
      </tr>

    <h3>NET TOTAL STANDS AT <?php echo convert_number_to_words($net_at_region); ?> FCFA</h3>

     
      
    </tbody>
  </table>
  

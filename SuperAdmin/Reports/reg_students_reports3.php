
<?php
echo $rows['region_id'];
$check_all_schools=$con->query("SELECT * FROM  regions,divisions,schools,student_registration  WHERE   schools.acc_center='1' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id AND regions.id='".$rows['region_id']."'
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY student_registration.acc_center_id   ") 
       or die(mysqli_error($con));
       
       $i=1;
       while($rows_allschools=$check_all_schools->fetch_assoc()){
       echo $check_all_schools->num_rows;
       ?>

     <!-------Get all school Data ---------------->


     <?php
       /////Get all schools for this Region
   
       $get_schools_inreg=$con->query("SELECT * FROM  regions,student_registration, divisions,schools WHERE  
        student_registration.acc_center_id='".$rows_allschools['school_id']."' AND
       divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id 
       AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
       GROUP BY student_registration.school_id  order by  student_registration.school_id ") 
       or die(mysqli_error($con));
      $num_of_schools_here=$get_schools_inreg->num_rows;
       while($row_schools=$get_schools_inreg->fetch_assoc()){
        ?>
                <thead>
                <tr>
                <td colspan="3"><?php echo $i++; ?></td>
                <td><?php echo $row_schools['center_num']; ?></td>
                <td colspan="2"><?php echo $row_schools['school_name']; ?></td>
                
                      <?php
            
            $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
            or die(mysqli_error($con));
            $num_of_courses=$check->num_rows;
            while($row=$check->fetch_assoc()){
              ?>
              <th><?php
            
              $check_students=$con->query("SELECT * FROM  student_registration WHERE subject_id='".$row['id']."' 
              AND student_registration.year_id='".$year_id."' AND student_registration.school_id='".$row_schools['school_id']."' 
              AND student_registration.acc_center_id='".$rows['id']."' ") 
            or die(mysqli_error($con));
              $check_students->num_rows;
              
            while($rowstudents=$check_students->fetch_assoc()){
              echo $rowstudents['num_ofstudents'];
                   }       ?></th>
              <?php } ?>  
        

             
               
                </thead>
                </tr>
                

             
   <?php }   /////Close Get all schools for this Region ?>
    
   <th colspan="1" ><?php echo $rows_allschools['center_num']; ?></th> 
   <th colspan="5" ><?php echo $rows_allschools['school_name']; ?> Total</th> 
   <?php
            
            $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
            or die(mysqli_error($con));
            $num_of_courses=$check->num_rows;
            while($row=$check->fetch_assoc()){
              ?>
              <th><?php
            
              $check_students=$con->query("SELECT SUM(num_ofstudents) as num_ofstudents FROM  student_registration WHERE subject_id='".$row['id']."' 
              AND student_registration.year_id='".$year_id."'  
              AND student_registration.acc_center_id='".$rows_allschools['school_id']."' ") 
            or die(mysqli_error($con));
              $check_students->num_rows;
              
            while($rowstudents=$check_students->fetch_assoc()){
              echo $rowstudents['num_ofstudents'];
                   }       ?></th>
              <?php } ?>  
        
   
   </tr>
  

      <!-------Get all school Data ends ---------------->


      <?php } ?>
      <tr>

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
              AND student_registration.acc_center_id='".$rows['id']."' ") 
            or die(mysqli_error($con));
              $check_students->num_rows;
             
            while($rowstudents=$check_students->fetch_assoc()){
              echo $rowstudents['num_ofstudents'];
                   }       ?></th>
              <?php } ?>  
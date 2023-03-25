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
        table{
            width: 100%;
            border-collapse:collapse;
            padding:5px 5px;
        }
        tr,td,th{
            border-collapse:collapse;
            border:1px solid#000;
            padding: 5px 5px;
            font-size:12px;
        }

        .rotate {
        font-size:9px;
        line-height:1;
        padding: 0px 10px;
        transform: rotate(-90deg);


        /* Legacy vendor prefixes that you probably don't need... */

        /* Safari */
        -webkit-transform: rotate(-90deg);

        /* Firefox */
        -moz-transform: rotate(-90deg);

        /* IE */
        -ms-transform: rotate(-90deg);

        /* Opera */
        -o-transform: rotate(-90deg);

        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

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
      
   
   

       $check_exits=$con->query("SELECT * FROM  divisions,schools WHERE divisions.id=schools.subdiv_id AND 
       schools.acc_center='1'  GROUP  BY schools.subdiv_id order by schools.subdiv_id") 
       or die(mysqli_error($con));
       $i=1;
      
       ?>



<h3>Making Payments to Chiefs of Centre for the purchase of Materials for Practicals<br>
for the June 2022 Session at the Intermediate Level

    
</h3>

    <table class="table table-bordered">
    <thead>

    <!---speciality code starts--->

    <tr>
        
        <th colspan="4">ACC CENTRE</th>
       
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
        <th>No</th>
        <th>Name</th>
        <th></th>
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th style="font-size:9px" ><?php  echo $row['subject_code']         ?></th>
        <?php } ?>
        
        
      </tr>
      <!---subject code ends--->

      

          <!---Subject Title starts ---->
          <tr>        
        <th></th>
        <th> </th>
        <th> </th>
        <th  > </th>
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th class="rotate" ><?php  echo $row['subject_name']         ?></th>
        <?php } ?>  
        
      </tr>
        <!---Subject Title starts--->



      <!---Rate per subject starts--->
      <tr>        
        <th></th>
        <th> </th>
        <th> </th>
        <th style="font-size:10px">Rate/Cand.</th>
       <?php
       
       $check=$con->query("SELECT * FROM  subjects,specialities WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
       or die(mysqli_error($con));
       while($row=$check->fetch_assoc()){
        ?>
        <th><?php  echo $row['rate_per_student']         ?></th>
        <?php } ?>  
        
      </tr>
        <!---Rate per subject ends--->

    </thead>
    <tbody>
    <?php
   

			while($rows=$check_exits->fetch_assoc()){
	?>
   
      <tr>
        
        <?php 
        $get_school_insubdiv=$con->query("SELECT * FROM  schools WHERE  subdiv_id='".$rows['subdiv_id']."' AND 
        schools.acc_center='1' order by  id DESC ") 
        or die(mysqli_error($con));
        while($rows_school=$get_school_insubdiv->fetch_assoc()){
        ?>
                <tr>
                <td><?php echo $i++; ?></td>  
            
                <td><?php echo $rows_school['center_num']; ?></td>
                <td><?php echo $rows_school['school_name']; ?></td>
                    <td>CANDS
                <BR>
                    AM'T
                
                    </td>

                </td>

                            <?php  
                            $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.specailty_id  order by subjects.subject_code ") 
                            or die(mysqli_error($con));
                            while($row=$check->fetch_assoc()){
                                $subject_id= $row['id'] ; 
                        ////get number of registered students
                        

                        
                          
                                ?>
                                <td> <?php 
                              
                                $number_of_reg_students=$con->query("SELECT * FROM  registered_students where year_id='$year_id' AND school_id='".$rows_school['id']."' 
                        AND subject_id='$subject_id' ") 
                        or die(mysqli_error($con));
                        $count=$number_of_reg_students->num_rows;
                        while($row_number_of_reg_students=$number_of_reg_students->fetch_assoc()){
                         $student_reg=$row_number_of_reg_students['num_ofstudents'];
                         if($count<1){
                          echo  $num_student_reg=0;  
                         }
                         else {
                         echo  $num_student_reg=$student_reg;
                         }
                        
                        }?>    <br>
                    

                    <?php 
                    if($count==0){
                        echo 0;
                    }
                    else {
                              
                                $number_of_reg_students=$con->query("SELECT * FROM  subjects WHERE id='$subject_id' ") 
                        or die(mysqli_error($con));
                        while($row_number_of_reg_students=$number_of_reg_students->fetch_assoc()){
                          echo   $cost=number_format($row_number_of_reg_students['rate_per_student']*$num_student_reg);
                        
                        }
                    }?>
                                        </td>
                                        
                                        <?php     } ?>  
                            
                            </td>
                               


                </tr>
              
             
        
        <?php }   ?>
        
       

      
      </tr>
      <tr style=" background:#fafad2">
      <th style="color:#f00" colspan="3" > <?php echo $rows['division_name']; ?> TOTAL  </th>
      <th>CANDS <br>
     AM'T</th>

       
                 <?php
       
                    $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                    or die(mysqli_error($con));
                    while($row=$check->fetch_assoc()){
                        $subject_id= $row['id'];
                    $rate_per_student= $row['rate_per_student'];
                ?>
                <th style="color:#00f;"><?php  
                $number_of_reg_students=$con->query("SELECT SUM(registered_students.num_ofstudents) as reg_students
                FROM  registered_students,schools  where registered_students.year_id='$year_id' AND registered_students.school_id=schools.id
                AND schools.subdiv_id='".$rows['subdiv_id']."'   AND registered_students.subject_id='$subject_id' ") 
                    or die(mysqli_error($con));
                    $count=$number_of_reg_students->num_rows;
                    while($row_number_of_reg_students=$number_of_reg_students->fetch_assoc()){
                        $student_reg=$row_number_of_reg_students['reg_students'];
                        if($count<1){
                        echo  $num_student_reg=0;  
                        }
                        else {
                        echo  $num_student_reg=$student_reg;
                        }
                    
                    }?>    <br>      
                                    
                           <?php $total_per_subdiv=$num_student_reg*$rate_per_student;
                           
                           if($total_per_subdiv<1){
                            echo  0;
                           }
                           else {
                            echo number_format($total_per_subdiv);
                           }
                           
                           ?>   
                                
                                
                                
                                </th>
                    <?php } ?>  


      <?php }  ?>
                        </tr>
      <tr style="background:yellow" >
      <th></th>
      <th></th>
      <th>GRANT TOTAL</th>
      <th>CANDS
         <BR>
        AM'T
     </th>

     <?php
       
                    $check=$con->query("SELECT * FROM  specialities,subjects WHERE specialities.id=subjects.	specailty_id  order by subjects.subject_code ") 
                    or die(mysqli_error($con));
                    while($row=$check->fetch_assoc()){
                        $subject_id= $row['id'];
                    $rate_per_student= $row['rate_per_student'];
                ?>
                <th style="color:#00f"><?php  
                $number_of_reg_students=$con->query("SELECT SUM(registered_students.num_ofstudents) as reg_students
                FROM  registered_students   where registered_students.year_id='$year_id'  
                AND  registered_students.subject_id='$subject_id' ") 
                    or die(mysqli_error($con));
                    $count=$number_of_reg_students->num_rows;
                    while($row_number_of_reg_students=$number_of_reg_students->fetch_assoc()){
                        $student_reg=$row_number_of_reg_students['reg_students'];
                        if($count<1){
                        echo  $num_student_reg=0;  
                        }
                        else {
                        echo  $num_student_reg=$student_reg;
                        }
                    
                    }?>    <br>      
                                    
                           <?php $total_per_subdiv=$num_student_reg*$rate_per_student;
                           
                           if($total_per_subdiv<1){
                            echo  0;
                           }
                           else {
                            echo number_format($total_per_subdiv);
                           }
                           
                           ?>   
                                
                                
                                
                                </th>
                    <?php } ?>  

                        </tr>

     
      
    </tbody>
  </table>
  


                            <!-----GET ALL REGISTRATION CENTERS RECORDS------------->

 <!-----GET ALL REGISTRATION CENTERS RECORDS------------->

                                   
 <?php 
                                        
$get_reg_centers=$con->query("SELECT * FROM  schools,student_registration 
WHERE   schools.id=student_registration.school_id AND student_registration.acc_center_id='".$rows_acc_centers['school_id']."'
GROUP BY   student_registration.school_id ") or die(mysqli_error($con));       
$i=1;
while($rows_reg_centers=$get_reg_centers->fetch_assoc()){ 
?>  
<tr style="BACKGROUND:#FF0">
<td colspan="3"></td>
<td><?php echo $rows_reg_centers['center_num']; ?></td>
<td><?php echo $rows_reg_centers['school_name']; ?></td>
</tr>
<?PHP } ?>


<!-----END GET ALL REGISTRATION CENTERS RECORDS------------->



                             

 <?php  include 'config/db.php'; ?>
        
        <thead>
            <tr>
                <th data-field="StaffID" data-sortable="true">Staff ID</th>
                <th data-field="FirstName" data-sortable="true">Name</th>
                <th data-field="DOB" data-sortable="true">Date of Birth</th>
                <th data-field="Position" data-sortable="true">Position</th>
                <th data-field="Subject" data-sortable="true">Subject</th>
                <th data-field="Gender" data-sortable="true">Gender</th>
                <th data-field="Email" data-sortable="true">Email</th>
                <th data-field="Phone" data-sortable="true">Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
        
                    $query = "SELECT * FROM staff";
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error($conn));
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <td class="p-2"><?php echo $row["StaffID"];?></td>
                                <td class="p-2"><?php echo $row["FirstName"].' '.$row["LastName"];?></td>
                                <td class="p-2"><?php echo $row["DOB"];?></td> 
                                <td class="p-2"><?php echo $row["Position"];?></td> 
                                <td class="p-2"><?php echo $row["Subject"];?></td> 
                                <td class="p-2"><?php echo $row["Gender"];?></td> 
                                <td class="p-2"><?php echo $row["Email"];?></td> 
                                <td class="p-2"><?php echo $row["Phone"];?></td> 

                                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-staffid="<?php echo $row["StaffID"]; ?>" href="staff.php#editStaff"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-staffid="<?php echo $row["StaffID"]; ?>" href="staff.php#deleteStaff"><i class="fa fa-trash text-danger p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                                <?php endif; ?>
                                
                            </tr>
        
                                    <?php $num += 1; ?>
                            <?php endwhile ?>
                            <caption>Number of teachers : <span class="badge bg-success"><?php echo $num ;?></span></caption>
                                <?php
                        }else{
                            echo '<div class="alert alert-info">No Records to Show</div>';
                        }
                    }
        
                ?>
        </tbody>
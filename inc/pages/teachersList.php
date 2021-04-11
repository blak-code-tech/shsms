
 <?php  include 'config/db.php'; ?>
        
        <thead>
            <tr>
                <th data-field="StaffID" data-sortable="true">Staff ID</th>
                <th data-field="FirstName" data-sortable="true">First Name</th>
                <th data-field="LastName" data-sortable="true">Last Name</th>
                <th data-field="DOB" data-sortable="true">Date of Birth</th>
                <th data-field="Gender" data-sortable="true">Gender</th>
                <th data-field="Email" data-sortable="true">Email</th>
                <th data-field="Phone" data-sortable="true">Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
        
                    $query = "SELECT * FROM teachers";
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error());
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <td class="p-2"><?php echo $row["StaffID"];?></td>
                                <td class="p-2"><?php echo $row["FirstName"];?></td> 
                                <td class="p-2"><?php echo $row["LastName"];?></td> 
                                <td class="p-2"><?php echo $row["DOB"];?></td> 
                                <td class="p-2"><?php echo $row["Gender"];?></td> 
                                <td class="p-2"><?php echo $row["Email"];?></td> 
                                <td class="p-2"><?php echo $row["Phone"];?></td> 
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-teacherid="<?php echo $row["StaffID"]; ?>" href="teachers.php#editTeacher"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-teacherid="<?php echo $row["StaffID"]; ?>" href="teachers.php#deleteTeacher"><i class="fa fa-trash text-danger p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                            </tr>
        
                                    <?php $num += 1; ?>
                            <?php endwhile ?>
                            <caption>Number of students : <span class="badge bg-success"><?php echo $num ;?></span></caption>
                                <?php
                        }else{
                            echo '<div class="alert alert-info">No Records to Show</div>';
                        }
                    }
        
                ?>
        </tbody>

 <?php  include 'config/db.php'; $user = $_SESSION['UserType'];?>
        
        <thead>
            <tr>
                <?php if($user === 'student'):?>
                <th data-field="id">StudentID</th>
                <?php endif; ?> 
                <th data-field="DOB">Date of Birth</th>
                <th data-field="Gender">Gender</th>
                <th data-field="Email">Email</th>
                <?php if($user === 'staff' || $user === 'admin'):?>
                <th data-field="Phone">Phone</th>
                <?php endif; ?> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php

                    $query = '';
                    $id = $_SESSION['id'];
                    

                    if($user === 'staff'){
                        $query = "SELECT * FROM staff where StaffID = '$id'";
                    }
                    else if($user === 'student'){
                        $query = "SELECT * FROM students where StudentID = '$id'";
                    }
                    else if($user === 'admin'){
                        $query = "SELECT * FROM admins where ID = $id";
                    }
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed: '.mysqli_error($conn));
                    }else {
        
                        if ($check-> num_rows > 0 && $user !== 'admin'){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <?php if($_SESSION['UserType'] === 'student'):?>
                                <td class="p-2"><?php echo $row["StudentID"];?></td> 
                                <?php endif; ?>
                                <td class="p-2"><?php echo $row["DOB"];?></td> 
                                <td class="p-2"><?php echo $row["Gender"];?></td> 
                                <td class="p-2"><?php echo $row["Email"];?></td>
                                <?php if($_SESSION['UserType'] === 'staff'):?>
                                <td class="p-2"><?php echo $row["Phone"];?></td>
                                <?php endif; ?> 
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-profileid="<?php echo $row["StaffID"]; ?>" href="profile.php#editProfile"><i class="fa fa-pencil p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                                
                            </tr>

                            <?php endwhile ?>
                                <?php
                        }else{
        
                            $check = mysqli_query($conn, $query);
                            if($check){
                                
                                while ($row = mysqli_fetch_assoc($check)):?>
                                    <tr>
                                        <td><?php echo $row["DOB"];?></td> 
                                        <td><?php echo $row["Gender"];?></td> 
                                        <td><?php echo $row["Email"];?></td> 
                                        <td><?php echo $row["Phone"];?></td> 
                                        <td>
                                            <div class="col">
                                                <div class="btn-group" role="group">
                                                    <a data-bs-toggle="modal" data-profileid="<?php echo $row["StaffID"]; ?>" href="profile.php#editProfile"><i class="fa fa-pencil p-1"></i></a>
                                                </div>
                                            </div>
                
                                        </td>
                                        
                                    </tr>
        
                                    <?php endwhile ?>
                                    <?php
                            }
                            else{
                                echo '<div class="alert alert-info">No Records to Show</div>';
                            }
                        }
                        }
        
                ?>
        </tbody>
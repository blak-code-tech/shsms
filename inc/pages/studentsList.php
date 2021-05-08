
 <?php  include 'config/db.php'; ?>
        
<thead>
    <tr>
        <th data-field="StudentID" data-sortable="true">Student ID</th>
        <th data-field="Name" data-sortable="true">Name</th>
        <th data-field="DOB">Date Of Birth</th>
        <th data-field="Email">Email</th>
        <th data-field="Gender">Gender</th>
        <th data-field="classID">Form</th>
        <th data-field="courseID">Course</th>
        <th data-field="hostelID">Hostel</th>
        <th data-field="parentID">Parent</th>
        
        <th>Actions</th>
    </tr>
</thead>
<tbody>
        <?php

            $num = 0;

            $query = "SELECT * FROM students";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));
            }else {

                if ($check-> num_rows > 0){?>

                    <?php while ($row = mysqli_fetch_assoc($check)):?>
                    <tr class="p-1">
                        <td class="p-2"><?php echo $row["StudentID"];?></td>
                        <td class="p-2"><?php echo $row["FirstName"].' '. $row["LastName"];?></td>
                        <td class="p-2"><?php echo $row["DOB"];?></td>
                        <td class="p-2"><?php echo $row["Email"];?></td>
                        <td class="p-2"><?php echo $row["Gender"];?></td>
                        <td class="p-2"><?php echo $row["ClassID"];?></td>
                        <td class="p-2"><?php echo $row["CourseID"];?></td>
                        <td class="p-2"><?php echo $row["HostelID"];?></td>
                        <td class="p-2"><?php echo $row["ParentID"];?></td>    
                        <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                        <td class="p-2">
                            <div class="col">
                                <div class="btn-group" role="group">
                                    <a data-bs-toggle="modal" data-studentid="<?php echo $row["StudentID"]; ?>" href="students.php#editStudent"><i class="fa fa-pencil p-1"></i></a>
                                    <a data-bs-toggle="modal" data-studentid="<?php echo $row["StudentID"]; ?>" href="students.php#deleteStudent"><i class="fa fa-trash text-danger p-1"></i></a>
                                </div>
                            </div>

                        </td>
                        <?php endif; ?>
                    </tr>

                            <?php $num += 1; ?>
                    <?php endwhile ?>
                    <caption>Number of students : <span class="badge bg-success"><?php echo $num ;?></span></caption>
                        <?php
                }else{
                    echo '<div class="alert alert-info">No Records to Show</div>';
                }
            }

            /*require 'deleteUpdate.php';*/

        ?>
</tbody>
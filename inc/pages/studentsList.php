
 <?php  include 'config/db.php'; ?>
        
<thead>
    <tr>
        <th data-field="RegNo." data-sortable="true">Reg No.</th>
        <th data-field="FirstName" data-sortable="true">FirstName</th>
        <th data-field="LastName" data-sortable="true">LastName</th>
        <th data-field="Gender" data-sortable="false">Gender</th>
        <th data-field="Hostel" data-sortable="false">Hostel</th>
        <th data-field="Class" data-sortable="true">Class</th>
        <th data-field="TotalFees" data-sortable="false">Total Fees</th>
        <th data-field="AdvanceFees" data-sortable="true">Advanced Fees</th>
        <th data-field="Balance" data-sortable="true">Balance</th>
        <th data-field="Guardian" data-sortable="false">Guardian</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
        <?php

            $num = 0;

            $query = "SELECT * FROM students";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error());
            }else {

                if ($check-> num_rows > 0){?>

                    <?php while ($row = mysqli_fetch_assoc($check)):?>
                    <tr class="p-1">
                        <td class="p-2"><?php echo $row["RegNo"];?></td>
                        <td class="p-2"><?php echo $row["FirstName"];?></td>
                        <td class="p-2"><?php echo $row["LastName"];?></td>
                        <td class="p-2"><?php echo $row["Gender"];?></td>
                        <td class="p-2"><?php echo $row["Hostel"];?></td>
                        <td class="p-2"><?php echo $row["Class"];?></td>
                        <td class="p-2"><?php echo $row["TotalFees"];?></td>
                        <td class="p-2"><?php echo $row["AdvanceFees"];?></td>
                        <td class="p-2"><?php echo $row["Balance"];?></td>
                        <td class="p-2"><?php echo $row["Guardian"];?></td>    
                        <td class="p-2">
                            <div class="col">
                                <div class="btn-group" role="group">
                                    <a data-bs-toggle="modal" data-studentid="<?php echo $row["ID"]; ?>" href="students.php#editStudent"><i class="fa fa-pencil p-1"></i></a>
                                    <a data-bs-toggle="modal" data-studentid="<?php echo $row["ID"]; ?>" href="students.php#deleteStudent"><i class="fa fa-trash text-danger p-1"></i></a>
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

            /*require 'deleteUpdate.php';*/

        ?>
</tbody>
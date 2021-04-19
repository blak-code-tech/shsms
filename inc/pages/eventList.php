
 <?php  include 'config/db.php'; ?>
        
        <thead>
            <tr>
                <th data-field="ID" data-sortable="true">ID</th>
                <th data-field="Name" data-sortable="true">Name</th>
                <th data-field="Date" data-sortable="true">Date</th>
                <th data-field="Details">Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
        
                    $query = "SELECT * FROM events";
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error());
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <td class="p-2"><?php echo $row["ID"];?></td>
                                <td class="p-2"><?php echo $row["Name"];?></td> 
                                <td class="p-2"><?php echo $row["Date"];?></td> 
                                <td class="p-2"><?php echo $row["Details"];?></td>
                                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-eventid="<?php echo $row["ID"]; ?>" href="events.php#editEvent"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-eventid="<?php echo $row["ID"]; ?>" href="events.php#deleteEvent"><i class="fa fa-trash text-danger p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                                <?php endif; ?>
                            </tr>
        
                                    <?php $num += 1; ?>
                            <?php endwhile ?>
                            <caption>Number of events : <span class="badge bg-success"><?php echo $num ;?></span></caption>
                                <?php
                        }else{
                            $msg = 'No Records to Show';
                            $msgClass = 'alert-info';

                            echo '<div class="alert '.$msgClass.'">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            '.$msg.' </div>';
                        }
                    }
        
                ?>
        </tbody>
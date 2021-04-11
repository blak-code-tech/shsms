
 <?php  include 'config/db.php'; ?>
        
        <thead>
            <tr>
                <th data-field="RegNo" data-sortable="true">Registration No</th>
                <th data-field="Date" data-sortable="true">Date</th>
                <th data-field="PaidAmount" data-sortable="true">Paid Amount</th>
                <th data-field="Arrears" data-sortable="true">Arrears</th>
                <th data-field="Balance" data-sortable="true">Balance</th>
                <th data-field="Remarks">Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
        
                    $query = "SELECT * FROM feescollection";
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error());
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <td class="p-2"><?php echo $row["Student"];?></td>
                                <td class="p-2"><?php echo $row["Date"];?></td> 
                                <td class="p-2"><?php echo $row["PaidAmount"];?></td> 
                                <td class="p-2"><?php echo $row["Arrears"];?></td> 
                                <td class="p-2"><?php echo $row["Balance"];?></td> 
                                <td class="p-2"><?php echo $row["Remarks"];?></td> 
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-feescollectionid="<?php echo $row["ID"]; ?>" href="feescollection.php#editFeesCollection"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-feescollectionid="<?php echo $row["ID"]; ?>" href="feescollection.php#deleteFeesCollection"><i class="fa fa-trash text-danger p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                            </tr>
        
                                    <?php $num += 1; ?>
                            <?php endwhile ?>
                            <caption>Number of students : <span class="badge bg-success"><?php echo $num ;?></span></caption>
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
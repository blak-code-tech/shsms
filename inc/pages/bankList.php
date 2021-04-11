
 <?php  include 'config/db.php'; ?>
        
        <thead>
            <tr>
                <th data-field="ID" data-sortable="true">ID</th>
                <th data-field="Bank" data-sortable="true">Bank</th>
                <th data-field="Account Number" data-sortable="true">Account Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
        
                    $query = "SELECT * FROM banks";
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error());
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <td class="p-2"><?php echo $row["ID"];?></td>
                                <td class="p-2"><?php echo $row["Name"];?></td> 
                                <td class="p-2"><?php echo $row["Account_No"];?></td> 
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-bankid="<?php echo $row["ID"]; ?>" href="banks.php#editBank"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-bankid="<?php echo $row["ID"]; ?>" href="banks.php#deleteBank"><i class="fa fa-trash text-danger p-1"></i></a>
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
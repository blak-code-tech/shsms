
 <?php  include 'config/db.php';
        $user = $_SESSION['UserType'];?>
        
        <thead>
            <tr>
                <?php if($user === 'admin' || $user === 'teacher'):?>
                <th data-field="id" data-sortable="true">ID</th>
                <?php endif; ?>
                <th data-field="studentid" data-sortable="true">StudentID</th>
                <th data-field="Exam">Category</th>
                <th data-field="Score" data-sortable="true">Score</th>
                <th data-field="Grade" data-sortable="true">Grade</th>
                <th data-field="GradedBy">Graded By</th>
                <?php if($user === 'admin' || $user === 'teacher'):?>
                <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
                <?php
        
                    $num = 0;
                    if($user === 'admin' || $user === 'teacher'){

                        $query = "SELECT * FROM exams";
                    }
                    else if($user === 'student'){
                        $id = $_SESSION['id'];
                        $query = "SELECT * FROM exams where `StudentID` = '$id'";
                    }
        
                    $check = mysqli_query($conn, $query);
        
                    if (!$check) {
                        die('Query failed'.mysqli_error($conn));
                    }else {
        
                        if ($check-> num_rows > 0){?>
        
                            <?php while ($row = mysqli_fetch_assoc($check)):?>
                            <tr class="p-1">
                                <?php if($user === 'admin' || $user === 'teacher'):?>
                                <td><?php echo $row["ID"];?></td>
                                <?php endif; ?>
                                <td><?php echo $row["StudentID"];?></td> 
                                <td><?php echo getItem('examcategory',$row["ExamCategory"]);?></td> 
                                <td><?php echo $row["Score"];?></td>
                                <td><?php echo $row["Grade"];?></td> 
                                <td><?php echo $row["GradedBy"];?></td> 
                                <?php if($user === 'admin' || $user === 'teacher'):?>
                                <td class="p-2">
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <a data-bs-toggle="modal" data-examresultsid="<?php echo $row["ID"]; ?>" href="examresults.php#editExamResults"><i class="fa fa-pencil p-1"></i></a>
                                            <a data-bs-toggle="modal" data-examresultsid="<?php echo $row["ID"]; ?>" href="examresults.php#deleteExamResults"><i class="fa fa-trash text-danger p-1"></i></a>
                                        </div>
                                    </div>
        
                                </td>
                                <?php endif; ?>
                            </tr>
        
                                    <?php $num += 1; ?>
                            <?php endwhile ?>
                            <caption>Number of banks : <span class="badge bg-success"><?php echo $num ;?></span></caption>
                                <?php
                        }else{
                            echo '<div class="alert alert-info">No Records to Show</div>';
                        }
                    }
        
                ?>
        </tbody>
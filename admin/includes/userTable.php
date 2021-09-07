<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Application Number</th>
                    <th>Surname</th>
                    <th>First Name</th>
                    <th>Other Names</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['Application_no'] ?></td>
                        <td><?php echo $row['surname'] ?></td>
                        <td><?php echo $row['firstname'] ?></td>
                        <td><?php echo $row['othername'] ?></td>
                        <td><?php echo $row['sex'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td>
                            <a href="user.php?application=<?php echo $row['Application_no'] ?>" class="btn btn-sm btn-primary">View Details</a>
                            <!-- <a href="delete.php?application=<?php echo $row['Application_no'] ?>" class="btn btn-sm btn-danger">Delete</a> -->
                        </td>
                    </tr>  
                <?php endwhile ?>
            </tbody>
        </table>
        
        <?php if($users == []) : ?>
        <h1 class="text-center"><i class="fas fa-folder"></i></h1>
        <h4 class="text-center">Sorry, No Users found</h4>
        <?php endif ?>
    </div>
    <!-- /.card-body -->
</div>
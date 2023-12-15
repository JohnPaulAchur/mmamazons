<?php


include 'header.php';


?>



<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Accounts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Accounts</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                               Manage and Control accounts.
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header inline-echo">
                                <div><i class="fas fa-user"></i>
                                    Active Accounts
                                </div>
                            <div style="margin: 0 auto;">
                            <?php
                            
                                if (isset($_SESSION['delete'])) {
                                   echo $_SESSION['delete'];
                                   unset($_SESSION['delete']);
                                }
                            
                            ?>
                             </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="display">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>E-mail Address</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                        $sn=1;
                                        $sql = "SELECT * FROM admin ORDER BY id DESC";
                                        $data = mysqli_query($connect, $sql);
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $id = $row['id'];
                                            $username = $row['username'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $role = $row['role'];
                                        
                                        ?>
                                        <tr>
                                                <td><?php echo $sn++; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $phone; ?></td>
                                                <td><?php echo $role; ?></td>
                                                <td width="3%">
                                                    <a href="del_admin.php?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete Account?')"><i class="text-danger fa fa-trash"></i></a>
                                                </td>
                                  
                                            
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>E-mail Address</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
    



<?php


include 'footer.php';


?>
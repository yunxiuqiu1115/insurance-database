<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
                <th>Applicant SSN</th>
                <th>Applicant Name</th>
                <th>Applicant Age</th>
                <th>Applicant Gender</th>
                <th>Applicant Career</th>
                <th>Manager ID</th>
                <th>Applicant Password</th>
            </tr>
            
        </thead>
        <?php
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
            <form method="post" action="Delete_Applicant.php">
                <td><?php echo $row['App_ssn']?></td>
                <td><?php echo $row['App_name']?></td>
                <td><?php echo $row['App_age']?></td>
                <td><?php echo $row['App_gender']?></td>
                <td><?php echo $row['App_career']?></td>
                <td><?php echo $row['Mgr_id']?></td>
                <td><?php echo $row['App_pass']?></td>
                <?php 
                    session_start();
                    $_SESSION['App_ssn'] = $row['App_ssn'];
                ?>
                <td><input type="submit" value="Delete"></td>
            </form>
            </tr>
            
        <?php
            }
        ?>
    </table>
</div>
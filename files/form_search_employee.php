<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
            </tr>
        </thead>

        <?php
        while($row = $result->fetch_assoc()){
        ?>
            <tr>
            <form method="post" action="Delete_Employee.php">
                <td><?php echo $row['Ee_id']?></td>
                <td><?php echo $row['Ee_name']?></td>
                <?php 
                    session_start();
                    $_SESSION['Ee_id'] = $row['Ee_id'];
                ?>
                <td><input type="submit" value="Delete"></td>
            </form>
            </tr>

        <?php
            }
        ?>
    </table>
</div>

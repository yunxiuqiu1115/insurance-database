<div class="table-wrapper">
        <table class="alt">
            <thead>
                <tr>
                <th>Insurance ID</th>
                <th>Insurance Name</th>
                <th>Insurance Type</th>
                <th>Policy Period</th>
                <th>Minimal Premium</th>
                <th>Maximum Insured</th>
                </tr>
            </thead>
    
            <?php
                while($row = $result->fetch_assoc()){
            ?>
                    <tr>
                    <form method="post" action="Delete_Insurance.php">
                        <td><?php echo $row['Ins_id']?></td>
                        <td><?php echo $row['Ins_name']?></td>
                        <td><?php echo $row['Ins_type']?></td>
                        <td><?php echo $row['Policy_period']?></td>
                        <td><?php echo $row['Min_premium']?></td>
                        <td><?php echo $row['Max_insured']?></td>
                        <?php 
                            session_start();
                            $_SESSION['Ins_id'] = $row['Ins_id'];
                        ?>
                        <td><input type="submit" value="Delete"></td>
                    </form>
                    </tr>
            <?php
                }
            ?>
        </table>
</div>

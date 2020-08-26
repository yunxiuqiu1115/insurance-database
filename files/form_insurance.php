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
                        <td><?php echo $row['Ins_id']?></td>
                        <td><?php echo $row['Ins_name']?></td>
                        <td><?php echo $row['Ins_type']?></td>
                        <td><?php echo $row['Policy_period']?></td>
                        <td><?php echo $row['Min_premium']?></td>
                        <td><?php echo $row['Max_insured']?></td>
                    </tr>
            <?php
                }
            ?>
        </table>
</div>

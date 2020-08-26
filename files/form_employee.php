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
                <td><?php echo $row['Ee_id']?></td>
                <td><?php echo $row['Ee_name']?></td>
            </tr>

        <?php
            }
        ?>
    </table>
</div>

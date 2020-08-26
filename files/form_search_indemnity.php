<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
                <th>Indemnity Number</th>
                <th>Policy Number</th>
                <th>Indemnity Date</th>
                <th>Real Benefit</th>
            </tr>
        </thead>

        <?php
        while($row = $result->fetch_assoc()){
        ?>
            <tr>
            <form method="post" action="Delete_Indemnity.php">
                <td><?php echo $row['Indem_no']?></td>
                <td><?php echo $row['Policy_no']?></td>
                <td><?php echo $row['Indem_date']?></td>
                <td><?php echo $row['Real_benefit']?></td>
                <?php 
                    session_start();
                    $_SESSION['Indem_no'] = $row['Indem_no'];
                ?>
                <td><input type="submit" value="Delete"></td>
            </form>
            </tr>
        <?php
            }
        ?>
    </table>
</div>	
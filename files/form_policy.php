<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
            <th>Policy Number</th>
            <th>Applicant SSN</th>
            <th>Insurance ID</th>
            <th>Effective Date</th>
            <th>Real Premium</th>
            <th>Real Insured</th>
            </tr>
        </thead>
        
        <?php
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['Policy_no']?></td>
                <td><?php echo $row['App_ssn']?></td>
                <td><?php echo $row['Ins_id']?></td>
                <td><?php echo $row['Eff_date']?></td>
                <td><?php echo $row['Real_premium']?></td>
                <td><?php echo $row['Real_insured']?></td>
            </tr>
        <?php
            }
        ?>
    </table>                  
</div>
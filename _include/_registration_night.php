<table>
    <tr>
        <td><p><span>活動梯次：</span></p></td>
        <td>1-<? echo $row['Batch'] ?></td>
    </tr>
    <tr>
        <td><p><span>活動名稱：</span></p></td>
        <td><? echo $row['ActivityName'] ?></td>
    </tr>
    <tr>
        <td><p><span>活動日期：</span></p></td>
        <td><? echo date("Y-m-d", strtotime($row["StartDate"])) ?> ~ <? echo date("Y-m-d", strtotime($row["EndDate"])) ?></td>
    </tr>
    <tr>
        <td><p><span>活動地點：</span></p></td>
        <td><span style="white-space: pre-line; color: black;"><? echo $row['Location'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>活動營地：</span></p></td>
        <td><span style="white-space: pre-line; color: black;"><? echo $row['Campsite'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>活動費用：</span></p></td>
        <td><span style="white-space: pre-line; color: black;" id="actCost"><? echo $row['Cost'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>名額限制：</span></p></td>
        <td><? echo $row['VehicleFleetSize'] ?>車</td>
    </tr>
</table>
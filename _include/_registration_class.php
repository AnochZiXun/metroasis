<table>
    <tr>
        <td><p><span>活動梯次：</span></p></td>
        <td>2-<? echo $row['Batch'] ?></td>
    </tr>
    <tr>
        <td><p><span>活動名稱：</span></p></td>
        <td><? echo $row['ActivityName'] ?></td>
    </tr>
    <tr>
        <td><p><span>活動日期：</span></p></td>
        <td><? echo date("Y-m-d", strtotime($row["ActivityDate"])) ?></td>
    </tr>
    <tr>
        <td><p><span>集合時間：</span></p></td>
        <td><span style="white-space: pre-line; color: black;"><? echo $row['GatheringTime'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>集合地點：</span></p></td>
        <td><span style="white-space: pre-line; color: black;"><? echo $row['Venue'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>活動費用：</span></p></td>
        <td><span style="white-space: pre-line; color: black;" id="actCost"><? echo $row['Cost'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>名額限制：</span></p></td>
        <td><? echo $row['Quota'] ?>人</td>
    </tr>
</table>
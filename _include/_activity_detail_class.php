<div style="text-align: -webkit-center">
    <object data="<? echo $row['PromotePicture'] ?>" type="image/png" class="img-responsive">
        <img src="images/no_image.jpg" class="img-responsive">
    </object>
</div>
<h2><? echo $row['ActivityName'] ?></h2>
<?
    $sql = "SELECT CodeName FROM RefCommon R WHERE Type = 'activityCategory' AND TypeCode='$category'";
    $record = mysql_query($sql);
    $result = mysql_fetch_assoc($record);
?>
<p style="width:106px; height:22px; line-height: 22px; background-color: #ff8c3f; border-radius:5px; font-size: 11px; color: #fff; margin: 10px 0; text-align: center;">
    <? echo $result["CodeName"] ?>
</p>
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
        <td><span style="white-space: pre-line; color: black;"><? echo $row['Cost'] ?></span></td>
    </tr>
    <tr>
        <td><p><span>名額限制：</span></p></td>
        <td><? echo $row['Quota'] ?>人</td>
    </tr>
</table>

<hr>
<p><span><i class="fa fa-star" aria-hidden="true"></i> 詳細說明</span></p>
<p><? echo $row['Content'] ?></p>

<div style="margin:10px auto;">
    <a href="activity.php?page=1<? echo '&status='.$status.'&category='.$category.'&selectCategory='.$selectCategory ?>"><button style="float: left; width: 30%; margin: 20px 0; padding: 10px 30px; font-size: 16px;" type="button" class="btn btn-success btn-lg"><i class="fa fa-reply" aria-hidden="true"></i> 回活動列表</button></a>
    <?php
    $rec_enrollCheck = mysql_query("SELECT COUNT(*) AS Count FROM ActivityEnrollment WHERE ActType = '$category' AND ActivityID = '$activityId' AND CustomerID = '$customerId'");
    $row_enrollCheck = mysql_fetch_assoc($rec_enrollCheck);
    if($row_enrollCheck["Count"] > 0){
    ?>
        <button style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px; font-size: 16px;" type="button" class="btn btn-lg"> 您已經報名</button>
    <?php
    }else{
    ?>
        <a href="registration.php?activityId=<? echo $activityId ?>&category=<? echo $category ?>"><button style="float: right; width: 30%; margin: 20px 0; padding: 10px 30px; font-size: 16px;" type="button" class="btn btn-success btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> 我要報名</button></a>
    <?php
    }
    ?> 
</div>
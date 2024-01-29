<?php include 'header.php'; ?> 
<?php 
$titlename="";
$readonly="";
$action="memberdetail.php";
$titlename="新增會員";
$title=isset($_GET['title']) ? $_GET['title'] : "";
$id=isset($_GET['id']) ? $_GET['id'] : "";
if($title == ""){
    $mId = isset($_POST['mId']) ? $_POST['mId'] : "";
    $mName = isset($_POST['mName']) ? $_POST['mName'] : "";
    $mPassword =  isset($_POST['mPassword']) ? $_POST['mPassword'] : "";
    $arName =  isset($_POST['arName']) ? $_POST['arName'] : "";
    if (isset($_POST['mId'])) {
        if ($mId != "" && $mName != "" && $mPassword != "" && $mArea != "") {
            include "db_open.php";
            $sql1 = " SELECT member.mId, member.mName, member.mPassword, area.arName 
                    FROM `member` 
                    left join `area` 
                    on member.mArea = area.arId 
                    WHERE member.mId = '$mId' ";
            if (mysqli_num_rows(mysqli_query($link, $sql1)) != 0) {
                echo ('<script>alert("該會員帳號已使用");</script>');
            } else {
                //$sql = "INSERT INTO admin (`aId`, `aName`, `aPassword`) VALUES ('$aId', '$aName', '$aPassword')";
                if ($result = mysqli_query($link, $sql)) {
                    echo "<script>redirectDiallog('member.php', 'ID: $aId 的資料已新增!');</script>";
                } else {
                    echo ('<script>alert("新增失敗");</script>');
                }
            }
        } else {
        echo ('<script>alert("請輸入完整資料");</script>');
        }
    }
}else if($title == "edit"){
    $readonly="readonly";
    $titlename="修改會員";
    $action="memberdetail.php?title=edit&id=$id";
    include "db_open.php";
    $sql = " SELECT member.mId, member.mName, member.mPassword, area.arName 
               FROM `member` 
               left join `area` 
               on member.mArea = area.arId 
                WHERE member.mId = '$id' ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $mId=$row['mId'];
    $mName=$row['mName'];
    $mPassword=$row['mPassword'];
    if (isset($_POST['mId'])) {
        $mId = isset($_POST['mId']) ? $_POST['mId'] : "";
        $mName = isset($_POST['mName']) ? $_POST['mName'] : "";
        $mPassword =  isset($_POST['mPassword']) ? $_POST['mPassword'] : "";
        if ($mId != "" && $mName != "" && $mPassword != "") {
            include "db_open.php";
                $sql = "UPDATE `admin` SET `aName` = '$aName',`aPassword` = '$aPassword' WHERE `admin`.`aId` = $aId";
                if ($result = mysqli_query($link, $sql)) {
                    echo "<script>redirectDiallog('member.php', 'ID: $mId 的資料已修改!');</script>";
                } else {
                    echo ('<script>alert("修改失敗");</script>');
                }
        }else{
        echo ('<script>alert("請輸入完整資料");</script>');
        }
    } 
}
?> 
<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2><?=$titlename?></h2><Br />
            <div class="row"> </div>
        </div>
        <div class="card-body">
            <div class="horizontal-form">
                <form class="form-horizontal" action=<?=$action?> method="post">
                    <div class="form-group"> <label class="col-sm-2 control-label">會員帳號：</label>
                        <div class="col-sm-10"> <input type="text" name="mId" class="form-control" placeholder="管理者帳號" value="<?=$mId?>" <?=$readonly?>></div>
                    </div>
                    <div class="form-group"> <label class="col-sm-2 control-label">會員名稱：</label>
                        <div class="col-sm-10"> <input type="text" name="mName" class="form-control" placeholder="管理者名稱" value="<?=$mName?>"> </div>
                    </div>
                    <div class="form-group"> <label class="col-sm-2 control-label">會員密碼：</label>
                        <div class="col-sm-10"> <input type="text" name="mPassword" class="form-control" placeholder="密碼" value="<?=$mPassword?>"> </div>
                    </div>
                    <div class="form-group"> <label class="col-sm-2 control-label">會員地區：</label>
                        <div class="col-sm-10"> <select class="form-control" name="arName">
                                                    <option disabled selected>請選擇你的地區</option>
                                                    <option value="1">美國</option>
                                                    <option value="2">加拿大</option>
                                                    <option value="3">英國</option>
                                                </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10"> <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button> <a href="admin.php"><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a> </div>
                    </div>
                    <div class="form-group"> </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /# column --> </div> <?php include 'footer.php'; ?>
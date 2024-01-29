<?php include 'header.php'; ?> 
<?php 
$titlename="";
$readonly="";
$action="admindetail.php";
$titlename="新增管理者";
$title=isset($_GET['title']) ? $_GET['title'] : "";
$id=isset($_GET['id']) ? $_GET['id'] : "";
if($title == ""){
    $aId = isset($_POST['saId']) ? $_POST['saId'] : "";
    $aName = isset($_POST['saName']) ? $_POST['saName'] : "";
    $aPassword =  isset($_POST['saPassword']) ? $_POST['saPassword'] : "";
    if (isset($_POST['saId'])) {
        if ($aId != "" && $aName != "" && $aPassword != "") {
            include "db_open.php";
            $sql1 = "SELECT admin.aId,admin.aName,admin.aPassword FROM admin WHERE admin.aId = '$aId' ";
            if (mysqli_num_rows(mysqli_query($link, $sql1)) != 0) {
                echo ('<script>alert("該管理帳號已使用");</script>');
            } else {
                $sql = "INSERT INTO admin (`aId`, `aName`, `aPassword`) VALUES ('$aId', '$aName', '$aPassword')";
                if ($result = mysqli_query($link, $sql)) {
                    echo "<script>redirectDiallog('admin.php', 'ID: $aId 的資料已新增!');</script>";
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
    $titlename="修改管理者";
    $action="admindetail.php?title=edit&id=$id";
    include "db_open.php";
    $sql = "SELECT admin.aId,admin.aName,admin.aPassword FROM admin WHERE admin.aId = '$id' ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $aId=$row['aId'];
    $aName=$row['aName'];
    $aPassword=$row['aPassword'];
    if (isset($_POST['saId'])) {
        $aId = isset($_POST['saId']) ? $_POST['saId'] : "";
        $aName = isset($_POST['saName']) ? $_POST['saName'] : "";
        $aPassword =  isset($_POST['saPassword']) ? $_POST['saPassword'] : "";
        if ($aId != "" && $aName != "" && $aPassword != "") {
            include "db_open.php";
                $sql = "UPDATE `admin` SET `aName` = '$aName',`aPassword` = '$aPassword' WHERE `admin`.`aId` = $aId";
                if ($result = mysqli_query($link, $sql)) {
                    echo "<script>redirectDiallog('admin.php', 'ID: $aId 的資料已修改!');</script>";
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">管理者帳號：</label>
                        <div class="col-sm-10">
                            <input type="text" name="saId" class="form-control" placeholder="管理者帳號" value="<?=$aId?>" <?=$readonly?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">管理者名稱：</label>
                        <div class="col-sm-10">
                            <input type="text" name="saName" class="form-control" placeholder="管理者名稱" value="<?=$aName?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密碼：</label>
                        <div class="col-sm-10">
                            <input type="text" name="saPassword" class="form-control" placeholder="密碼" value="<?=$aPassword?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                <i class="ti-check"></i>確認
                            </button>
                            <a href="admin.php"> 
                                <button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5">
                                    <i class="ti-close"></i>離開
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="form-group"> </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /# column --> </div> <?php include 'footer.php'; ?>
<?php include 'header.php'; ?> 
<?php 
$readonly="";//預設新增會員時Id可修改,readonly為空值
$titlename="新增會員";
$title=isset($_GET['title']) ? $_GET['title'] : "";
$id=isset($_GET['id']) ? $_GET['id'] : "";
//預設空值為新增會員
if($title == ""){
    include "db_open.php";
    //因同一支程式有兩種功能,故將form action設為變數,並夾帶上各功能所需之值
    $action="memberdetail.php";
    // 開場讀取為空值,新增會員送出自回傳抓到值後再判別
    $mId = isset($_POST['mId']) ? $_POST['mId'] : "";
    $mName = isset($_POST['mName']) ? $_POST['mName'] : "";
    $mPassword =  isset($_POST['mPassword']) ? $_POST['mPassword'] : "";
    $arName =  isset($_POST['arName']) ? $_POST['arName'] : "";
    $mArea = isset($_POST['arId']) ? $_POST['arId'] : "";
    // 點擊確認送出後,開始辨別是否為空等
    if (isset($_POST['mId'])) {
        //判斷新增資料是否有空
        if ($mId != "" && $mName != "" && $mPassword != "" && $mArea != "") {
            // 查詢該帳號是否有被使用
            $sql1 = " SELECT m.mId 
                    FROM `member` As `m`
                    left join `area` As `a`
                    on m.mArea = a.arId 
                    WHERE m.mId = '$mId' ";
            //計算$sql1的資料筆數,若不為0代表已使用
            if (mysqli_num_rows(mysqli_query($link, $sql1)) != 0) {
                echo ('<script>alert("該會員帳號已使用");</script>');
            } else {
                $sql = "INSERT INTO `member` (`mId`, `mName`, `mPassword`, `mArea`) 
                        VALUES ('$mId', '$mName', '$mPassword', '$mArea')";
                if ($result = mysqli_query($link, $sql)) {
                    echo "<script>redirectDiallog('member.php', 'ID: $mId 的資料已新增!');</script>";
                } else {
                    echo ('<script>alert("新增失敗");</script>');
                }
            }
        } else {
        // 有空值,報錯
        echo ('<script>alert("請輸入完整資料");</script>');
        }
    }
// edit為修改會員
}else if($title == "edit"){
    $readonly="readonly";//修改會員時Id唯獨
    $titlename="修改會員";
    //因同一支程式有兩種功能,故將form action設為變數,並夾帶上各功能所需之值
    $action="memberdetail.php?title=edit&id=$id";
    include "db_open.php";
    //查詢該會員所需修改的原會員資料
    $sql = " SELECT member.mId, member.mName, member.mPassword, member.mArea, area.arId, area.arName 
               FROM `member` 
               left join `area` 
               on member.mArea = area.arId 
                WHERE member.mId = '$id' ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    //將原會員資料傳入顯示所需之變數
    $mId=$row['mId'];
    $mName=$row['mName'];
    $mPassword=$row['mPassword'];
    $arId=$row['arId'];
    if (isset($_POST['mId'])) {
        // 修改會員送出後將送出值丟進變數
        $mId = isset($_POST['mId']) ? $_POST['mId'] : "";
        $mName = isset($_POST['mName']) ? $_POST['mName'] : "";
        $mPassword = isset($_POST['mPassword']) ? $_POST['mPassword'] : "";
        $mArea = isset($_POST['arId']) ? $_POST['arId'] : "";
        //判斷修改資料是否有空
        if ($mId != "" && $mName != "" && $mPassword != "" && $mArea != "") {
            include "db_open.php";
                $sql = "UPDATE `member` 
                        SET mName = '$mName',
                            mPassword = '$mPassword',
                            mArea = '$mArea' 
                        WHERE member.mId = $mId;";
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">會員帳號：</label>
                        <div class="col-sm-10">
                            <input type="text" name="mId" class="form-control" placeholder="管理者帳號" value="<?=$mId?>" <?=$readonly?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">會員名稱：</label>
                        <div class="col-sm-10"> 
                            <input type="text" name="mName" class="form-control" placeholder="管理者名稱" value="<?=$mName?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">會員密碼：</label>
                        <div class="col-sm-10">
                            <input type="text" name="mPassword" class="form-control" placeholder="密碼" value="<?=$mPassword?>">
                        </div>
                    </div>
                    <div class="form-group"> <label class="col-sm-2 control-label">會員地區：</label>
                        <div class="col-sm-10"> 
                        
                            <select class="form-control" name="arId">
                                <?php
                                
                                $sql2 = " SELECT area.arId,area.arName FROM `area`";
                                $result_area = mysqli_query($link, $sql2);
                                if($arId == ""){
                                    echo("<option disabled selected>請選擇你的地區</option>\n");
                                    while( $row = mysqli_fetch_assoc($result_area)){
                                        echo("<option value=\"".$row['arId']."\">".$row['arName']."</option>\n");
                                    }
                                }else{
                                    while( $row = mysqli_fetch_assoc($result_area)){
                                        if($arId == $row['arId']){
                                            echo("<option selected value=\"".$row['arId']."\">".$row['arName']."</option>\n");
                                        }else{
                                            echo("<option value=\"".$row['arId']."\">".$row['arName']."</option>\n");
                                        }
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                <i class="ti-check"></i>確認
                            </button>
                            <a href="member.php"> 
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
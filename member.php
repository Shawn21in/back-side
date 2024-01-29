<?php include 'header.php'; ?>
	<?php
        if(isset($_GET['mode'])){
            $mode=$_GET['mode'];
            switch($mode){
                case "delete":
                    $id = $_GET['id'];
                    //$mode="";
                    include "db_open.php";
                    $sql = "DELETE FROM `member` WHERE mId = '$id'";
                    if($result = mysqli_query($link,$sql)){
                        //echo"<script>alert('ID: $id 的資料已刪除!');</script>";
                         echo"<script>redirectDiallog('member.php', 'ID: $id 的資料已刪除!');</script>";
                    }else{
                        echo"<script>alert('刪除失敗!');</script>";
                        // echo"<script>redirectDiallog('admin.php', '$mode', '刪除失敗');</script>";
                    }
                    break;
            }
        }
    ?>			
<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>會員資料管理</h2><Br/>
				<div class="row">
					<a href="memberdetail.php" ><button type="button" class="col-lg-2 btn btn-primary btn-flat btn-addon m-b-10 m-l-20"><i class="ti-plus"></i>新增會員 </button></a>
						<div class="basic-form col-lg-8">
                            <form action="member.php" method="get">
                                <div class="form-group">
                                    <div class="input-group input-group-default">
                                        <input type="text" placeholder="Search Round" name="Search" class="form-control">
                                        <span class="input-group-btn"><button class="btn btn-primary btn-group-right" type="submit"><i class="ti-search"></i> 查詢</button></span>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
                </div>
            <?php
            // 建立MySQL的資料庫連接 
            //$page=2;
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }
            require 'db_open.php';

            $search = isset($_GET['Search']) ?$_GET['Search'] : "";
            if($search == ""){
               //$sql = " SELECT member.mId, member.mName, member.mPassword, member.mArea FROM `member` ";
               $sql = " SELECT member.mId, member.mName, member.mPassword, area.arName 
               FROM `member` 
               left join `area` 
               on member.mArea = area.arId ";
                // 指定SQL查詢字串
            }else{
                $sql = " SELECT member.mId, member.mName, member.mPassword, area.arName 
                FROM `member` 
                left join `area` 
                on member.mArea = area.arId 
                WHERE member.mId LIKE '%$search%' or member.mName LIKE '%$search%' or member.mPassword LIKE '%$search%' or area.arName LIKE '%$search%'"; // 指定SQL查詢字串
            }
            //LIKE '%$search%'
            //$sql = "SELECT * FROM admin";
            $result = mysqli_query($link, $sql);
            $records_per_page = 3;//一頁只能輸出3筆
            $total_records=mysqli_num_rows($result);//這個資料表共有幾筆
            $total_page=ceil($total_records/$records_per_page);//這個資料表在一夜只能輸出3筆的情況下,共有幾頁ceil無條件進位
            $outset = ($page-1)*$records_per_page;
            ?>
            <div class="card-body">
                <table class="table table-responsive table-striped m-t-30">
                    <thead>
                        <tr style="border-top:1px solid #e7e7e7;">
                            <th>管理者帳號</th>
                            <th>管理者名稱</th>
                            <th>密碼</th>
                            <th>地區</th>
                            <th>共<?=$total_records?>筆資料，目前顯示第<?=$page?>頁/共<?=$total_page?>頁</th>
                        </tr>
                    </thead>
                <tbody>
            <?php
            mysqli_data_seek($result,$outset);
            $j=1;//不是控制輸出資料在資料庫為第幾筆,只是單純用來控制每一頁只能輸出的比數
            while( $row = mysqli_fetch_assoc($result) and $j <= $records_per_page) { 
            ?>
            <tr>
                <th scope="row"><?=$row['mId']?></th>
                    <td><?=$row['mName']?></td>
                    <td><?=$row['mPassword']?></td>  
                    <td><?=$row['arName']?></td>                            
                    <td>
                        <a href="memberdetail.php?title=edit&id=<?=$row['mId']?>" ><button type="button" class="btn btn btn-info btn btn-flat btn-addon btn-sm m-b-5 m-l-5"><i class="ti-pencil-alt"></i>修改</button></a>
                        <a href="#" ><button type="button" class="btn btn btn-default btn btn-flat btn-addon btn-sm m-b-5 m-l-5" onclick="javascript:deleteConfirm('member.php','<?=$row['mId']?>')"><i class="ti-trash"></i>刪除</button></a>
                    </td>
                </tr>
            <?php
                $j++;
                }
                echo"<tr>\n";
                echo"<td colspan=5>\n";
                if($page>1)
                {
                    echo"<a href=\"admin.php?page=".($page-1)."\" style=\"color:#000\">上一頁</a> | \n";
                }
                for($i=1; $i<=$total_page; $i++)
                {
                    echo"<a href=\"admin.php?page=".$i."\" style=\"color:#000\">".$i."</a>\n";
                }
                if($page<$total_page)
                {
                    echo"<a href=\"admin.php?page=".($page+1)."\" style=\"color:#000\">下一頁</a> | \n";
                }
                echo"</td>\n";
                echo"</tr>";
            ?>
                </tbody>
            </table>
        </div>
        </div>
    </div><!-- /# column -->			
</div>
<?php include 'footer.php'; ?>
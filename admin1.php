<?php include 'header.php'; ?>
				
				<div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h2>管理者資料管理</h2><Br/>
									 <div class="row">
									<a href="memberdetail.html" ><button type="button" class="col-lg-2 btn btn-primary btn-flat btn-addon m-b-10 m-l-20"><i class="ti-plus"></i>新增管理者 </button></a>
									<div class="basic-form col-lg-8">
                                        <form>
                                            
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
                                
								<div class="card-body">
                                    <table class="table table-responsive table-striped m-t-30">
                                        <thead>
                                            <tr style="border-top:1px solid #e7e7e7;">
                                                <th>管理者帳號</th>
                                                <th>管理者名稱</th>
                                                <th>密碼</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $page=1;
                                        if(isset($_GET['page'])) {
                                            $page=$_GET['page'];
                                        }else{
                                            $page=1;
                                        }
                                        require 'db_open.php';
                                        $sql = "SELECT * FROM admin";
                                        $result=mysqli_query($link,$sql);
                                        $records_per_page=3;//一頁只能輸出3筆
                                        $total_records=mysqli_num_rows($result);//這個資料表共有幾筆
                                        $total_page=ceil($total_records/$records_per_page);//這個資料表在一夜只能輸出3筆的情況下,共有幾頁ceil無條件進位
                                        $outset=($page-1)*$records_per_page;
                                        mysqli_data_seek($result,$outset);
                                        $j=1;//不是控制輸出資料在資料庫為第幾筆,只是單純用來控制每一頁只能輸出的比數
                                        while( $row = mysqli_fetch_assoc($result) and $j<=$records_per_page){ ?>
                                        <tr>
                                        <th scope='row'><?=$row['aid']?></th>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['pwd']?></td>
                                        
                                        <td><a href='#' ><button type='button' class='btn btn btn-info btn btn-flat btn-addon btn-sm m-b-5 m-l-5'><i class='ti-pencil-alt'></i>修改</button></a><a href='#' ><button type='button' class='btn btn btn-default btn btn-flat btn-addon btn-sm m-b-5 m-l-5'><i class='ti-trash'></i>刪除</button></a></td>
                                        </tr>
                                        <?php 
                                        $j++;
                                        } ?>
                                        <?php
                                        echo "<tr>\n";
                                        echo "<td colspan=5>\n";
                                        if ($page>1){
                                            echo "<a href='admin.php?page=".($page-1)."'style=\"color:#000\">上一頁</a>|";
                                        }
                                        for ($i=1;$i<=$total_page;$i++){
                                            echo "<a href='admin.php?page=".$i."'style=\"color:#000\">".$i."</a>|";
                                        }
                                        if ($page<$total_page){
                                            echo "<a href='admin.php?page=".($page+1)."'style=\"color:#000\">下一頁</a>|";
                                        }
                                        echo "</td>\n";
                                        echo "</tr>\n";
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
						
								
                            </div>
                        </div><!-- /# column -->

                        <?php include 'footer.php'; ?>
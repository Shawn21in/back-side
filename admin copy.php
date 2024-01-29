<?php include 'header.php'; ?>
				
				<div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h2>管理者資料管理</h2><Br/>
									 <div class="row">
									<a href="admindetail.php" ><button type="button" class="col-lg-2 btn btn-primary btn-flat btn-addon m-b-10 m-l-20"><i class="ti-plus"></i>新增管理者 </button></a>
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
                                        <?php include 'ch06-2 copy.php'; ?>
                                        </tbody>
                                    </table>
                                </div>
								
						
								
                            </div>
                        </div><!-- /# column -->
						
                    </div>
		
<?php include 'footer.php'; ?>
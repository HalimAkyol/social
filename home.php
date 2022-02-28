<?php

//home.php
include 'header.php';
?>
<style>
	[contenteditable]{
		outline:0px solid transparent;
		min-height:100px;
		height:auto;
		cursor:auto;
		font-size:24px;
	}
	[contenteditable]:empty:before{
		content:attr(placeholder);
		color:#ccc;
		cursor:auto;
	}
	[placeholder]:empty:focus:before{
		content: "";
	}

</style>
			<!-- <h3 align="center">How to Make Initial Avatar Image in PHP After Registration</h3> -->
			<br />
			<br />
			<div class="container">
				<div class="row">
					<div class="col-md-9 ">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-6">
										<h3 class="panel-title">User Timeline</h3>
									</div>
									<div class="col-md-6 text-right">
										<!-- <span class="btn btn-success btn-xs fileinput-button">
											<input type="file" name="files[]"  multiple>
										</span> -->
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="content_area" contenteditable="true" placeholder="write something..."></div>
							</div>
							<div class="panel-footer" align="right">
								<input type="button" class="btn btn-primary btn-sm" name="share_button" id="share_button" value="Post" >
							</div>
						</div>
						<br>
						
					</div>
					

					<div class="col-md-3">
							<div class="panel panel-default">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-6">
															<h3 class="panel-title">My Friends</h3>
														</div>
														
														<div class="col-xs-6">
															<input type="text" name="search_friend" id="search_friend" class="form-control input-sm" placeholder="Ara..."></div>
														</div>
												</div>
												<div class="panel-body">
													<div align="center">
														<!-- <div id="friends_list"></div>  -->
														<div id="chat-sidebar"></div>
														
														
												</div>
											</div>
										</div>
					</div>
			</div>
			<div class="row">
				<div class="col-md-9">
				<div id="timeline_area">
						</div>
				</div>
			</div>

			
		</div>

		


		
		<div class="table-responsive">
				
				<div id="user_details"></div>
				<div id="user_model_details"></div>
			</div>
			
			<?php include 'footer.php'; ?>
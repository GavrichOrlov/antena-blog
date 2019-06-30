
<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Rss Manage Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="http://article-guide.xyz/public/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="http://article-guide.xyz/public/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<style>
.center {
  margin: auto;
  width: 70%;
}
.middle {
  vertical-align: middle;
}
</style>

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-quick-sidebar-over-content ">

<!-- BEGIN CONTAINER -->
<div class="page-container">

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content middle">

			<!-- BEGIN PAGE CONTENT-->

			<div class="row center" style="margin-top: 3%;">
				
				<div class="row">
					<div class="col-md-8">
						<div class="logo">
							<img src="http://article-guide.xyz//public/img/site_logo.png" alt=""/>
						</div>
					</div>
					<div style="float: right;margin-right: 2.5%; margin-top: 3%;">
						<div class="dropdown">
						    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{Auth::user()->name}}
						    <span class="caret"></span></button>
						    <ul class="dropdown-menu">
						      <li><a href="/logout">Logout</a></li>
						      <li><a href="/" >Go to Site</a></li>
						      
						    </ul>
					  	</div>					
					</div>					

				</div>
				<br>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<!-- BEGIN CONDENSED TABLE PORTLET-->
					<div class="portlet box blue-sharp">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-picture"></i>Rss Manager Dashboard
							</div>
							<div style="float: right; padding: 11px 0 9px 0;"><a class="label label-sm label-danger" data-toggle="modal" data-target="#myModal" style="font-size: 18px;" onclick="create()">Create</a></div>
							<div style="float: right; padding: 11px 0 9px 0; margin-right: 10px"><a class="label label-sm label-success" href="/dashboard" style="font-size: 18px;">Go to Dashboard</a></div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-condensed table-hover">
								<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Icon
									</th>
									<th>
										Name
									</th>
									<th>
										Site Url
									</th>
									<th>
										Rss Url
									</th>
									<th>
										Update
									</th>
									<th>
										Delete
									</th>									
								</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
									?>
									@foreach($results as $key => $result)
									    <tr>    
									      <td>{{$no}}</td>
									      <td><img style="height: 20px;" src="{{$result->icon_url}}"></td>
									      <td>{{$result->name}}</td>
									      <td>{{$result->site_url}}</td>
									      <td>{{$result->rss_url}}</td>
                						  <td>
											<a class="label label-sm label-success" data-toggle="modal" data-target="#myModal" onclick="fetchRecords({{$result->id}})">Update</a>
										  </td>
										  <td>
										  	<a class="label label-sm label-warning" href="/rssdelete/{{$result->id}}">Delete</a>
							  	
										  </td>
									    </tr>
									    <?php $no++?>
									@endforeach
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Rss Info</h4>
        </div>
        <div class="modal-body">
			<form class="Signup-form" action="{{ route('rss_update') }}" method="post" enctype="multipart/form-data">
					 {{ csrf_field() }}
					<div class="form-group">
						<input type="hidden" name="mid" id="mid">
						<!-- <input type="hidden" name="cid" id="cid" -->
						<input type="hidden" name="cid" id="cid" value="{{ $cat_id }}">
						<label class="control-label visible-ie8 visible-ie9">Rss Name</label>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" id="mfullname" name="mfullname"/>

						<label class="control-label visible-ie8 visible-ie9">Site Url</label>
						<input class="form-control placeholder-no-fix" type="url" placeholder="Site Full Url" id="site_url" name="site_url"/>

						<label class="control-label visible-ie8 visible-ie9">Rss Url</label>
						<input class="form-control placeholder-no-fix" type="url" placeholder="Rss Full Url" id="rss_url" name="rss_url"/>
						<img id="icon_image" name="icon_image" width="30px" height="30px">
						<input class="form-control placeholder-no-fix" type='file' name="icon_file" id="icon_file" accept="image/*"/>
					</div>
					<!-- <div class="form-group"> -->
						<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
						<!-- <label class="control-label visible-ie8 visible-ie9">Email</label>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Email" id="memail" name="memail"/> -->
					<!-- </div> -->
					<!-- <div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Password</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="mpassword" placeholder="Password" name="mpassword"/>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Status</label>
						<input class="form-control placeholder-no-fix" type="text" placeholder="status" id="mstatus" name="mstatus"/>
					</div> -->
					<div class="form-actions">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" id="register-submit-btn" class="btn btn-primary uppercase pull-right">Submit</button>
					</div>
				</form>

        </div>
      </div>
      
    </div>
  </div>
  <script>
	  function fetchRecords(id){
	       $.ajax({
	         url: '/getrssData/'+id,
	         type: 'get',
	         dataType: 'json',
	         success: function(response){
	           var len = 0;
	           if(response['data'] != null){
	             len = response['data'].length;
	           }
	           if(len > 0){
	             for(var i=0; i<len; i++){
	               var id = response['data'][i].id;
	               var username = response['data'][i].name;
	               var rss_url = response['data'][i].rss_url;
	               var category_id = response['data'][i].category_id;
	               var icon_url = response['data'][i].icon_url;
	               var site_url = response['data'][i].site_url;
	               $("#mfullname").val(username);
	               // $("#memail").val(email);
	               $("#rss_url").val(rss_url);
	               $("#site_url").val(site_url);
	               // $("#mpassword").val(password);
	               $("#mid").val(id);
	               $("#icon_image").attr("src", icon_url);
	             }
	           }
	         }
	       });
	  }
	  function create(){
		$("#mfullname").val('');
		// $("#memail").val(email);
		$("#rss_url").val('');
		// $("#mpassword").val(password);
		$("#mid").val('');
		$("#icon_image").attr("src", '');
	  }
</script>
</body>
<!-- END BODY -->
</html>
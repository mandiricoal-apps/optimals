<div class="row">
	<div class="page-header p-0">
		<h3 class="page-title">Daily Inspection</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Transaction</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Daily Inspection </li>
			</ol>
		</nav>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col mb-0">
					<i class="mdi mdi-filter-variant"></i> Filter by :
					<button class="btn btn-info">Approved</button>
					<button class="btn btn-info">Not Approved</button>
				</div>
				<div class="col text-end mb-3"><br>
					<!-- <button class="btn btn-primary"  data-toggle="modal" data-target="#add-modal">
						<i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
					</button> -->
				</div>
			</div>			
			<table id="example" class="table table-striped table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Creation Date</th>
						<th>Daily Inspection</th>
						<th>Submitter</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>12/12/2020</td>
						<td>22DIA01000001 <i style="font-size: 14px;color:#ff5730;" class="mdi mdi-alert-circle-outline"></i>
							<br><small>Area : Front Loading OB</small>
						</td>
						<td><a href="" data-toggle="modal" data-target="#view-modal">Andika Simamora <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
							<br><small class="mt-1">NIK : 2031</small>
						</td>
						<td>
							<b><i>Not Approved</i></b>
						</td>
						<td class="text-center">
							<div class="button-group">
								<a href="home.php?view=dailyinspection_answer" class="btn btn-warning">
									<i style="font-size: 14px;" class="mdi mdi-eye-circle-outline"></i> Detail
								</a>
							</div>
						</td>
					</tr>
					<tr>
						<td>12/12/2020</td>
						<td>22DIA01000001 <i style="font-size: 14px;color:#ff5730;" class="mdi mdi-alert-circle-outline"></i>
							<br><small>Area : Front Loading OB</small>
						</td>
						<td><a href="" data-toggle="modal" data-target="#view-modal">Andika Simamora <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
							<br><small class="mt-1">NIK : 2031</small>
						</td>
						<td>
							<b><i>Not Approved</i></b>
						</td>
						<td class="text-center">
							<div class="button-group">
								<a href="home.php?view=dailyinspection_answer" class="btn btn-warning">
									<i style="font-size: 14px;" class="mdi mdi-eye-circle-outline"></i> Detail
								</a>
							</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Creation Date</th>
						<th>Daily Inspection</th>
						<th>Submitter</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</tfoot>
			</table>

			<!-- Modal Add-->
			<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form class="forms-sample" action="" target="">
							<div class="modal-body p-5">
								<h4 class="card-title">Default form</h4>
								<div class="form-group">
									<label for="exampleInputUsername1">Username</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email address</label><span style="color:red;">*</span>
									<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Password</label><span style="color:red;">*</span>
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputConfirmPassword1">Confirm Password</label><span style="color:red;">*</span>
									<input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" required="">
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<button class="btn btn-light form-control"><i style="font-size: 14px;"  class="mdi mdi-close-circle-outline"></i> Cancel</button>
									</div>
									<div class="col">
										<button type="submit" class="btn btn-primary mr-2 form-control"><i style="font-size: 14px;" class="mdi mdi-content-save"></i> Save </button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal Edit-->
			<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form class="forms-sample" action="" target="">
							<div class="modal-body p-5">
								<h4 class="card-title">Default form</h4>
								<div class="form-group">
									<label for="exampleInputUsername1">Username</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" required="">
								</div>a
								<div class="form-group">
									<label for="exampleInputEmail1">Email address</label><span style="color:red;">*</span>
									<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Password</label><span style="color:red;">*</span>
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputConfirmPassword1">Confirm Password</label><span style="color:red;">*</span>
									<input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" required="">
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<!-- <button class="btn btn-light form-control"><i style="font-size: 14px;"  class="mdi mdi-close-circle-outline"></i> Cancel</button>
									</div>
									<div class="col"> -->
										<button type="submit" class="btn btn-primary mr-2 form-control"><i style="font-size: 14px;" class="mdi mdi-content-save"></i> Save </button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal View-->
			<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form class="forms-sample" action="" target="">
							<div class="modal-body p-5">
								<div class="form-group">
									<label for="">NIK</label>
									<input type="text" class="form-control" id="" placeholder="NIK" required="" disabled="">
								</div>
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" class="form-control" id="" placeholder="Name" required="" disabled="">
								</div>
								<div class="form-group">
									<label for="">Divisi</label>
									<input type="text" class="form-control" id="" placeholder="Divisi" required="" disabled="">
								</div>
								<div class="form-group">
									<label for="">Company</label>
									<input type="text" class="form-control" id="" placeholder="Company" required="" disabled="">
								</div>
								<div class="form-group">
									<label for="">Roles</label>=
									<input type="text" class="form-control" id="" placeholder="Company" required="" disabled="">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function toggleSwitchClicked() {
		Swal.fire({
			title: 'Reload Page?',
			text: 'Do you want to reload the page?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			location.reload();
		});
	};
</script>
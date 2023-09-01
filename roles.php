<div class="row">
	<div class="page-header p-0">
		<h3 class="page-title">Data Area</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Master Data</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Data Area </li>
			</ol>
		</nav>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col mb-0">
					<i class="mdi mdi-filter-variant"></i> Filter by :
					<button class="btn btn-info">Active</button>
					<button class="btn btn-info">Inactive</button>
				</div>
				<div class="col text-end mb-3">
					<button class="btn btn-primary"  data-toggle="modal" data-target="#add-modal">
						<i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
					</button>
				</div>
			</div>			
			<table id="example1" class="table table-striped table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Roles</th>
						<th>Description</th>
						<!-- <th class="text-center">Action</th> -->
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Admin</td>
						<td>Admin Admin Admin Admin</td>
					</tr>
					<tr>
						<td>Operation</td>
						<td>Operation Operation Operation</td>
					</tr>
					<tr>
						<td>Reviewer MIP</td>
						<td>Reviewer MIP Reviewer MIP</td>
					</tr>
					<tr>
						<td>Reviewer MKP</td>
						<td>Reviewer MKPReviewer MKP</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Roles</th>
						<th>Description</th>
						<!-- <th>Action</th> -->
					</tr>
				</tfoot>
			</table>

			<!-- Modal Add-->
			<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<form class="forms-sample" action="" target="">
							<div class="modal-body p-5">
								<div class="form-group">
									<label for="">Area Name</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Area Name" required="" >
								</div>
								<div class="form-group">
									<label for="">Area Description</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Area Description" required="" >
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
									</div>
									<div class="col">
										<button type="submit" class="btn btn-primary mr-2 form-control"  onclick="successalert()"><i style="font-size: 14px;" class="mdi mdi-content-save"></i> Save </button>
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
							<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form class="forms-sample" action="" target="">
							<div class="modal-body p-5">
								<div class="form-group">
									<label for="">Area Name</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Area Name" required="" disabled="">
								</div>
								<div class="form-group">
									<label for="">Area Description</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Area Description" required="">
								</div>
								<hr>
								<div class="row">
									<div class="col">
										<button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
									</div>
									<div class="col">
										<button type="submit" class="btn btn-primary mr-2 form-control"  onclick="successalert()"><i style="font-size: 14px;" class="mdi mdi-content-save"></i> Save </button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Active/Inactive -->
<script type="text/javascript">
	function inactive() {
		Swal.fire({
			title: 'Inactive?',
			text: 'Do you want to Inactivate User?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			location.reload();
		});
	};

	function activate() {
		Swal.fire({
			title: 'Activate?',
			text: 'Do you want to Activate User?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			location.reload();
		});
	};

	function successalert() {
		Swal.fire({
			icon: 'success',
			title: ' has been saved',
			showConfirmButton: false,
			timer: 1500
		});
	};
</script>
<div class="row">
	<div class="page-header p-0">
		<h3 class="page-title">Answer</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Master Data</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Data Answer </li>
			</ol>
		</nav>
	</div>
	<div class="card">
		<div class="card-body">		


			<div class="row">
				<div class="col mb-0">
					<div class="pl-2 mb-0">
						<span class="font-12 text-muted">Question : </span>
						<p class="m-0 text-black"> Tinggi Jenjang Penggalian (Digging Bench Height)</p>
						<span class="font-12 text-muted">Area : </span>
						<p class="m-0 text-black"> Front Loading OB</p>
						<span class="font-12 text-muted">Weight : </span>
						<p class="m-0 text-black"> 12</p>
					</div>
				</div>
				<div class="col text-end mb-2">
					<button class="btn btn-primary"  data-toggle="modal" data-target="#add-modal">
						<i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
					</button>
				</div>
			</div>	
			<hr>
			<table id="" class="table table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th width="50%">Answer</th>
						<th width="20%">Point</th>
						<th width="20%">Score Point</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>< 2 Meter PC2000/3000 class /100 T- 150 T  </td>
						<td>1 Point</td>
						<td>12</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#edit-modal">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>< 2 Meter PC2000/3000 class /100 T- 150 T...)</td>
						<td>1 Point</td>
						<td>12</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#edit-modal">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>< 2 Meter PC2000/3000 class /100 T- 150 T...)</td>
						<td>1 Point</td>
						<td>12</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#edit-modal">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>< 2 Meter PC2000/3000 class /100 T- 150 T...)</td>
						<td>1 Point</td>
						<td>12</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#edit-modal">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
				</tbody>
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
									<label for="">Answer</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Answer" required="">
								</div>
								<div class="form-group">
									<label for="">Point</label><span style="color:red;">*</span>
									<input type="tnumberxt" class="form-control" id="" placeholder="Point" required="">
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
									<label for="">Answer</label><span style="color:red;">*</span>
									<input type="text" class="form-control" id="" placeholder="Answer" required="">
								</div>
								<div class="form-group">
									<label for="">Point</label><span style="color:red;">*</span>
									<input type="tnumberxt" class="form-control" id="" placeholder="Point" required="">
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
					</form>
				</div>
			</div>
		</div>

		<!-- Modal VView-->
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
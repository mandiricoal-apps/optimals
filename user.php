<div class="row">
	<div class="page-header p-0">
		<h3 class="page-title">Table Template</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">UI Elements</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Buttons </li>
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
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th class="text-center">Salary</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="ps-5">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked  onclick="toggleSwitchClicked()">
								<b><i><label class="form-check-label ms-0" for="flexSwitchCheckChecked">Active</label></i></b>
							</div>
						</td>
						<td><a href="">System Architect <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
							<br><p class="mt-1">Hiskia Pulungan</p>
						</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>
							25 June 2011
						</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#add-modal">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ps-5">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
								<b><i><label class="form-check-label ms-0" for="flexSwitchCheckChecked">Inactive</label></i></b>
							</div>
						</td>
						<td><a href="">System Architect <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
							<br><p class="mt-1">Andika Pulungan</p>
						</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>
							25 June 2011
						</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" disabled="">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ps-5">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
								<b><i><label class="form-check-label ms-0" for="flexSwitchCheckChecked">Inactive</label></i></b>
							</div>
						</td>
						<td><a href="">System Architect <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
							<br><p class="mt-1">Rina Sihotang</p>
						</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>
							25 June 2011
						</td>
						<td class="text-center">
							<div class="button-group">
								<button class="btn btn-success" disabled="">
									<i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
								</button>
							</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th class="text-center">Salary</th>
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
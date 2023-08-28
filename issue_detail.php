<div class="row">
	<div class="page-header p-0">
		<h3 class="page-title">Issue</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Transaction</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Issue </li>
			</ol>
		</nav>
	</div>
	<div class="card">
		<div class="card-body">		
			<div class="row">
				<div class="col mb-0">
					<div class="pl-2 mb-0">
						<div class="row">
							<div class="col-2">
								<span class="font-12 text-muted">ID Daily Inspection : </span>
								<p class="m-0 text-black">22DIA01000001</p>
								<span class="font-12 text-muted">Creation Date : </span>
								<p class="m-0 text-black"> 12/12/2020</p>
								<span class="font-12 text-muted">Area : </span>
								<p class="m-0 text-black"> Front Loading OB</p>
								<span class="font-12 text-muted">Location : </span>
								<p class="m-0 text-black"> Location ABC</p>
								<span class="font-12 text-muted">Submitter : </span>
								<p class="m-0 text-black"> <a href="" data-toggle="modal" data-target="#view-modal">Andika Simamora <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a></p>
							</div>
							<div class="col">
								<table id="" class="table table-striped table-hover mb-5" width="100%">
									<tbody>
										<tr>
											<th width="">Question<br><br>
												<small>Batas Penggalian (Digging Limit)</small>
											</th>
										</tr>
										<tr>
											<th width="">Answer<br><br>
												<small>Batas Penggalian (Digging Limit)</small>
											</th>
										</tr>
										<tr>
											<th width="">Issue<br><br>
												<small>Di bawah sinar mentari pagi, burung-burung berkicau riang. <br>Pohon-pohon bergoyang pelan oleh hembusan angin sepoi-sepoi. </small>
											</th>
										</tr>
										<tr>
											<th>
												<div class="row">
													<div class="col-3">
														<select class="form-select form-select">
															<option selected>Open</option>
															<option value="1">Progress</option>
															<option value="2">Close</option>
															<option value="3">Reject</option>
														</select>
													</div>
													<div class="col-3">
														<button class="btn btn-primary" onclick="approve()"><i style="font-size: 14px;" class="mdi mdi-save"></i> Change Status</button>
													</div>
												</div>
											</th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
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

<!-- Active/Inactive -->
<script type="text/javascript">
	function approve() {
		Swal.fire({
			title: 'Approve?',
			text: 'Do you want to Approve?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			location.reload();
		});
	};
</script>

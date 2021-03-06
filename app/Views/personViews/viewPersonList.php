<?=$this->include('Themes/_commonPartialsBs4/datatables') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div class="row">
	<div class="col-md-12">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">People</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

					<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fas fa-times"></i>
					</button>

				</div><!--//.card-tools -->

			</div><!--//.card-header -->
			<div class="card-body">
				<?= view('Themes/_commonPartials/_alertBoxes'); ?>

					<table id="tableOfpeople" class="table table-striped table-hover using-data-table">
						<thead>
							<tr>
								<th class="text-nowrap">Action</th>
								<th>ID</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Last Name</th>
								<th>Phone Number</th>
								<th>Email Address</th>
								<th>City</th>
								<th>Contact Type</th>
								<th>Score</th>
								<th>Is Friend?</th>
								<th>Active?</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Birth Date</th>
								<th>Notes</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($personList as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<a href="<?=route_to('editPerson', $item->id) ?>" class="btn btn-sm btn-warning mr-1" data-id="<?=$item->id ?>"><i class="fas fa-edit"></i></a>
									<a href="#confirm2delete" class="btn btn-sm btn-danger ml-1" data-href="<?=route_to('deletePerson', $item->id) ?>" data-toggle="modal" data-target="#confirm2delete"><i class="fas fa-times"></i></a>
								</td>
								<td class="align-middle text-center">
									<?=$item->id ?>
								</td>
								<td class="align-middle">
									<?=$item->first_name ?>
								</td>
								<td class="align-middle">
									<?=$item->middle_name ?>
								</td>
								<td class="align-middle">
									<?=$item->last_name ?>
								</td>
								<td class="align-middle">
									<?=$item->phone_number ?>
								</td>
								<td class="align-middle">
									<?=$item->email_address ?>
								</td>
								<td class="align-middle">
									<?=$item->city_name ?>
								</td>
								<td class="align-middle">
									<?=$item->person_type ?>
								</td>
								<td class="align-middle">
									<?=$item->score ?>
								</td>
								<td class="align-middle text-center text-green">

								<?php if ( $item->is_friend ) { ?>

									<i class="text-success fas fa-check"></i>

								<?php  }  ?>

								</td>
								<td class="align-middle text-center text-green">

								<?php if ( $item->enabled ) { ?>

									<i class="text-success fas fa-check"></i>

								<?php  }  ?>

								</td>
								<td class="align-middle text-nowrap">
									<?= empty($item->created_at) ? '' : date('d/m/Y H:i', strtotime($item->created_at))  ?>
								</td>
								<td class="align-middle text-nowrap">
									<?= empty($item->updated_at) ? '' : date('d/m/Y H:i', strtotime($item->updated_at))  ?>
								</td>
								<td class="align-middle text-nowrap">
									<?= empty($item->birth_date) ? '' : date('d/m/Y', strtotime($item->birth_date))  ?>
								</td>
								<td class="align-middle">
									<?=$item->notes ?>
								</td>
								<td class="align-middle text-center text-nowrap">
									<a href="<?=route_to('editPerson', $item->id) ?>" class="btn btn-sm btn-warning mr-1" data-id="<?=$item->id ?>"><i class="fas fa-edit"></i></a>
									<a href="#confirm2delete" class="btn btn-sm btn-danger ml-1" data-href="<?=route_to('deletePerson', $item->id) ?>" data-toggle="modal" data-target="#confirm2delete"><i class="fas fa-times"></i></a>
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>
					</table>
			</div><!--//.card-body -->
			<div class="card-footer">
				<a href="<?=route_to('newPerson') ?>" class="btn btn-primary">
				Add a New Person
		</a>
			</div><!--//.card-footer -->
		</div><!--//.card -->
	</div><!--//.col -->
</div><!--//.row -->

<?=$this->endSection() ?>
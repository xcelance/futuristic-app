@extends('layouts.app')
@section('content')	
	<section class="modules_list">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="_left_side">
						<h3>Modules</h3>
						 <!-- Modal -->
						<div id="addModuleModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add Module</h4>
							  </div>
							  <div class="modal-body">
							    <form method="POST" id="module-form" role="form" action="{{url('admin/createnew')}}" >
								  <div class="modal-filed form-group">
									<label>Module Name</label>
										<input type="text" name="module_name" value="" required="required">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
									</div>
									<div class="modal_btn form-group"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></div>
								 </form>
							  </div>
							</div>
						 </div>
					   </div>
						<div class="add_module_outer">                        
							<a href="javascript:void(0);" data-toggle="modal" data-target="#addModuleModal">Add Module</a>
						</div>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6 col-md-offset-3">
				<div class="row submodule-page">
					<div class="col-md-12 col-sm-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Module Name</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($modulesList as $module)
									<tr class="module_{{$module->id}}">
										<td> <a href="{{url('/admin/submodule/?mid=')}}{{$module->id}}"><h5>{{$module->module_name}}</h5></a></td>	
										<td><span class="edit_module"><a href="#" data-toggle="modal" data-target="#editmodal_{{$module->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></span></td>
																			
										<td><a href="{{url('/admin/delmodule?mid=')}}{{$module->id}}"><span class="edit delete left-side"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
									</tr>
										<!-- edit music Modal -->
									   <div class="modal fade" id="editmodal_{{$module->id}}"  style="margin-top: 10%;" tabindex="-1" role="dialog" 
										 aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<!-- Modal Header -->
													<div class="modal-header">
														<button type="button" class="close" 
														   data-dismiss="modal">
															   <span aria-hidden="true">&times;</span>
															   <span class="sr-only">Close</span>
														</button>
														<h4 class="modal-title" id="myModalLabel">
															Edit Recorded Module Name
														</h4>
													</div>
													
													<!-- Modal Body -->
													<div class="modal-body">
														<form role="form" method="post" action="{{url('admin/editsubmodule')}}">
														  <div class="form-group">
															  <input type="hidden" name="mid" value="{{$module->id}}">
															  <input type="text" name="edit_module" class="form-control" value="{{$module->module_name}}"/>
															  <input type="hidden" name="_token" value="{{ csrf_token() }}">
														  </div>
														   <input type="submit" name="submit" value="Submit" class="btn btn-default">
														</form>
													</div>
													
													<!-- Modal Footer -->
													<div class="modal-footer">
														<button type="button" class="btn btn-default"
																data-dismiss="modal">
																	Close
														</button>
													</div>
													
												</div>
											</div>
									  </div>	
								@endforeach								
							  </tbody>
							</table>
						  </div>
						</div>
					</div>
				  </div>
                </div>
            </div>
  </section>
@endsection

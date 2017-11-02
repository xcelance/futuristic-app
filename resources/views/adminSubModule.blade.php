@extends('layouts.app')
@section('content')
	<section class="submodule-section">
			<div class="container">
				<h1 class="my-submodule-heading">Sub Modules</h1>
				<div class="row submodule-page">
					<div class="col-md-10 col-md-offset-1">
						<div class="add_submodule_outer">                        
							<a href="javascript:void(0);" data-toggle="modal" data-target="#addSubModuleModal">Add Sub Module</a>
						</div>
						
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Module ID</th>
									<th>question</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($subModulesList as $sublist)
									<tr class="user_{{$sublist->id}}">
										<td>{{$sublist->module_id}}</td>
										<td>{{$sublist->question}}</td>
										<td>
										<a href="#" data-toggle="modal" data-target="#editsubmodal_{{$sublist->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<!-- edit music Modal -->
									   <div class="modal fade" id="editsubmodal_{{$sublist->id}}"  style="margin-top: 10%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
															Edit Sub Module 
														</h4>
													</div>													
													<!-- Modal Body -->
													<div class="modal-body">
													  <form method="POST" id="up-module-form_{{$sublist->id}}" role="form" action="{{url('admin/editsubmodule')}}">
															<div class="form-group">
																<label>Question Name</label>
																<input type="hidden" name="sid" value="{{$sublist->id}}">
																<input type="text" name="question_name" value="{{$sublist->question}}"  required="required">
															</div>
															<div class="form-group">
															<label>Content</label>
																<textarea type="text" name="sub_content">{{$sublist->content}}</textarea>
															</div>
															<div class="form-group">
															<label>Video</label>
																<textarea name="video"  placeholder="Add Video Code" >{{$sublist->video}}</textarea>
															</div>
															<div class="form-group">
																<label>Add Custom Links</label>
																 @php 
																	$links = json_decode($sublist->links, true); 
																	$c = 1;
																@endphp
																 @if(!empty ($sublist->links) )
																		@foreach($links as  $link=>$url)
																			<div id="p_edit_scents_{{$sublist->id}}">	
																			   <p>
																				 <input type="text" name="link_name[]" value="{{$link}}" placeholder="Link Name">
																				 <input type="text" name="link_url[]" value="{{$url}}"  placeholder="Link Url">
																				 @if($c > 1) 
																						<a href="#" id="editRemScnt">Remove</a>
																					@endif
																				</p>
																			 </div>	
																	   @php $c++; @endphp
																	   @endforeach
																		<a href="#" class="edit_module_link" data-id="editScnt_{{$sublist->id}}" data-cent="p_edit_scents_{{$sublist->id}}" >Add Another Links</a>		
																		@else
																			 <div id="p_edit_scents_{{$sublist->id}}">	
																			   <p>
																				 <input type="text" name="link_name[]" value="" placeholder="Link Name">
																				 <input type="text" name="link_url[]" value=""  placeholder="Link Url">
																				</p>
																			 </div>	
																			 <a href="#" class="edit_module_link" data-id="editScnt_{{$sublist->id}}" data-cent="p_edit_scents_{{$sublist->id}}" >Add Links</a>	
																  @endif														
																</div>
																<div class="modal_btn form-group">
																	<input type="hidden" name="_token" value="{{ csrf_token() }}">
																	<input type="submit" name="submit" value="Submit" class="btn btn-primary">
																</div>  
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
										
										</td>
										<td><a href="{{url('/admin/delsubmodule?sid=')}}{{$sublist->id}}"  data-id="{{$sublist->id}}" class="deluser"><span class="edit delete"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
									</tr>
									
									
								@endforeach								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<!------ Add Sub Module --------->			
			<div id="addSubModuleModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Sub Module</h4>
					  </div>
					  <div class="modal-body">
						<form method="POST" id="module-form" role="form" action="{{url('admin/createnewsub')}}" >
							  <div class="form-group">
								<label>Question Name</label>
									<input type="text" name="question_name" value=""  required="required">
								</div>
								<div class="form-group">
								<label>Content</label>
									<textarea name="sub_content" ></textarea>
								</div>
								
								<div class="form-group">
								<label>Video</label>
									<textarea name="video"  placeholder="Add Video Code"></textarea>
								</div>
								<div class="form-group">
									<label>Add Custom Links</label>
									<div id="p_scents">	
										<p>
											<input type="text" name="link_name[]" value="" placeholder="Link Name">
											<input type="text" name="link_url[]" value=""  placeholder="Link Url">
										</p>
									</div>
									<a href="#" id="addScnt">Add Another Links</a>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="mid" value="{{ app('request')->input('mid') }}">
								</div>
							<div class="modal_btn form-group"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></div>
						</form>
					  </div>
					</div>
				 </div>
			  </div>
			  
		</div>
	</section>
	@section('myjs')
	<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				// Add Sub Modules Links
				jQuery(function() {
					var scntDiv = jQuery('#p_scents');
					var i = jQuery('#p_scents p').size() + 1;
					 jQuery(document).on('click', '#addScnt', function(){
								jQuery('<p><input type="text"  size="20" name="link_name[]" value="" placeholder="Link Name" /><input type="text"  size="20" name="link_url[]" value="" placeholder="Link Url" /><a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
								i++;
								return false;
						});
							 jQuery(document).on('click', '#remScnt', function(){
								if( i > 2 ) {
										jQuery(this).parents('p').remove();
										i--;
								}
								return false;
						});
				});
				
				// Edit Sub Modules Links
				
				
				// Add Sub Modules Links
				jQuery(function() {
					 jQuery(document).on('click',".edit_module_link", function(){						
						 var id = jQuery(this).attr("data-id");
						 var edit =  jQuery(this).attr("data-cent");
						 var scntDiv = jQuery("#"+edit);
						 var i = jQuery("#"+edit + ' p').size() + 1;
						 	 
							jQuery('<p><input type="text"  size="20" name="link_name[]" value="" placeholder="Link Name" /><input type="text"  size="20" name="link_url[]" value="" placeholder="Link Url" /><a href="#" id="editRemScnt">Remove</a></p>').appendTo(scntDiv);
								i++;
								return false;
							});
							jQuery(document).on('click', '#editRemScnt', function(){
								 jQuery(this).parents('p').remove();								
								return false;
						});
				});

		    });

		</script>
	@stop
@endsection


@extends('layouts.dashboard.admin')
@section('content')

		<!-- page content -->
		<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Cities</h3>
						</div>


					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit<small>Cities</small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>

										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form class="form" action="{{route('admin.cities.update',$city->id)}}" method="POST"
									enctype="multipart/form-data">
									@csrf


									<input name="id" value="{{$city->id}}" type="hidden">

									<div class="form-group">
										<div class="text-center">
											<img src="{{$city->photo}}" alt="" class="rounded-circle" style="width:200px;height:100px" alt="Section Photo">
										</div>
									</div>

									<div class="form-group">
									<label>Pictur of City</label>
										<label class="form-label"  id="projectinput">
											<input type="file"  id="file" name="photo">
										</label>

										@error("photo")
												<span class="text-danger">{{$message}}</span>
										@enderror
									</div>


										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name Of City <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input type="text" value="{{$city->name}}" id="name"
												class="form-control"
												placeholder=""
												name="name">
												@error("name")
												<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>









										<div class="item form-group">
                                              <label for="eventInput1">Status </label>

                                                <input type="checkbox" value="1"
                                                name="is_active"
                                                id="switcheryColor4"
                                                class="switchery" data-color="success"
												@if($city->is_active ==1)checked @endif/>
												<label for="switcheryColor4"
												class="card-title ml-1">Active</label>

												@error("is_active")
												<span class="text-danger">{{$message}}</span>
												@enderror
                                        </div>





										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button"><a href="{{ route('admin.cities') }}" class="text-white">Cancel</a></button>
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>



				</div>
			</div>
			<!-- /page content -->

@stop



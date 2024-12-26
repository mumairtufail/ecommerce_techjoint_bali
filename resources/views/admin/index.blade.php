@extends('admin.layout.app')
@section('content')



<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
				<!-- Title -->
				<div class="hk-pg-header align-items-top">
					<div>
						<h2 class="hk-pg-title font-weight-600 mb-10">Taysan E-commerce Dashboard</h2>
						<p>Questions about onboarding lead data? <a href="#">Learn more.</a></p>
					</div>
					<div class="d-flex">
						<button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-envelope-o"></i> </span><span class="btn-text">Email </span></button>
						<button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-print"></i> </span><span class="btn-text">Print </span></button>
						<button class="btn btn-sm btn-danger btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><i class="fa fa-download"></i> </span><span class="btn-text">Report </span></button>
					</div>
				</div>
				<!-- /Title -->
				<!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
						<div class="hk-row">
							<div class="col-lg-4">
								
									<div class="card">
									<div class="card-header card-header-action">
										<h6>Sales & Revenue</h6>
										<div class="d-flex align-items-center card-action-wrap">
											<button class="btn btn-outline-light btn-sm">Rate now</button>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-5">
												<div class="d-flex align-items-center h-100 justify-content-center text-center">
													<div>
														<div class="d-flex align-items-center  justify-content-center text-dark">
															<span class="counter-anim display-3">3.4</span>
															<span class="review-star starred ml-10">
																<span class="feather-icon"><i data-feather="star"></i></span>
															</span>
														</div>
														<span class="font-14">949 ratings & 18 reviews</span>
													</div>
												</div>
											</div>
											<div class="col-sm-7">
												<div class="progress-wrap lb-side-left mt-5">
													<div class="progress-lb-wrap mb-10">
														<label class="progress-label mnw-50p">5.0<i class="zmdi zmdi-star text-light-20 ml-5"></i></label>
														<div class="progress progress-bar-rounded progress-bar-xs">
															<div class="progress-bar bg-green w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="progress-lb-wrap mb-10">
														<label class="progress-label mnw-50p">4.0<i class="zmdi zmdi-star text-light-20 ml-5"></i></label>
														<div class="progress progress-bar-rounded progress-bar-xs">
															<div class="progress-bar bg-blue w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="progress-lb-wrap mb-10">
														<label class="progress-label mnw-50p">3.0<i class="zmdi zmdi-star text-light-20 ml-5"></i></label>
														<div class="progress progress-bar-rounded progress-bar-xs">
															<div class="progress-bar bg-yellow w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="progress-lb-wrap mb-10">
														<label class="progress-label mnw-50p">2.0<i class="zmdi zmdi-star text-light-20 ml-5"></i></label>
														<div class="progress progress-bar-rounded progress-bar-xs">
															<div class="progress-bar bg-pumpkin w-55" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="progress-lb-wrap mb-10">
														<label class="progress-label mnw-50p">1.0<i class="zmdi zmdi-star text-light-20 ml-5"></i></label>
														<div class="progress progress-bar-rounded progress-bar-xs">
															<div class="progress-bar bg-red w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header card-header-action">
										<h6>Budget</h6>
										<div class="d-flex align-items-center card-action-wrap">
											<div class="inline-block dropdown">
												<a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="#">Separated link</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="hk-legend-wrap mb-20">
											<div class="hk-legend">
												<span class="d-10 bg-red rounded-circle d-inline-block"></span><span>A1</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-red-light-1 rounded-circle d-inline-block"></span><span>A2</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-red-light-2 rounded-circle d-inline-block"></span><span>A3</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-red-light-3 rounded-circle d-inline-block"></span><span>A4</span>
											</div>
										</div>
										<div id="e_chart_9" class="echart" style="height: 200px;"></div>
									</div>
								</div>
							</div>
						
							<div class="col-lg-8">
								<div class="card card-refresh">
									<div class="refresh-container">
										<div class="loader-pendulums"></div>
									</div>
									<div class="card-header card-header-action">
										<h6>Yearly Revenue</h6>
										<div class="d-flex align-items-center card-action-wrap">
											<a href="#" class="inline-block refresh mr-15">
												<i class="ion ion-md-radio-button-off"></i>
											</a>
											<div class="inline-block dropdown">
												<a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="#">Separated link</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="mb-20">
											<div class="d-inline-block mb-15 mr-60">
												<span class="d-block text-capitalize">Last Year</span>
												<span class="d-block font-weight-600 font-18">$324,222</span>
												<span class="d-block text-success mt-5">
													<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
												</span>
											</div>
											<div class="d-inline-block mb-15 mr-60">
												<span class="d-block text-capitalize">This Year</span>
												<span class="d-block font-weight-600 font-18">$224,222</span>
												<span class="d-block text-danger mt-5">
													<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-11%</span>
												</span>
											</div>
											<div class="d-inline-block">
												<span class="d-block text-capitalize">Revenue</span>
												<span class="d-block font-weight-600 font-18">$124,222</span>
												<span class="d-block text-danger mt-5">
													<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">-13%</span>
												</span>
											</div>
										</div>
										<div id="chart_1" class="morris-chart" style="height: 240px;"></div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-body pa-0">
										<div class="table-wrap">
											<div class="table-responsive">
												<div id="support_table_wrapper" class="dataTables_wrapper"><table class="table display product-overview border-none dataTable  mb-0" id="support_table" role="grid">
													<thead>
														<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 164px;" aria-sort="ascending" aria-label="Order ID: activate to sort column descending">Order ID</th><th class="sorting" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 203px;" aria-label="Customer Name: activate to sort column ascending">Customer Name</th><th class="sorting" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 213px;" aria-label="Product: activate to sort column ascending">Product</th><th class="sorting" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 104px;" aria-label="Order Date: activate to sort column ascending">Order Date</th><th class="sorting" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 125px;" aria-label="Order Status: activate to sort column ascending">Order Status</th><th class="sorting" tabindex="0" aria-controls="support_table" rowspan="1" colspan="1" style="width: 114px;" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
													</thead>
													<tbody>
													<tr role="row" class="odd">
															<td class="sorting_1">#ORD987654</td>
															<td>John Doe</td>
															<td>Nike Air Max</td>
															<td>Dec 10</td>
															<td>
																<span class="badge badge-soft-warning">Processing</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="even">
															<td class="sorting_1">#85457892</td>
															<td>Mark Hay</td>
															<td>Beavis sidebar</td>
															<td>Oct 18</td>
															<td>
																<span class="badge badge-soft-success ">done</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="odd">
															<td class="sorting_1">#85457893</td>
															<td>Alan Gilchrist</td>
															<td>Pogody button</td>
															<td>Oct 22</td>
															<td>
																<span class="badge badge-soft-warning ">Pending</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="even">
															<td class="sorting_1">#85457894</td>
															<td>Anthony Davie</td>
															<td>Beryl iphone</td>
															<td>Oct 25</td>
															<td>
																<span class="badge badge-soft-success ">done</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="odd">
															<td class="sorting_1">#85457895</td>
															<td>David Perry</td>
															<td>Felix PSD</td>
															<td>Oct 25</td>
															<td>
																<span class="badge badge-soft-danger">pending</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="even">
															<td class="sorting_1">#85457896</td>
															<td>Anthony Davie</td>
															<td>Cinnabar</td>
															<td>Oct 25</td>
															<td>
																<span class="badge badge-soft-success ">done</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="odd">
															<td class="sorting_1">#85457897</td>
															<td>Mark Hay</td>
															<td>PSD resolution</td>
															<td>Oct 26</td>
															<td>
																<span class="badge badge-soft-warning ">Pending</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr><tr role="row" class="even">
															<td class="sorting_1">#85457898</td>
															<td>Jens Brincker</td>
															<td>Philbert chart</td>
															<td>Oct 27</td>
															<td>
																<span class="badge badge-soft-success">done</span>
															</td>
															<td><a href="javascript:void(0)" class="pr-10 text-blue" data-toggle="tooltip" title="" data-original-title="completed"><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete"></i></a></td>
														</tr></tbody>
												</table></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <!-- /Row -->



@endsection
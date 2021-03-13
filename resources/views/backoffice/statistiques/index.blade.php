@extends('layouts.adminTemplate')

@section('content')
              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                 <div class="">
                     <h1 class="h3 mb-0 text-gray-800">Les revenus</h1>
                     <small>Prendre en compte les charges du magazin</small>
                 </div>

                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
              </div>

              <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenu (Mois {{date('M')}})</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 {{number_format($earning['monthlyEarning'],2,'.',' ')}} <small> Da </small> <br/>
                                 <small style="font-weight: 700">( {{number_format($netEarning['netMonthlyEarning'],2,'.',' ')}} Da )</small>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenu (Janv - Mars)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                           {{number_format($earning['trimestreEarning'],2,'.',' ')}} <small> Da </small> <br>
                           <small style="font-weight: 700">( {{number_format($netEarning['netTrimestreEarning'],2,'.',' ')}} Da )</small>

                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenu (Janv - Juin)</div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                 {{number_format($earning['semestreEarning'],2,'.',' ')}} <small> Da </small> <br>
                                 <small style="font-weight: 700">( {{number_format($netEarning['netSemestreEarning'],2,'.',' ')}} Da )</small>


                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenu (Janv - Decembre)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                           {{number_format($earning['anneeEarning'],2,'.',' ')}} <small> Da </small> <br>
                           <small style="font-weight: 700">( {{number_format($netEarning['netAnneeEarning'],2,'.',' ')}} Da )</small>


                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="d-sm-flex align-items-left justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Charts des revenus</h1>
              </div>

              <div class="row">

                <div class="col-xl-6 col-lg-6">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary d-flex">Le revenu du mois {{date('M Y')}}
                      </h6>
                    </div>
                    <div class="card-body">
                      <div class="chart-area" id="chart"></div>
                      <div class="chart-area d-none" id="customChart"></div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary d-flex">Les dettes du mois {{date('M Y')}}
                      </h6>
                    </div>
                    <div class="card-body">
                      <div class="chart-area" id="detteChart"></div>
                    </div>
                  </div>
                </div>
              </div>



              @livewire('top-products')
@endsection

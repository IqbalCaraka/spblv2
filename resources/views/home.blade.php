@extends('layouts.admin')

@section('content')
<div class="content-wrapper" >
<!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h3 class="card-title text-primary">Halo {{Auth::user()->name}} 🎉</h3>
                            <p class="mb-4">
                            Selamat Datang di <span class="fw-bold">Sistem Persediaan Mandiri Terlayani!</span>
                            <hr> Selamat melakukan aktivitas!
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                            src="{{asset('admin/img/man-with-laptop-light.png')}}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                            />
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- To Do list -->
            <div class="col-md-12 col-lg-12 order-0 mb-4">
                <div class="card h-100">
                <h5 class="card-header">Riwayat Pengajuan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Jumlah Pengajuan</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        <td>
                          
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        <td>
                          
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        <td>
                          
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
            <!--/ Todo List -->
            <!-- Presentase jenis barang -->
            <div class="col-md-6 col-lg-9 col-xl-8 order-0 mb-4">
                <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Presentase Jenis Barang</h5>
                        <small class="text-muted">Total Stok</small>
                    </div>
                    <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">8,258</h2>
                            <span>Total Stok</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                                ><i class="bx bx-mobile-alt"></i
                            ></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Electronic</h6>
                                <small class="text-muted">Mobile, Earbuds, TV</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">82.5k</small>
                            </div>
                            </div>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
            <!--/ Presentase jenis barang -->
            <!-- Barang masuk dan keluar -->
            <div class="col-md-6 col-lg-3 col-xl-4 order-0 mb-4">
                <div class="card">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="row g-0">
                            <h5 class="card-header m-0 me-2 pb-3">Barang Masuk dan Keluar Tahunan</h5>
                        </div>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
                        </div>                        
                    </div>
                </div>
                </div>
            </div>
            <!--/ Barang masuk dan keluar -->

            <!-- Barang masuk keluar bulanan -->
            <div class="col-md-6 col-lg-6 order-0 mb-6">
                <div class="card">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="card-header m-0 me-2 pb-3">Barang Masuk dan Keluar Bulanan</h5>
                        </div>
                        <div class="col-md-3 mt-4 mr-4">
                            <div class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        2022
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                        <a class="dropdown-item" href="javascript:void(0);">Masuk</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Keluar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                            <div id="incomeChart"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Barang masuk keluar bulanan -->

            
            
            <!-- Additional -->
            <div class="col-md-6 col-lg-6 order-0 mb-4">
                <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transactions</h5>
                    <div class="dropdown">
                    <button
                        class="btn p-0"
                        type="button"
                        id="transactionID"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                        <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Paypal</small>
                            <h6 class="mb-0">Send money</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">+82.6</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Wallet</small>
                            <h6 class="mb-0">Mac'D</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">+270.69</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Transfer</small>
                            <h6 class="mb-0">Refund</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">+637.91</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Credit Card</small>
                            <h6 class="mb-0">Ordered Food</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">-838.71</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Wallet</small>
                            <h6 class="mb-0">Starbucks</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">+203.33</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    <li class="d-flex">
                        <div class="avatar flex-shrink-0 me-3">
                        <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <small class="text-muted d-block mb-1">Mastercard</small>
                            <h6 class="mb-0">Ordered Food</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">-92.45</h6>
                            <span class="text-muted">USD</span>
                        </div>
                        </div>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            <!--/ Additional -->

            
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
@endsection
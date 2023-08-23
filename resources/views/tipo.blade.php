
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('./assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('./assets/img/favicon.png') }}">
  <title>
   CATTLE
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('./assets/css/nucleo-icons.css')  }}" rel="stylesheet" />
  <link href="{{ asset('./assets/css/nucleo-svg.css')  }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('./assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('./assets/css/argon-dashboard.css?v=2.0.4')  }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  background-img-home ">  <!-- bg-gray-100 -->
  <!-- <div class="min-height-300 bg-primary position-absolute w-100"></div> -->
  <aside class="sidenav bg-black navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="{{ asset('./assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Argon Dashboard 2</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">

     @include('include.menu')

     <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
          <img class="w-50 mx-auto" src="{{ asset('./assets/img/illustrations/icon-documentation.svg') }}" alt="sidebar_illustration">
          <div class="card-body text-center p-3 w-100 pt-0">
            <div class="docs-info">
              <h6 class="mb-0">Need help?</h6>
              <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
            </div>
          </div>
        </div>
        <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">

      @include('include.navbar')

      @include('include.search')

      </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4" style="height: 1050px !important">
                <div class="card">
                  <!-- <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Sales by Country</h6>
                   </div> -->
                    <div class="card-body p-3">

                    <a href="{{route('createFormTipo')}}"> Adicionar </a>


                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                    <tr>
                                      <th >#Id</th>
                                      <th >Tipo Animal</th>
                                    </tr>
                                  </thead>
                              <tbody>
                                @foreach ($tipos as $tipo)
                                <tr>
                                  <td class="">
                                    <div class="d-flex  align-items-center" style="width: 10% !important;">
                                      <div>
                                       <img src="{{ asset('./assets/img/icons/flags/cow_blue.png') }}" alt="Country flag" width="15" height="15">
                                      </div>
                                      <div class="ms-4">
                                        <h6 class="text-sm mb-0">  {{$tipo->tipo_animal_id}} </h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <h6 class="text-sm mb-0">{{$tipo->tipo_animal}}   </h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                     <a href="/tipo_update/{{$tipo->tipo_animal_id}}" > <img src="{{ asset('./assets/img/icons/flags/editing.png') }}" alt="Country flag" width="20" height="20" > </a>
                                     <img src="{{ asset('./assets/img/icons/flags/delete.png') }}" alt="Country flag" width="20" height="20" >
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                               <!-- <tr>
                                 <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                      <div>
                                        <img src="{{ asset('./assets/img/icons/flags/DE.png')}} " alt="Country flag">
                                      </div>
                                      <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Germany</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                      <h6 class="text-sm mb-0">3.900</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                                      <h6 class="text-sm mb-0">$440,000</h6>
                                    </div>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <div class="col text-center">
                                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                      <h6 class="text-sm mb-0">40.22%</h6>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                      <div>
                                        <img src="./assets/img/icons/flags/GB.png" alt="Country flag">
                                      </div>
                                      <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Great Britain</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                      <h6 class="text-sm mb-0">1.400</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                                      <h6 class="text-sm mb-0">$190,700</h6>
                                    </div>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <div class="col text-center">
                                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                      <h6 class="text-sm mb-0">23.44%</h6>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                      <div>
                                        <img src="{{ asset('./assets/img/icons/flags/BR.png') }}" alt="Country flag">
                                      </div>
                                      <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Brasil</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                      <h6 class="text-sm mb-0">562</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                                      <h6 class="text-sm mb-0">$143,960</h6>
                                    </div>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <div class="col text-center">
                                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                      <h6 class="text-sm mb-0">32.14%</h6>
                                    </div>
                                  </td>
                                </tr> -->
                              </tbody>
                            </table>
                            <nav aria-label="...">
                                <ul class="pagination pagination-sm">
                                  <li class="page-item active" aria-current="page">
                                    <span class="page-link">1</span>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                              </nav>
                          </div>
                    </div>

                 </div>
               </div>
             </div>
        </div>
    </div>
  </main>
</body>

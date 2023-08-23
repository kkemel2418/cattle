
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
   <!--   Core JS Files   -->
   <script src="{{ asset('./assets/js/core/popper.min.js') }}"></script>
   <script src="{{ asset('./assets/js/core/bootstrap.min.js') }} "></script>
   <script src="{{ asset('./assets/js/plugins/perfect-scrollbar.min.js') }} "></script>
   <script src="{{ asset('./assets/js/plugins/smooth-scrollbar.min.js') }} "></script>
   <script src="{{ asset('./assets/js/plugins/chartjs.min.js') }} "></script>

   <script type="javascript" src="https://cdn.jsdelivr.net/npm/@barba/core@2.9.7"></script>
   <style>
    a{
        font-weight:bold;
    }
    a:hover {
      color: #E8F207 !important;
    }
    </style>

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
                <a href="javascript:history.back()">
                <img src="{{ asset('./assets/img/icons/flags/back.png') }}" alt="Country flag" width="20" height="20">
                  Voltar
                </a>
                <div class="card">
                  <!-- <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Sales by Country</h6>
                   </div> -->
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            @foreach ($tipo as $t)
                            <form action="" method="POST">
                                @t
                                @method('PUT')
                                @csrf

                                <div class="form-group">
                                    <label> Tipo Nome  </label>oioioioioi
                                    <input type="text" class="form-control" id="nome_tipo" style="width: 250px"  name="tipo_animal" value="{{$t->tipo_animal}}">
                                </div>

                                <div class="form-group"> oioioi
                                    <label for="exampleInputEmail1">Status</label>
                                    <select class="form-control"  style="width: 10%" name="status" >
                                        <option value="ativo"    >Ativo</option>
                                        <option value="inativo"  >Inativo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>

                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                           @endforeach
                          <a href="javascript:history.back()">Voltar</a>
                     </div>
                    </div>
                 </div>
               </div>
            </div>
         </div>
     </div>
   </main>
</body>

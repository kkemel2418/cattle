
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

      <!-- JS -->

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
          <!-- JavaScript Bundle with Popper -->
          <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


      </head>
      <body>

<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="{{ url('/home') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Mapa de Rebanho</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/monitoramento') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Monitoramento</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/animal') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Animais</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/vacina') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Usuário</span>
        </a>
      </li>



    <li class="nav-item">
        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link">

            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Cadastro</span>
        </a>

        <ul class="collapse hide nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
            <li class="w-100">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                  <img src="{{ asset('./assets/img/icons/flags/cow2.png') }}" alt="Country flag" width="20" height="20" style="margin-left: 8%">
                    <i class="fs-4 bi-speedometer2"></i>
                      <span class="ms-1 d-none d-sm-inline" style="color:#18F0F2">Animal</span>
                </a>
                <ul class="collapse hide nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li>
                        <a href="{{ url('/animal') }}" class="nav-link px-0"> <span style="margin-left:25% !important; color:#18F0F2">Lista</span>  </a>
                    </li>
                    <li class="w-100">
                        <a href="{{ url('/tipo') }}" class="nav-link px-0"> <span style="margin-left:25% !important; color:#18F0F2">Tipo</span>  </a>
                    </li>
                    <li>
                        <a href="{{ url('/raca') }}" class="nav-link px-0"> <span style="margin-left:25% !important; color:#18F0F2">Raça</span>  </a>
                    </li>

                </ul>
           </li>
        </ul>

        <ul class="collapse hide nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
            <li class="w-100">
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                  <img src="{{ asset('./assets/img/icons/flags/seringa.png') }}" alt="Country flag" width="20" height="20" style="margin-left: 8%">
                    <i class="fs-4 bi-speedometer2"></i>
                      <span class="ms-1 d-none d-sm-inline" style="color:#FF9C00">Vacina</span>
                </a>
                <ul class="collapse hide nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FF9C00">Fabricante</span>  </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FF9C00">Modelo</span>  </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FF9C00">Carteira de Vacinação</span>  </a>
                    </li>
                </ul>
           </li>
        </ul>

        <ul class="collapse hide nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
            <li class="w-100">
                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                  <img src="{{ asset('./assets/img/icons/flags/rfid3.png') }}" alt="Country flag" width="20" height="20" style="margin-left: 8%">
                    <i class="fs-4 bi-speedometer2"></i>
                      <span class="ms-1 d-none d-sm-inline" style="color:#FFFE12">Dispositivo</span>
                </a>
                <ul class="collapse hide nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FFFE12">Fabricante</span>  </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FFFE12">Modelo</span>  </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span style="margin-left:25% !important; color:#FFFF00">Carteira de Vacinação</span>  </a>
                    </li>
                </ul>
           </li>
        </ul>
    </li>




      <li class="nav-item">
        <a class="nav-link " href="./pages/rtl.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">RTL</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./pages/profile.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./pages/sign-in.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Sign In</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./pages/sign-up.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-collection text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Sign Up</span>
        </a>
      </li>
    </ul>
  </div>
</body>

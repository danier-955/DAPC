<header class="py-4">
  <nav class="navbar navbar-dark navbar-full bg-primary fixed-top">
    <button type="button" aria-controls="navdrawerMD" aria-expanded="false" aria-label="Toggle Navdrawer" class="navbar-toggler invisible-lg" data-target="#navdrawerMD" data-breakpoint="lg" data-toggle="navdrawer" data-type="permanent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand mr-auto">{{ config('app.name') }}</span>
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMD" aria-controls="navbarMD" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMD">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="javascript:(void);">Acerca</a>
        </div>
    </div> --}}
    <div class="navbar-nav ml-auto">
      <a class="btn btn-primary btn-float btn-sm shadow-1" href="javascript:(void);">
        <i class="material-icons">info</i>
      </a>
    </div>
  </nav>
</header>
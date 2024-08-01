<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <!-- ACA VAN LOS HEADERS -->
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      {{ __('TEMP EN') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'pedido' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('view.pedido') }}">
          <i class="material-icons">list_alt</i>
          <p>{{ __('Pedido') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
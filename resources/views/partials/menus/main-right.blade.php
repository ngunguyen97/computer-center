@guest
@else
  <ul class="navbar-nav">
    <!-- Authentication Links -->
    <li class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Tài Khoản <span class="caret"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('student.edit') }}">Hồ sơ</a>
        <a class="dropdown-item" href="{{ route('student.logout') }}"
           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
          {{ __('Đăng xuất') }}
        </a>

        <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
@endguest

<nav class="navbar navbar-expand-lg navbar-light shadow navigation">
    <div class="container-fluid">
        <a class="fs-3 pe-3 fw-bold brand" href="{{ url('/home') }}">A.I.M.S.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex align-items-center gap-3">
                <li class="nav-item">
                    <a class="link" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="{{ route('account.index') }}">Account</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="{{ route('axie.index') }}">Axie</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="{{ route('slp.index') }}">SLP</a>
                </li>
                <li class="nav-item">
                    <a class="link" href="{{ route('transaction.index') }}">Transaction</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">Divine Course</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <div class="ms-auto">
            @if (Auth::user())
            <a class="btn btn-success" href="{{route('dashboard')}}">Dashboard</a>
            <a class="btn btn-info" onclick="logOutSession()" href="#"><i class="ft-power"></i> Logout</a>
                <div class="d-none">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                  <script>
                    let logoutForm = document.getElementById('logout-form');
                    function logOutSession() {
                      logoutForm.submit();
                    }
                  </script>
                </div>
            @else
            <a class="btn btn-success" href="{{route('login')}}">Login</a>
            @endif
          
        </div>
      </div>
    </div>
  </nav>
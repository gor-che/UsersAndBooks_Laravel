<div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                @if (Route::has('login'))
                @auth
                  <a class="btn btn-success" href="{{ route('books.create') }}" title="Add a Book"> <i class="fas fa-plus-circle"></i>
                  </a>
                  @if(Request::path() != 'books')
                    <a class="btn btn-success" href="{{ route('books.index') }}" title="Books"><i class="fas fa-book"></i></a>
                  @endif
                  <a class="btn btn-success" href="user/logout" title="Logout"> <i class="fas fa-sign-out-alt"></i>
                </a>
                @else
                  <a class="btn btn-success" href="login" title="Add a Book"> Log In
                  <a class="btn btn-success" href="register" title="Add a Book"> Register
                  </a>
                @endauth
                @endif
                
                @if(Request::path() != 'user')
                  <a class="btn btn-success" href="user" title="Users"> <i class="fas fa-user"></i></a>
                @endif
            </div>
        </div>
    </div>
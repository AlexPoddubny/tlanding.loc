<div class="container">
    <div class="header_box">
        <div class="logo">
            <a href="#"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
        </div>

        @if(isset($menu))
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle"
                            data-toggle="collapse" data-target="#main-nav"><span
                                class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span
                                class="icon-bar"></span> <span
                                class="icon-bar"></span></button>
                </div>
                <div id="main-nav" class="collapse navbar-collapse navStyle">
                    <ul class="nav navbar-nav" id="mainNav">
                        @foreach($menu as $item)
                        <li>
                            <a href="#{{ $item['alias'] }}" class="scroll-link">{{ $item['title'] }}</a>
                        </li>
                        @endforeach
                        <li>
                            <a href="/admin" class="scroll-link">Admin</a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif
    </div>
</div>

@if(session('status'))
    <div class="alert alert-success alert-dismissible show">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible show">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
@endif

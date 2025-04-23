<nav class="navbar bg-body-tertiary position-fixed fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand d-flex align-content-center" href="{{ route('home') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
        </svg>
        <p class="m-2">Home</p>
    </a>

    <button
        class="navbar-toggler color-dark"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar"
        aria-label="Toggle navigation"
    >
        <span>
            <img
                src="https://i.pinimg.com/236x/2f/97/f0/2f97f05b32547f54ef1bdf99cd207c90.jpg"
                alt="Foto de perfil"
                class="rounded-circle"
                width="40"
                height="40"
            />
            Perfil
        </span>
    </button>
    <div
        class="offcanvas offcanvas-end h-min-content border-radius-10"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel"
    >
        <div class="offcanvas-header">
        <img
            src="https://i.pinimg.com/236x/2f/97/f0/2f97f05b32547f54ef1bdf99cd207c90.jpg"
            alt="Foto de perfil"
            class="rounded-circle"
            width="50"
            height="50"
        />
        <h5 class="offcanvas-title ms-3" id="offcanvasNavbarLabel">
            Perfil
        </h5>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>
        </div>
        <hr>
        <div class="offcanvas-body h-min-content">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
            </li>
            <li class="nav-item">
            </li>
        </ul>
        </div>
    </div>
    </div>
</nav>
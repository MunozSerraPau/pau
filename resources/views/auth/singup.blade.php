<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SingUp</title>

        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body class="bg-light">
        <x-header />   <!-- Incluye el header -->

        <main class="container d-flex justify-content-center align-items-center my-5">
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <form method="POST">
                    <h1 class="text-center mb-4">Sing Up</h1>

                    <div class="mb-3">
                        <label for="username" class="form-label">Usuari</label>
                        <input type="text" id="username" name="username" class="form-control" value="">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contrasenya</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="recordam" class="form-check-input" id="recordam">
                        <label class="form-check-label" for="recordam">Recorda'm</label>
                    </div>


                    <?php if (isset($_SESSION['loginRecaptcha']) && $_SESSION['loginRecaptcha'] >= 3): ?>
                        <div class="form-check mb-3">
                            <div class="g-recaptcha" data-sitekey="6LeC3owqAAAAAIal4nLI9qPQlIGPLOmnbjEYuq9L"></div>
                        </div>
                    <?php endif; ?>


                    <div class="mb-3">
                        <p class="form-text">Has oblidat la contrasenya? <a href="#" class="link-primary">Recuperar </a></p>
                    </div>

                    <?php if (isset($error)): ?>
                        <!-- Mirar si va -->
                        <?php if (!empty($error) && $error != "UsuariConnectat"): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <div><?php echo $error; ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-grid mb-3">
                        <a type="submit" href="#" class="btn btn-primary" name="login">Iniciar sesión</a>
                    </div>

                    <div>
                        <a href="#" aria-label="Iniciar sesión con Reddit" class="btn btn-reddit border-0 p-0 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-reddit fs-1"></i>
                        </a>
                    </div>

                    <p class="text-center">No tens un compte? <a href="#" class="link-primary">Registra't</a></p>
                </form>
            </div>
        </main>

        <x-footer /> <!--Incluye el footer -->
    </body>
</html>
<footer class="bg-dark text-white mt-5 p-4">
    <div class="container text-center">
        <h5>Usuario Autentificado</h5>
        <ul class="list-unstyled">
            <div class="text-light ms-3">
                <p class="mb-0">Usuario: {{ Auth::user()->name }}</p>
                <p class="mb-0">Correo: {{ Auth::user()->email }}</p>
            </div>
        </ul>
    </div>
</footer>

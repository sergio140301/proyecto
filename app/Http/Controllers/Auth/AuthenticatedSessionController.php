<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Autenticación del usuario
        $request->authenticate();

        // 2. Regenera la sesión
        $request->session()->regenerate();

        // 3. Obtiene el usuario autenticado y su correo
        $user = Auth::user();
        $email = $user->email;

        // 4. Asigna el navbar según el tipo de usuario basado en la letra del correo electrónico

        // Si el email comienza con 'A', asigna el navbar del admin
        if (str_starts_with($email, 'A')) {
            session(['navbar' => '1-navbar-admin']);
            return redirect()->intended(route('menu3', absolute: false)); // Redirige al menu3
        }
        // Si el email comienza con 'L', asigna el navbar del alumno
        elseif (str_starts_with($email, 'L')) {
            session(['navbar' => '2-navbar-alumno']);
            return redirect()->intended(route('menu2', absolute: false)); // Redirige al menu2
        }
        // Si el email comienza con 'C', asigna el navbar del coordinador
        elseif (str_starts_with($email, 'C')) {
            session(['navbar' => '3-navbar-coord']);
            return redirect()->intended(route('menu2', absolute: false)); // Redirige al menu2
        }
        // Si el email comienza con 'T', asigna el navbar del tutor
        elseif (str_starts_with($email, 'T')) {
            session(['navbar' => '4-navbar-tutor']);
            return redirect()->intended(route('menu2', absolute: false)); // Redirige al menu2
        }
        // Si no coincide con ninguno de los anteriores, asigna la vista para el usuario invitado
        else {
            session(['navbar' => 'navbar-invitado']);
            return redirect('/'); // Redirige al inicio para el usuario invitado
        }
    }

    public function create(): View
    {
        return view('auth.login');  // Vista de login
    }

    protected function redirectTo()
    {
        return '/inicio2';
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

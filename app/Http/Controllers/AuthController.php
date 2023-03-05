<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Socialite;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @return RedirectResponse
     */
    public function gitRedirect(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * @return RedirectResponse
     */
    public function gitLoginCallback(): RedirectResponse
    {
        try {     
            $gitHubUser = Socialite::driver('github')->user();
            $user = $this->authService->findByGitHubId($gitHubUser->id);
      
            if (is_null($user)) {
                $user = $this->authService->store(
                    $gitHubUser->name ?? 'N/A',
                    $gitHubUser->email,
                    $gitHubUser->id,
                    $gitHubUser->user['html_url']
                );
            }
            
            Auth::login($user);

            return redirect('home');
     
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}

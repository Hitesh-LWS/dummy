<?php


namespace Faveo\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Faveo\Installer\Helpers\UserRegistrationManager;
use Faveo\Installer\Http\Requests\UserRegisterRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class AdminRegistrationController extends Controller
{

    protected $UserRegistrationManager;

    /**
     * AdminRegistrationController constructor.
     * @param UserRegistrationManager $userRegistrationManager
     *
     */
    public function __construct(UserRegistrationManager $userRegistrationManager)
    {
        $this->UserRegistrationManager = $userRegistrationManager;
    }

    /**
     * show the user registration view
     * @return Application|Factory|View|RedirectResponse
     * @author Hitesh Kumar <hitesh.kumar@ladybirdweb.com>
     */
    public function create()
    {
        try {
            Artisan::call('config:cache');
        }catch (Exception $exception){
            Log::error($exception);
        }

        if (!\config('installer.is_user_registration_enabled')) {
            /* this feature is not enabled */
            return redirect()->route('LaravelInstaller::license-code');
        }

        return view('installer::getting-started-with-admin');
            /* return view if this feature is enabled */
//        return $this->UserRegistrationManager->showRegisterView();
    }

    /**
     * store user data
     * @param UserRegisterRequest $request
     * @return Exception
     * @author Hitesh Kumar <hitesh.kumar@ladybirdweb.com>
     */
    public function store(UserRegisterRequest $request)
    {
        dd('here');
        return $this->UserRegistrationManager->createNewUser($request);
    }


    public function ok(){
        dd('ok');
    }

}

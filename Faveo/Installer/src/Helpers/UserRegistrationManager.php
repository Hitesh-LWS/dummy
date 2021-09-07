<?php


namespace Faveo\Installer\Helpers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserRegistrationManager
{
    /**
     * validate the user params with specified rules
     * @return string[]
     * @author Hitesh Kumar <hitesh.kumar@ladybirdweb.com>
     */
    public static function validationRules(): array
    {
        return validationForCreateUserInstaller();
    }

    /**
     * return the user registration view
     * @return Application|Factory|View
     * @author Hitesh Kumar <hitesh.kumar@ladybirdweb.com>
     */
    public function showRegisterView()
    {
        return view('installer::getting-started-with-admin');
    }

    /**
     * write your logic here to get User
     * @param $request
     * @return Exception
     * @author Hitesh Kumar <hitesh.kumar@ladybirdweb.com>
     */
    public function createNewUser($request)
    {
        /* implementation of this function in helper to customize your code*/
        return createUserForInstaller($request);
    }
}

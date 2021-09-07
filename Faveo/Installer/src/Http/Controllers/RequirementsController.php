<?php

namespace Faveo\Installer\Http\Controllers;

use Faveo\Installer\Helpers\RequirementsChecker;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class RequirementsController extends Controller
{

    /**
     * Display the requirements page.
     *
     * @return View
     */
    public function requirements()
    {
        $errorCount = 0;

        $requirements = new RequirementsChecker("probe");

        /* permission block  */
        $permissionBlock = $requirements->validateDirectory(base_path(), $errorCount);

        /* requirement block */
        $requisites = $requirements->validateRequisites($errorCount);

        /* PHP extension check block */
        $phpExtension = $requirements->validatePHPExtensions($errorCount);



//        /* mod rewrite status block */
//        $apacheModules = function_exists('apache_get_modules') ? (int)in_array('mod_rewrite', apache_get_modules()) : 2;
//
//        if ($apacheModules == 2) {
//            $rewriteStatusString = "Unable to detect";
//        } elseif (!$apacheModules) {
//            $rewriteStatusString = "OFF";
//        } else {
//            $rewriteStatusString = "ON";
//        }
//
//        /* safe-url status */
//        $safeUrl = $this->checkUserFriendlyUrl();
//
//        if ($safeUrl === true) {
//            $safeUrlString = 'ON';
//        } elseif ($safeUrl === false) {
//            $safeUrlString = "OFF (If you are using apache, make sure 'AllowOverride' is set to 'All' in apache configuration)";
//        } else {
//            $safeUrlString = "Unable to Detect";
//        }
//
//        $modRewrite = ['rewriteEngine' => $rewriteStatusString, 'safeUrl' => $safeUrlString];

//        Cache::put('server_requirement_error', $errorCount);

        return view('installer::server-requirement',compact('permissionBlock','requisites','phpExtension'));

    }

}

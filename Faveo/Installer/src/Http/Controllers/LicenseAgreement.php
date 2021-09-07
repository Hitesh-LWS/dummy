<?php


namespace Faveo\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class LicenseAgreement extends Controller
{
    /**
     * check all server-requirements meet or not and display finished view.
     * @return View view
     */
    public function licenseAgreement(Request  $request)
    {
        try {
            $errors = $request->server_requirement_error;

            return \view('installer::license-agreement',compact('errors'));

//            if ($errors == '0' || $errors == 0) {
//                /* all requirements are matched now show license agreement */
//                return 0;
//            } else {
//                /* error found requirement not fulfill */
//                return redirect()->back()->with('error', 'Not getting all server requirement');
//            }
        } catch (\Exception $exception) {
            Log::error($exception);
            dd($exception);
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

    }

}

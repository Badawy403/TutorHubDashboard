<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use ZipArchive;

class VersionUpgradesController extends Controller
{

    public function index()
    {
        $heading = 'Version Upgrade';
        $application_current_version = GeneralSetting::where('name', 'application_current_version')->first();
        return view('super_admins.version_upgrade.index', compact('heading', 'application_current_version'));
    }


    public function upgrade(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip|max:10240',
        ]);
        $application_current_version = GeneralSetting::where('name', 'application_current_version')->first();
        $application_current_version = $application_current_version->value ?? "1.0.0";
        $zipFile = $request->file('zip_file');
        $zipFileName = $zipFile->getClientOriginalName();
        // Get the file name without extension
        $nameWithoutExtension = pathinfo($zipFileName, PATHINFO_FILENAME);
        // Validate the version format (e.g., 1.0.3)
        if (!preg_match('/^\d+\.\d+\.\d+$/', $nameWithoutExtension)) {
            return redirect()->back()->with('message', 'Invalid version format.')->with('message_type', 'error');
        }
        if (version_compare($nameWithoutExtension, $application_current_version, '>')) {
            $zip = new ZipArchive;
            if ($zip->open($zipFile) === TRUE) {
                $zip->extractTo(base_path());
                $application_current_version = GeneralSetting::where('name', 'application_current_version')->first();
                if ($application_current_version) {
                    $application_current_version->update([
                        'value' => $nameWithoutExtension
                    ]);
                } else {
                    GeneralSetting::create([
                        'value' => $nameWithoutExtension,
                        'name' => 'application_current_version',
                        'display_name' => 'Application Current Version',
                        'page'=>'version'
                    ]);
                }

                $zip->close();
                return redirect()->back()->with('message', 'Version Updated Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Failed to extract the zip file.')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Current Application Version is equal or greater then from application version you are uploading.')->with('message_type', 'error');
        }
    }
}

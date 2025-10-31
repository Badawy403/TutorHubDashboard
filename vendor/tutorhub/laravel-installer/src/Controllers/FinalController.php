<?php

namespace TutorHub\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use TutorHub\LaravelInstaller\Events\LaravelInstallerFinished;
use TutorHub\LaravelInstaller\Helpers\EnvironmentManager;
use TutorHub\LaravelInstaller\Helpers\FinalInstallManager;
use TutorHub\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \TutorHub\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \TutorHub\LaravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \TutorHub\LaravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}

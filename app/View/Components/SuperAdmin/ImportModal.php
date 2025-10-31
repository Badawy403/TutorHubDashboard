<?php

namespace App\View\Components\SuperAdmin;

use Illuminate\View\Component;

class ImportModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $importUrl;

    public function __construct($importUrl)
    {
        $this->importUrl = $importUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.super-admin.import-modal');
    }
}

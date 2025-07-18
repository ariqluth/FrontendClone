<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
class Sidebar extends Component
{
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        //
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // user profile and logout get api from backend
        $userLogout = Http::post(env('API_BASE_URL') . '/api/v1/user/logout');
        $responseLogout = $userLogout->json();
        return view('components.sidebar', compact('responseLogout'));
    }
}

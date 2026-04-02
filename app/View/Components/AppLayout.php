<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $data['menu'] = Category::where('parent', 0)->get();
        $data['menu_icon'] =[
            'images/svg/home.svg',
            'images/svg/notification-option.svg',
            'images/svg/language-icon.svg',
            'images/svg/currency-icon.svg',
            'images/svg/about-icon.svg',
            'images/svg/privacy-icon.svg',
            'images/svg/faq-icon.svg',
            'images/svg/send-feedback-icon.svg',
            'images/svg/contact-us-icon.svg'
        ];
        return view('layouts.app', $data);
    }
}

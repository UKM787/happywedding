<?php

namespace App\Wed;

use Illuminate\Support\Traits\Macroable;

class Happy
{

    use Macroable;

    const LOCIMGPATH = '/assets/defaults/locations/images/',
        CATIMGPATH = '/assets/defaults/categories/images/',
        SERIMGPATH = '/assets/defaults/services/images/',
        TASKIMGPATH = '/assets/defaults/tasks/images/',
        CERIMGPATH = '/assets/defaults/ceramonies/images/',
        ARTIMGPATH = '/assets/defaults/articles/images/',
        TSTIMGPATH = '/assets/defaults/testimonials/images/',
        TAGIMGPATH = '/assets/defaults/tags/images/';

    const PAGES = ['/' => 'welcome', 'wedding-venues' => 'weddingvenues', 'manager-tools' => 'managertools', 'vendor-directory' => 'vendordirectory', 'ideas-and-inspiration' => 'ideasandinspiration', 'about' => 'about', 'our-story' => 'ourstory', 'benefits' => 'benefits', 'teams' => 'teams', 'help' => 'help', 'faqs' => 'faqs', 'contact-us' => 'contactus', 'terms-and-conditions' => 'termsandconditions', 'privacy-policy' => 'privacypolicy', 'careers' => 'careers', 'sitemap' => 'sitemap', 'cookies-consent' => 'cookiesconsent'];

    public $country;

    public function __construct($country)
    {
        $this->country = $country;
    }
}

<?php

namespace App\Http\Controllers;

/**
 * LocalizationController to control the language.
 * @author Zin Lin Htet
 * @created 05/07/2023
 */
class LocalizationController extends Controller
{
    /**
     *  Handle the logic for switching the application's locale or language.
     * @author Zin Lin Htet
     * @created 05/07/2023
     * @param $locale
     * @return 'redirect'
     */
    public function setLang($locale)
    {
        if ($locale == 'en' || $locale == 'mm') {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        }
        return redirect()->back();
    }
}

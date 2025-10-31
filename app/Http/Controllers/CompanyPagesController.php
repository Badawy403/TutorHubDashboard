<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CompanyPagesResource;
use App\Http\Resources\Web\FAQCategoriesResource;
use App\Models\CompanyPage;
use App\Models\FAQCategory;
use App\Models\Teacher;

class CompanyPagesController extends Controller
{
    public function __construct()
    {
    }

    public function companyPage(Request $request,$slug)
    {
        $company_page = CompanyPage::where('slug',$slug)->first();
        if($company_page){
            $company_page = new CompanyPagesResource($company_page);
            return Inertia::render('CompanyPage',['company_page' => $company_page]);
        }
        else{
            abort(404);
        }
    }

    public function faqs(Request $request)
    {
        $faq_categories = FAQCategory::whereHas('faqs',function($q){
            $q->where('is_active',1);
        })->withAll()->withChildrens()->get();
        $faq_categories = FAQCategoriesResource::collection($faq_categories);
        return Inertia::render('FAQ',['faq_categories' => $faq_categories]);
    }
    public function about(Request $request)
    {
        $about_page = CompanyPage::where('slug','about')->first();
        $about_page = new CompanyPagesResource($about_page);
        return Inertia::render('About',['about_page' => $about_page]);
    }
}

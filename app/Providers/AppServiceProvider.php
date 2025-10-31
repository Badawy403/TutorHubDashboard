<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        JsonResource::withoutWrapping();
        Schema::defaultStringLength(255);
        $data['basic'] = (object) config('basic');

        View::share($data);
        ini_set('memory_limit',-1);
        ini_set('max_execution_time',-1);
        ini_set('post_max_size',-1);
        if (File::exists(storage_path('installed'))) {
             View::share('active_languages',allLanguages() );
             $application_current_version = GeneralSetting::where('name', 'application_current_version')->first();
             View::share('application_current_version',$application_current_version);
            }

        RedirectResponse::macro('withResponseData',function($value){
            $response_data = session()->get('response_data');
            session()->flash('response_data', $value);
        });

        // Builder::macro('whereLike', function ($attributes, string $searchTerm) {
        //     $this->where(function (Builder $query) use ($attributes, $searchTerm) {
        //         $searchTerm = strtolower($searchTerm);
        //         foreach (Arr::wrap($attributes) as $attribute) {
        //             $query->when(
        //                 str_contains($attribute, '.'),
        //                 function (Builder $query) use ($attribute, $searchTerm) {
        //                     [$relationName, $relationAttribute] = explode('.', $attribute);

        //                     $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
        //                         $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
        //                     });
        //                 },
        //                 function (Builder $query) use ($attribute, $searchTerm) {
        //                     $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        //                 }
        //             );
        //         }
        //     });
        //     return $this;
        // });

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                $searchTerm = strtolower($searchTerm);
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                if (str_contains($relationAttribute, '->')) {
                                    $searchCheck = explode('->', $relationAttribute);
                                    if (count($searchCheck) >= 2) {
                                        $attribute = "JSON_EXTRACT(`$searchCheck[0]`" . ",'$.$searchCheck[1]')";
                                        // $relationAttribute = $searchCheck[0].'->'."'$.$searchCheck[1]'";
                                    } else {
                                        $relationAttribute = $searchCheck[0];
                                    }
                                }
                                $words = explode(' ', $searchTerm);
                                foreach ($words as $key => $word) {
                                    # code...
                                    $query->where(DB::raw("lower($relationAttribute)"), 'LIKE', "%{$word}%");
                                }
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            if (str_contains($attribute, '->')) {
                                $searchCheck = explode('->', $attribute);
                                if (count($searchCheck) >= 2) {
                                    $attribute = "JSON_EXTRACT(`$searchCheck[0]`" . ",'$.$searchCheck[1]')";
                                    // $attribute = $searchCheck[0].'->'."'$.$searchCheck[1]'";
                                } else {
                                    $attribute = $searchCheck[0];
                                }
                            }
                            $words = explode(' ', $searchTerm);
                            foreach ($words as $key => $word) {
                                # code...
                                $query->orWhere(DB::raw("lower($attribute)"), 'LIKE', "%{$word}%");
                            }
                            // dd($attribute);
                        }
                    );
                }
            });
            return $this;
        });
    }
}

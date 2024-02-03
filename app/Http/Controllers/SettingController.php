<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('settings_module.general_settings.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $settings = System::pluck('value', 'key');
        $config_languages = config('constants.langs');
        $languages = [];
        foreach ($config_languages as $key => $value) {
            $languages[$key] = $value['full_name'];
        }
        $currencies  = $this->allCurrencies();
        $selected_currencies=System::getProperty('currency') ? json_decode(System::getProperty('currency'), true) : [];
        return view('settings.index',compact('settings','languages','currencies','selected_currencies'));
    }
    public function allCurrencies($exclude_array = [])
    {
        $query = Currency::select('id', DB::raw("concat(country, ' - ',currency, '(', code, ') ', symbol) as info"))
            ->orderBy('country');
        if (!empty($exclude_array)) {
            $query->whereNotIn('id', $exclude_array);
        }

        $currencies = $query->pluck('info', 'id');

        return $currencies;
    }
    public function removeImage($type)
    {
        try {
            System::where('key', $type)->update(['value' => null]);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }
    public function updateGeneralSetting(Request $request)
    {
        if( !auth()->user()->can('settings_module.general_settings.edit')
            || !auth()->user()->can('settings_module.general_settings.create')
          )
        {
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            System::updateOrCreate(
                ['key' => 'site_title'],
                ['value' => $request->site_title, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'developed_by'],
                ['value' => $request->developed_by, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'timezone'],
                ['value' => $request->timezone, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'invoice_terms_and_conditions'],
                ['value' => $request->invoice_terms_and_conditions, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'language'],
                ['value' => $request->language, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            if (!empty($request->language)) {
                session()->put('language', $request->language);
            }
            System::updateOrCreate(
                ['key' => 'currency'],
                ['value' => $request->currency, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'tax'],
                ['value' => $request->tax, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            if (!empty($request->currency))
            {
                $currency = Currency::find($request->currency);
                $currency_data = [
                    'country' => $currency->country,
                    'code' => $currency->code,
                    'symbol' => $currency->symbol,
                    'decimal_separator' => '.',
                    'thousand_separator' => ',',
                    'currency_precision' => !empty(System::getProperty('numbers_length_after_dot')) ? System::getProperty('numbers_length_after_dot') : 5,
                    'currency_symbol_placement' => 'before',
                ];
                $request->session()->put('currency', $currency_data);
            }
            System::updateOrCreate(
                ['key' => 'invoice_lang'],
                ['value' => $request->invoice_lang, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'help_page_content'],
                ['value' => $request->help_page_content, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'watsapp_number'],
                ['value' => $request->watsapp_number, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            System::updateOrCreate(
                ['key' => 'discount_per_kilo'],
                ['value' => $request->discount_per_kilo, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );
            // +++++++++++++++ Packing tape : شريط التغليف +++++++++++++++
            System::updateOrCreate(
                ['key' => 'packing_tape'],
                ['value' => $request->packing_tape, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
            );

            $data['logo'] = null;
            if ($request->has('logo') && !is_null('logo')) {
                $imageData = $this->getCroppedImage($request->logo);
                $extention = explode(";", explode("/", $imageData)[1])[0];
                $image = rand(1, 1500) . "_image." . $extention;
                $filePath = public_path('uploads/' . $image);
                $data['logo'] = $image;
                $fp = file_put_contents($filePath, base64_decode(explode(",", $imageData)[1]));
            }

            foreach ($data as $key => $value) {
                if (!empty($value)) {
                    System::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value, 'date_and_time' => Carbon::now(), 'created_by' => Auth::user()->id]
                    );
                    if ($key == 'logo') {
                        $logo = System::getProperty('logo');
                        $request->session()->put('logo', $logo);
                    }
                }
            }
            Artisan::call("optimize:clear");
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

    return redirect()->back()->with('status', $output);

    }
    function getCroppedImage($img)
    {
        if (strlen($img) < 200) {
            return $this->getBase64Image($img);
        } else {
            return $img;
        }
    }
    function getBase64Image($Image)
    {
        $image_path = str_replace(env("APP_URL") . "/", "", $Image);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $image_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $image_content = curl_exec($ch);
        curl_close($ch);
        $base64_image = base64_encode($image_content);
        $b64image = "data:image/jpeg;base64," . $base64_image;
        return $b64image;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

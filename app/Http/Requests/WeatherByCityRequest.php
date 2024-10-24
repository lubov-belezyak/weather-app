<?php

namespace App\Http\Requests;

use App\Enums\WeatherMode;
use App\Enums\WeatherUnits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeatherByCityRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'city' => 'required|string',
            'state_code' => 'nullable|string|max:2',
            'country_code' => 'nullable|string|max:2',
            'mode' => ['nullable', 'string', Rule::enum(WeatherMode::class)],
            'units' => ['nullable','string', Rule::enum(WeatherUnits::class)],
            'lang' => 'nullable|string|max:5',
        ];
    }
}

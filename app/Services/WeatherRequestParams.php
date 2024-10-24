<?php

namespace App\Services;

use App\Enums\WeatherMode;
use App\Enums\WeatherUnits;

class WeatherRequestParams
{
    private string $city;
    private ?string $stateCode;
    private ?string $countryCode;
    private ?string $mode;
    private ?string $units;
    private ?string $lang;

    public function __construct(
        string  $city,
        ?string $stateCode = null,
        ?string $countryCode = null,
        ?string $mode = null,
        ?string $units = null,
        ?string $lang = null
    )
    {
        $this->city = $city;
        $this->stateCode = $stateCode;
        $this->countryCode = $countryCode;
        $this->mode = $mode;
        $this->units = $units;
        $this->lang = $lang;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getStateCode(): ?string
    {
        return $this->stateCode;
    }

    public function setStateCode(?string $stateCode): void
    {
        $this->stateCode = $stateCode;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(?string $mode): void
    {
        $this->mode = $mode;
    }

    public function getUnits(): ?string
    {
        return $this->units;
    }

    public function setUnits(?string $units): void
    {
        $this->units = $units;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): void
    {
        $this->lang = $lang;
    }
}

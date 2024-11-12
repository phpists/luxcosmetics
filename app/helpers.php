<?php

function getSeoTemplateTitle(\App\Enums\SeoTemplateEnum $seoTemplateEnum, mixed $model = null): string
{
    return \App\Models\SeoTemplate::whereType($seoTemplateEnum->value)->first()?->getReadyTitle($model);
}

function getSeoTemplateDescription(\App\Enums\SeoTemplateEnum $seoTemplateEnum, mixed $model = null): string
{
    return \App\Models\SeoTemplate::whereType($seoTemplateEnum->value)->first()?->getReadyDescription($model);
}

if (!function_exists('get_config_value')) {
    function get_config_value(string $key, mixed $default = null): mixed
    {
        return \App\Services\SiteConfigService::getParamValue($key) ?? $default;
    }
}

<?php

function getSeoTemplateTitle(\App\Enums\SeoTemplateEnum $seoTemplateEnum, mixed $model = null): string
{
    return \App\Models\SeoTemplate::whereType($seoTemplateEnum->value)->first()?->getReadyTitle($model);
}

function getSeoTemplateDescription(\App\Enums\SeoTemplateEnum $seoTemplateEnum, mixed $model = null): string
{
    return \App\Models\SeoTemplate::whereType($seoTemplateEnum->value)->first()?->getReadyDescription($model);
}

@php
    $brandLogoPath = \App\Models\Setting::where('key', 'brand_logo')->value('value');
    $brandName = \App\Models\Setting::where('key', 'brand_name')->value('value') ?? 'EduForm';
    $brandSubtitle = \App\Models\Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment';
    $fullBrandName = trim($brandName . ' ' . $brandSubtitle);
@endphp
<x-layouts.landing :fullBrandName="$fullBrandName" :brandLogoPath="$brandLogoPath">
    <x-landing.header :brandName="$brandName" :brandLogoPath="$brandLogoPath" />
    <x-landing.hero />
    <x-landing.features />
    <x-landing.footer :brandName="$brandName" :fullBrandName="$fullBrandName" />
</x-layouts.landing>

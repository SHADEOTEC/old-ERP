@php
$pattern = '/<img class="ml6 logo-img"(.*?)>/i';
$replacer = '<img class="ml6 logo-img replaced" src="{{ $data[' . '"logo"' . '] }}" width="200px" height="125px" style="width: 25%;">';

$rawHtml = $emails_content->quote_template;
if($data['logo'] && $data['logo'] != ""){
	$rawHtml = preg_replace($pattern, $replacer, $rawHtml);
}

$html = bladeCompile($rawHtml, ['data' => $data, 'seller_name' => $seller_name]);

@endphp

{!! $html !!}
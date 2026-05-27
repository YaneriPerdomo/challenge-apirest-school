<?php
if (!function_exists('converter_slug')) {
    function converter_slug($name_lastname, $cedula = '')
    {

        $text = Str::slug($name_lastname);

        if ($cedula != '') {
            $text .= '-' . $cedula;
        }

        return $text;
    }
}
use Carbon\Carbon;

if (!function_exists('formatting_date')) {
    function formatting_date($data)
    {
        if (!$data || $data == null) {
            return 'N/A';
        }
        $fullDateString = substr($data, 0, 10);
        $dateParts = explode('-', $fullDateString);
        $formattedDate = $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
        $dateTimeString = $data;


        echo $formattedDate ;
    }
}
if (!function_exists('formatting_date_h')) {
    function formatting_date_h($data)
    {
        if (!$data || $data == null) {
            return 'N/A';
        }
        $fullDateString = substr($data, 0, 10);
        $dateParts = explode('-', $fullDateString);
        $formattedDate = $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
        $dateTimeString = $data;
        $dateTime = new DateTime($dateTimeString);

        $formattedTime = $dateTime->format('g:i a');


        echo $formattedDate . ' ' . $formattedTime;
    }
}
/*
if (!function_exists('generate_cost_sale')) {
    function generate_cost_sale(
        $cost_price,
        $profit_margin,
        $discount = 0,
        $bs = 0
    ) {
        $profit_amount_usd = $cost_price * ($profit_margin / 100);
        $initial_selling_price_usd = $cost_price + $profit_amount_usd;
        $final_selling_price_usd = $initial_selling_price_usd;
        if ($discount > 0) {
            $discount_amount_usd = $initial_selling_price_usd * ($discount / 100);
            $final_selling_price_usd = $initial_selling_price_usd - $discount_amount_usd;
        }
        $final_selling_price_bs_calculated = 0;
        if ($bs != null) {
            if ($bs > 0) {
                $final_selling_price_bs_calculated = $final_selling_price_usd * $bs;
            }
        }
        $final_selling_price_usd_formatted = number_format($final_selling_price_usd, 2, '.', ',');
        if ($bs != null) {
            $final_selling_price_bs_formatted = number_format($final_selling_price_bs_calculated, 2, ',', '.');
            return 'USD: ' . $final_selling_price_usd_formatted .
                '<br> BS: ' . $final_selling_price_bs_formatted;
        } else {
            return $final_selling_price_usd_formatted;
        }
    }
}*/
?>

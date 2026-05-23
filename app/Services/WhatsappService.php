<?php

namespace App\Services;

use App\Models\WhatsappSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    /**
     * Sends a WhatsApp OTP using CallMeBot API.
     * 
     * @param string $otp 6-digit verification code
     * @return bool
     */
    public static function sendOtp($otp)
    {
        $settings = WhatsappSetting::first();

        if (!$settings || $settings->phone_number == '0000000000' || $settings->api_key == 'placeholder') {
            Log::warning("WhatsApp 2FA settings are not configured. You can use the MASTER OTP: 205677 to log in.");
            return false;
        }

        // Concatenate country code and phone number
        $fullNumber = $settings->country_code . $settings->phone_number;
        $message = "Your Security Verification Code is: " . $otp . ". This code expires in 10 minutes.";
        $apiKey = $settings->api_key;

        // Construct the CallMeBot URL
        $url = "https://api.callmebot.com/whatsapp.php?phone=" . $fullNumber . "&text=" . urlencode($message) . "&apikey=" . $apiKey;

        Log::info("Dispatching WhatsApp OTP to {$fullNumber}");

        try {
            $response = Http::get($url);
            
            if ($response->successful()) {
                Log::info("WhatsApp OTP successfully sent via CallMeBot to {$fullNumber}");
                return true;
            }

            Log::error("CallMeBot API Error: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("WhatsApp Service Exception: " . $e->getMessage());
            return false;
        }
    }
}

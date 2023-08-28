<?php

namespace App\Http\Controllers\Api\Verification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Verification\SendCodeRequest;
use App\Http\Requests\Verification\VerifyRequest;
use App\Models\Verification\Verification;
use App\Traits\HasHttpResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use HasHttpResponse;

    // TODO more security enhancements
    public function send(SendCodeRequest $request)
    {
        $verification_data = $request->validated();
        $verification_data['otp'] = rand(1000, 9999);
        $verification = Verification::create($verification_data);

        if (app()->isLocal()) {
            return $this->getSuccessJsonResponse([
                'otp' => $verification->otp
            ], 'Verification code sent successfully');
        }
        
        // @TODO create service to send the code
        return $this->getSuccessJsonResponse([], 'Verification code sent successfully');
    }

    public function verify(VerifyRequest $request)
    {
        $verification = Verification::where([
            ['otp', $request->otp],
            ['dial_code', $request->dial_code],
            ['phone', $request->phone],
            ['email', $request->email]
        ])->first();

        if ($verification) {
            $verification->increment('attempts', 1, ['verified_at' => now()]);
            
            return $this->getSuccessJsonResponse([], 'Successfully verified .');
        }
        
        $verification->increment('attempts');
        
        return $this->getErrorJsonResponse($request->all(), 'OTP is wrong try again!');
    }
}

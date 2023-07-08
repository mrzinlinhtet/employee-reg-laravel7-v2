<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ForgotPasswordMailController extends Controller
{
    public function getForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function postForgotForm(ForgotPasswordRequest $request)
    {
        $employee = Employee::where('email_address', $request->email_address)->first();
        if ($employee) {
            $this->generateOTP($employee);
            Session::put('verifyEmpId',$employee->id);
            return redirect()->route('verify-otp');
        } else {
            return redirect()->route('verify-otp')->with(['error' => "$request->email_address is not a valid email address"]);
        }
    }

    private function generateOTP(Employee $employee)
    {
        $otp = sprintf('%06d', rand(1, 999999));
        $employee->otp = $otp;
        if ($employee->update()) {
            $mail = [
                'title' => 'OTP for Forgot Password',
                'subject' => 'OTP for Forgot Password',
                'otp' => $otp,
            ];
            Mail::to($employee->email_address)->send(new ForgotPasswordMail($mail));
        }
    }

    public function getVerifyOTPForm()
    {
        return view('auth.verify-otp');
    }

    public function postVerifyOTPForm(VerifyOTPRequest $request)
    {
        $employee = Employee::where('id', $request->empid)
                            ->where('otp', $request->otp)->first();
        if ($employee) {
            $employee->otp = null;
            if ($employee->update()) {
                return redirect()->route('change-password');
            }
        } else {
            return redirect()->route('verify-otp')->with(['error' => "OTP code is not correct"]);
        }    
    }

    public function getChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $employee = Employee::where('id', $request->empid)->first();

        if ($employee) {
            $employee->password = Hash::make($request->password);
            if ($employee->update()) {
                Session::forget('verifyEmpId');
                return redirect()->route('login');
            }
        } 
    }
}

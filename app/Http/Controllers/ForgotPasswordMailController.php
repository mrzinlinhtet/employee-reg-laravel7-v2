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

/**
 * ForgotPasswordMailController to handle the mail for forgot password.
 * @author Zin Lin Htet
 * @created 10/07/2023
 */
class ForgotPasswordMailController extends Controller
{
    /**
     * Display the forgot password form
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @return 'view'
     */
    public function getForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Get incoming email and check this email with email of db
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @param ForgotPasswordRequest $request
     * @return 'redirect'
     */
    public function postForgotForm(ForgotPasswordRequest $request)
    {
        $employee = Employee::where('email_address', $request->email_address)->first();
        if ($employee) {
            $this->generateOTP($employee);
            Session::put('verify-empid', $employee->id);
            return redirect()->route('verify-otp');
        } else {
            return redirect()->route('forgot-password')->with(['error' => "$request->email_address is not a valid email address!"]);
        }
    }

    /**
     * Generate OTP and store in db 
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @param Employee $employee
     * @return 'object'
     */
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

    /**
     * Display the verify password form
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @return 'view'
     */
    public function getVerifyOTPForm()
    {
        return view('auth.verify-otp');
    }

    /**
     * Get incoming OTP code and check this OTP with OTP of db
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @param VerifyOTPRequest $request
     * @return 'redirect'
     */
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
            return redirect()->route('verify-otp')->with(['error' => "OTP code is not correct!"]);
        }
    }

    /**
     * Display the change password form
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @return 'view'
     */
    public function getChangePasswordForm()
    {
        return view('auth.change-password');
    }

    /**
     * Update the new password in db
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @param ChangePasswordRequest $request
     * @return 'redirect'
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $employee = Employee::where('id', $request->empid)->first();

        if ($employee) {
            $employee->password = Hash::make($request->password);
            if ($employee->update()) {
                Session::forget('verify-empid');
                return redirect()->route('login')->with('success', 'Password has been updated.');
            }
        }
    }
}

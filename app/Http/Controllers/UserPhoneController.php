<?php

namespace App\Http\Controllers;

use App\Models\UsersPhoneNumber;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserPhoneController extends Controller
{
    public function storePhoneNumber(Request  $request)
    {


        $validatedData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number|numeric'
        ]);

        $user =  new UsersPhoneNumber($request->all());
        $user->save();
        $this->sendMessage('User registration successful!!', $request->phone_number);
        return back()->with(['success' => "{$request->phone_number} registerd"]);
    }


    public function show()
    {
        $users = UsersPhoneNumber::all();
        return view('smstest', ['users' => $users]);
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */

    // The Twilio messages->create() 
    //function takes in two parameters of a receiver of the message and
    // an array with the properties of from and body where from is your active Twilio phone number

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);

        $client->messages->create(
            $recipients,
            ['from' => $twilio_number, 'body' => $message]
        );
    }

    /**
     * Send message to a selected users
     */
    public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class TransactionsController extends Controller
{


    public function deposit(Request $request)
    {

        $request->validate(['amount'=>'required|integer']);
        $user=$request->user();
        $userInfo=$user->userInfo;
        $userInfo->update(['amount'=>$userInfo->amount+$request->amount]);
        return response(['message'=>'deposit success!'],200);
    }


    //validate email and amount
    //check if amount is sufficient or not
    //check if targeted email exists
    //send money
    //save history
    public function sendMoney(Request $request)
    {

        $request->validate(['receiver_email'=>'required|email','amount'=>'required|integer']);
        $user=$request->user();
        if(!($user->userInfo->amount >= $request->amount))
        {
            return response(['message'=>"insufficient balance"],402);
        }
        $receiverUser=User::where('email',$request->receiver_email)->first();

        if(!$receiverUser)
        {
            return response(['message'=>"receiver email not found"],404);
        }

        $userInfo=$user->userInfo;

        $receiverInfo=$receiverUser->userInfo;

        $userInfo->update(['amount'=>$userInfo->amount-$request->amount]);
        $receiverInfo->update(['amount'=>$receiverInfo->amount+$request->amount]);

        $user->sendtransactions()->create([
            'receiver_id'=>$receiverUser->id,
            'amount'=>$request->amount
        ]);

        return response(['message'=>'transaction successfull',"sender"=>$user,'receiver'=>$receiverUser],200);
    }


//    sends user info with his history
    public function transactions(Request $request)
    {
        $transactions=$request->user()->load(['sendtransactions','recievedTranscactions','sendtransactions.receiver','recievedTranscactions.sender']);
        return response($transactions,200);

    }
}

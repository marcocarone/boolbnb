<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Apartment;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where("user_id", Auth::id())->get();
        return view('upr.messages.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
          'email' => 'string|max:90|required|email',
          'message' => 'string|required|min:10|max:700'

        ]);

        $newMessage = new Message;
        $newMessage->fill($data);
        $saved = $newMessage->save();
        if (!$saved) {
            return redirect()->back()->with('status', "C'è stato un problema. Il messaggio non è stato mandato");
        }
        return redirect()->back()->with('status', 'email mandata');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $idUser = Auth::user()->id;
        if (empty($message)) {
            abort(400);
        }

        if ($message->apartment->user->id != $idUser) {
            abort(401);
          }

          $message->delete();
          return redirect()->back();
    }
}

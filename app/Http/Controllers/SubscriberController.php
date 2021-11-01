<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  StoreSubscriberRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubscriberRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        $is_email_exist = Subscriber::with('websites')->where('email', $request->get('email'))->get();
        if ($is_email_exist->count()) {
            $subscriber = $is_email_exist->first();
            if ( ! $subscriber->hasSubscribed($request->get('website_id'))) {
                $subscriber->websites()->attach($request->get('website_id'));
            } else {
                return response()->json('This email has already subscribed website', 200);
            }
        } else {
            $subscriber             = new Subscriber();
            $subscriber->first_name = trim($request->get('first_name'));
            $subscriber->last_name  = trim($request->get('last_name'));
            $subscriber->email      = trim($request->get('email'));
            $subscriber->save();
            $subscriber->websites()->attach($request->get('website_id'));
        }

        return response()->json(['subscriber' => $subscriber]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

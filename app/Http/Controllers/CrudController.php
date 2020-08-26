<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;
    public function create()
    {
        //view form to add this offer
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {

        $file_name = $this->saveImage($request->photo, 'images/offers');

        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => 'offer added successfully']);
    }

    public function all()
    {

        $offers = Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        )->limit(10)->get(); // return collection

        return view('offers.all', compact('offers'));
    }

    public function edit($offer_id)
    {
        $offer = Offer::find($offer_id);  // search in given table id only

        if (!$offer)
            return redirect()->back();

        return view('offers.edit', compact('offer'));
    }

    public function update(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);

        if (!$offer)
            return redirect()->back();

        $offer->update($request->all());

        return redirect()->back()->with(['success' => __('messages.offer updated successfully')]);
    }

    public function delete($offer_id)
    {
        //check if offer id exists

        $offer = Offer::find($offer_id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return redirect()
            ->route('offers.all')
            ->with(['success' => __('messages.offer deleted successfully')]);
    }



    public function getVideo()
    {
        $video = Video::first();
        event(new VideoViewer($video)); //fire event
        return view('video')->with('video', $video);
    }
}

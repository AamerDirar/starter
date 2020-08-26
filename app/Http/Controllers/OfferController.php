<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {
        return view('ajaxoffers.create');
    }

    public function store(Request $request)
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

        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاولة مجدداً',
            ]);
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

        return view('ajaxoffers.all', compact('offers'));
    }


    public function delete(Request $request)
    {

        $offer = Offer::find($request->id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request->id
        ]);
    }

    public function edit(Request $request)
    {
        $offer = Offer::find($request->offer_id); // search in given table id only
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود'
            ]);

        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($request->offer_id);

        return view('ajaxoffers.edit', compact('offer'));
    }

    public function update(Request $request)
    {
        $offer = Offer::find($request->offer_id);

        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود'
            ]);

        $offer->update($request->all());

        if ($offer)
        return response()->json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح',
        ]);
    }
}

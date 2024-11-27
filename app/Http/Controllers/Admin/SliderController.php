<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImagesRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function addImages()
    {
        $admin = Auth::user();

        $images = Slider::get(['photo']);
        return view('dashboard.sliders.create', compact('images', 'admin'));
    }

    public function saveSliderImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function saveSliderImagesDB(SliderImagesRequest $request)
    {
        try {

            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Slider::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => 'SuccessFully Created']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['success' => 'SuccessFully Created']);
        }

    }
}

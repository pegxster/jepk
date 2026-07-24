<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('sort_order')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'badge'      => 'nullable|string|max:100',
            'script'     => 'nullable|string|max:200',
            'title'      => 'required|string|max:200',
            'phrase'     => 'nullable|string|max:500',
            'btn1_text'  => 'nullable|string|max:100',
            'btn1_url'   => 'nullable|string|max:500',
            'btn2_text'  => 'nullable|string|max:100',
            'btn2_url'   => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
            'image'      => 'required|image|max:5120',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/slides', 'public');
        }

        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide créé !');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'badge'      => 'nullable|string|max:100',
            'script'     => 'nullable|string|max:200',
            'title'      => 'required|string|max:200',
            'phrase'     => 'nullable|string|max:500',
            'btn1_text'  => 'nullable|string|max:100',
            'btn1_url'   => 'nullable|string|max:500',
            'btn2_text'  => 'nullable|string|max:100',
            'btn2_url'   => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
            'image'      => 'nullable|image|max:5120',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? $slide->sort_order ?? 0);

        if ($request->hasFile('image')) {
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            $data['image'] = $request->file('image')->store('images/slides', 'public');
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide mis à jour !');
    }

    public function destroy(Slide $slide)
    {
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', 'Slide supprimé.');
    }
}

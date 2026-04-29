<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certification;
use App\Models\Message;

class PortfolioController extends Controller
{
    public function index()
    {
        // Pluck settings into a key-value array
        $settings = Setting::pluck('value', 'key')->toArray();
        $projects = Project::all();
        $skills = Skill::orderBy('proficiency', 'desc')->get();
        $experiences = Experience::orderBy('id', 'desc')->get();
        $certifications = Certification::orderBy('id', 'desc')->get();

        return view('portfolio.index', compact('settings', 'projects', 'skills', 'experiences', 'certifications'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect('/#contact')->with('success', 'Your message has been sent successfully! I will get back to you soon.');
    }
}

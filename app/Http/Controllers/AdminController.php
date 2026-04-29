<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certification;
use App\Models\Message;
use App\Mail\ReplyMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'experiences' => Experience::count(),
            'certifications' => Certification::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];
        
        $settings = Setting::all();
        return view('admin.dashboard', compact('stats', 'settings'));
    }

    public function settings()
    {
        $settings = Setting::all();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $allowedKeys = [
            'site_title', 'site_description', 'contact_email', 'hero_name', 'hero_title', 'about_subtitle', 'about_me',
            'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name',
            'cube_text_front', 'cube_text_back', 'cube_text_right', 'cube_text_left', 'cube_text_top', 'cube_text_bottom',
            'github_url', 'linkedin_url', 'twitter_url', 'facebook_url', 'blog_url'
        ];
        
        $fileKeys = ['profile_picture', 'cube_img_front', 'cube_img_back', 'cube_img_right', 'cube_img_left', 'cube_img_top', 'cube_img_bottom'];

        $inputs = $request->only(array_merge($allowedKeys, $fileKeys));
        
        foreach ($inputs as $key => $value) {
            if (in_array($key, $fileKeys) && $request->hasFile($key)) {
                $request->validate([
                    $key => 'image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:2048'
                ]);
                $path = $request->file($key)->store('settings', 'public');
                $value = '/storage/' . $path;
            } elseif (!in_array($key, $allowedKeys)) {
                continue;
            }
            
            if ($value !== null) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }
        
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function markMessageRead($id)
    {
        $message = Message::findOrFail($id);
        $message->is_read = true;
        $message->save();
        
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function replyMessage(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string',
            'sender_email' => 'required|email'
        ]);
        
        $message = Message::findOrFail($id);
        
        // Load custom SMTP settings from database
        $settings = Setting::pluck('value', 'key')->toArray();
        
        if (isset($settings['mail_host'])) {
            Config::set('mail.mailers.smtp.host', $settings['mail_host']);
            Config::set('mail.mailers.smtp.port', $settings['mail_port'] ?? 587);
            Config::set('mail.mailers.smtp.username', $settings['mail_username']);
            Config::set('mail.mailers.smtp.password', $settings['mail_password']);
            Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption'] ?? 'tls');
            Config::set('mail.from.address', $settings['mail_from_address'] ?? $settings['contact_email']);
            Config::set('mail.from.name', $settings['mail_from_name'] ?? config('app.name'));
            
            // Purge mailer to apply new config
            Mail::purge('smtp');
        }
        
        // Send email with dynamic sender
        $replyMail = new ReplyMessage($request->reply_message, $message);
        // We will configure the From address inside the Mailable itself 
        // to avoid conflicts with global config, or we can pass it to the constructor.
        $replyMail->customSenderEmail = $request->sender_email;
        
        Mail::to($message->email)->send($replyMail);

        // Mark as read if not already
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }
}

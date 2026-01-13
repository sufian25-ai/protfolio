<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Profile;
use App\Models\Article;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index() {
        $profile = Profile::first();
        $projects = Project::all();
        $testimonials = Testimonial::latest()->get();
        // Latest 3 articles for home page if needed later
        return view('home', compact('profile', 'projects', 'testimonials'));
    }

    public function blog() {
        $articles = Article::where('is_published', true)->latest()->paginate(9);
        return view('blog.index', compact('articles'));
    }

    public function showBlog($slug) {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $article->increment('views');
        return view('blog.show', compact('article'));
    }

    public function contact(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send Email
        // Use a default admin email if not configured, but ideally this comes from settings
        $adminEmail = 'sufian.mahbub@example.com'; 
        try {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactMessage($data));
            return redirect()->back()->with('success', 'Message sent successfully! I will get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
        }
    }

    public function sitemap() {
        $articles = Article::where('is_published', true)->orderBy('created_at', 'desc')->get();
        $projects = Project::all();

        return response()->view('sitemap', compact('articles', 'projects'))->header('Content-Type', 'text/xml');
    }
}

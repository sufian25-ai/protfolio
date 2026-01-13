<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $projectsCount = Project::count();
        $messagesCount = Message::where('is_admin', false)->count();
        $totalVisits = \App\Models\Visit::count();
        $uniqueVisitors = \App\Models\Visit::distinct('ip')->count('ip');
        return view('admin.dashboard', compact('messagesCount', 'projectsCount', 'totalVisits', 'uniqueVisitors'));
    }

    // Chat Interface
    public function chat()
    {
        // Get unique session IDs with latest message time and user info
        $sessions = Message::select('messages.session_id', 'chat_sessions.name')
            ->selectRaw('MAX(messages.created_at) as last_activity')
            ->leftJoin('chat_sessions', 'messages.session_id', '=', 'chat_sessions.session_id')
            ->groupBy('messages.session_id', 'chat_sessions.name')
            ->orderBy('last_activity', 'desc')
            ->get();
            
        return view('admin.chat.index', compact('sessions'));
    }

    // Projects List
    public function projects()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    // Create Project Form
    public function createProject()
    {
        return view('admin.projects.create');
    }

    // Store New Project
    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tech_stack' => 'nullable|string', // Comma separated input
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('assets/projects'), $imageName);
            $validated['image'] = 'assets/projects/' . $imageName;
        }

        // Convert comma separated tech stack to array
        if ($request->tech_stack) {
            $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
            $validated['tech_stack'] = [];
        }

        Project::create($validated);

        return redirect()->route('admin.projects')->with('success', 'Project created successfully!');
    }

    // Edit Project Form
    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        // Convert array back to comma separated string for form
        $techStackString = implode(', ', $project->tech_stack ?? []);
        return view('admin.projects.edit', compact('project', 'techStackString'));
    }

    // Update Project
    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tech_stack' => 'nullable|string',
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('assets/projects'), $imageName);
            $validated['image'] = 'assets/projects/' . $imageName;
            
            // Optional: Delete old image if it exists and isn't a seeding placeholder/url
            if (file_exists(public_path($project->image)) && !filter_var($project->image, FILTER_VALIDATE_URL)) {
               // unlink(public_path($project->image)); 
            }
        } else {
            unset($validated['image']); // Keep old image
        }

        if ($request->tech_stack) {
            $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
            $validated['tech_stack'] = [];
        }

        $project->update($validated);

        return redirect()->route('admin.projects')->with('success', 'Project updated successfully!');
    }

    // Delete Project
    public function deleteProject($id)
    {
        Project::destroy($id);
        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully!');
    }
    // Profile Management
    public function editProfile()
    {
        $profile = \App\Models\Profile::first();
        if (!$profile) {
            $profile = \App\Models\Profile::create([
                'name' => 'Name',
                'title' => 'Title',
                'description' => 'Description'
            ]);
        }
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = \App\Models\Profile::firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'experience_years' => 'nullable|string',
            'projects_completed' => 'nullable|string',
            'clients_satisfied' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cv' => 'nullable|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'_profile.'.$request->image->extension();  
            $request->image->move(public_path('assets'), $imageName);
            $validated['image'] = 'assets/' . $imageName;
        }

        if ($request->hasFile('cv')) {
            $cvName = 'cv_'.time().'.'.$request->cv->extension();
            $request->cv->move(public_path('assets/cv'), $cvName);
            $validated['cv_path'] = 'assets/cv/' . $cvName;
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }

    // Article Management
    public function articles()
    {
        $articles = \App\Models\Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        return view('admin.articles.create');
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . time();

        if ($request->hasFile('image')) {
            $imageName = time().'_article.'.$request->image->extension();  
            $request->image->move(public_path('assets/articles'), $imageName);
            $validated['image'] = 'assets/articles/' . $imageName;
        }

        \App\Models\Article::create($validated);

        return redirect()->route('admin.articles')->with('success', 'Article published successfully!');
    }

    public function editArticle($id)
    {
        $article = \App\Models\Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, $id)
    {
        $article = \App\Models\Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'_article.'.$request->image->extension();  
            $request->image->move(public_path('assets/articles'), $imageName);
            $validated['image'] = 'assets/articles/' . $imageName;
        }

        $article->update($validated);

        return redirect()->route('admin.articles')->with('success', 'Article updated successfully!');
    }

    public function deleteArticle($id)
    {
        \App\Models\Article::destroy($id);
        return redirect()->route('admin.articles')->with('success', 'Article deleted successfully!');
    }

    // Testimonial Management
    public function testimonials()
    {
        $testimonials = \App\Models\Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function createTestimonial()
    {
        return view('admin.testimonials.create');
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'_client.'.$request->image->extension();  
            $request->image->move(public_path('assets/testimonials'), $imageName);
            $validated['image'] = 'assets/testimonials/' . $imageName;
        }

        \App\Models\Testimonial::create($validated);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial added successfully!');
    }

    public function deleteTestimonial($id)
    {
        \App\Models\Testimonial::destroy($id);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully!');
    }
}

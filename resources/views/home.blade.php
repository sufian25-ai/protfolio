@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container hero-content">
            <div class="hero-text" data-aos="fade-up">
                <p class="hero-greeting" data-aos="fade-down">Hello, I'm</p>
                <h1 class="hero-name" data-aos="fade-right">{{ $profile->name ?? 'Sufian Mahbub' }}</h1>
                <h2 class="hero-title" data-aos="fade-left">{{ $profile->title ?? 'Full Stack Developer' }}</h2>
                <div class="typing-container">
                    <span class="typing-text"></span><span class="cursor">|</span>
                </div>
                <p class="bio-short">Building scalable, high-performance web applications with modern technologies. Passionate about clean code and exceptional user experiences.</p>
                <div class="hero-btns" data-aos="fade-up" data-aos-delay="200">
                    <a href="#contact" class="btn-primary">Connect with me</a>
                    @if(isset($profile) && $profile->cv_path)
                        <a href="{{ asset($profile->cv_path) }}" class="btn-secondary" download>Download CV <i class="fas fa-download"></i></a>
                    @else
                        <a href="#projects" class="btn-secondary">View My Work</a>
                    @endif
                </div>
                <!-- Social Links -->
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="mailto:contact@example.com"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="hero-visual" data-aos="fade-left">
                <!-- Abstract Code Visual -->
                <div class="code-window">
                    <div class="window-header">
                        <div class="dot red"></div>
                        <div class="dot yellow"></div>
                        <div class="dot green"></div>
                        <span class="file-name">developer.js</span>
                    </div>
                    <div class="code-content">
                        <div class="line"><span class="keyword">const</span> <span class="variable">developer</span> <span class="operator">=</span> {</div>
                        <div class="line indent"><span class="property">name</span>: <span class="string">'Sufian Mahbub'</span>,</div>
                        <div class="line indent"><span class="property">experience</span>: <span class="number">10</span>,</div>
                        <div class="line indent"><span class="property">skills</span>: [<span class="string">'Full Stack'</span>, <span class="string">'Web'</span>, <span class="string">'AI'</span>],</div>
                        <div class="line indent"><span class="function">code</span>: <span class="keyword">function</span>() {</div>
                        <div class="line double-indent"><span class="keyword">return</span> <span class="string">"Building the future..."</span>;</div>
                        <div class="line indent">}</div>
                        <div class="line">};</div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#about" class="scroll-down">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
        </a>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">About <span class="accent">Me</span></h2>
            <div class="about-content">
                <div class="about-image" data-aos="fade-right">
                    <div class="img-wrapper">
                        @if(filter_var($profile->image, FILTER_VALIDATE_URL))
                            <img src="{{ $profile->image }}" alt="{{ $profile->name }}">
                        @else
                            <img src="{{ asset($profile->image) }}" alt="{{ $profile->name }}">
                        @endif
                        <div class="img-backdrop"></div>
                    </div>
                </div>
                <div class="about-text" data-aos="fade-left">
                    <h3>{{ $profile->title }}</h3>
                    <p>{{ $profile->description }}</p>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <h4 class="counter" data-target="{{ $profile->experience_years }}">0</h4>
                            <p>Years Experience</p>
                        </div>
                        <div class="stat-item">
                            <h4 class="counter" data-target="{{ $profile->projects_completed }}">0</h4>
                            <p>Projects Completed</p>
                        </div>
                        <div class="stat-item">
                            <h4 class="counter" data-target="{{ $profile->clients_satisfied }}">0</h4>
                            <p>Happy Clients</p>
                        </div>
                    </div>

                    <a href="#" class="btn-primary mt-4">Download Resume <i class="fas fa-download"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">My <span class="accent">Skills</span></h2>
            <div class="skills-grid">
                <!-- Frontend -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                    <h3><i class="fas fa-laptop-code"></i> Frontend</h3>
                    <div class="skill-items">
                        <div class="skill-pill"><i class="fab fa-react"></i> React.js</div>
                        <div class="skill-pill"><i class="fab fa-vuejs"></i> Vue.js/Nuxt</div>
                        <div class="skill-pill"><i class="fab fa-js"></i> JavaScript/ES6+</div>
                        <div class="skill-pill"><i class="fab fa-html5"></i> HTML5/CSS3</div>
                        <div class="skill-pill"><i class="fab fa-css3-alt"></i> Tailwind/Sass</div>
                    </div>
                </div>

                <!-- Backend -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                    <h3><i class="fas fa-server"></i> Backend</h3>
                    <div class="skill-items">
                        <div class="skill-pill"><i class="fab fa-laravel"></i> Laravel/PHP</div>
                        <div class="skill-pill"><i class="fab fa-node-js"></i> Node.js</div>
                        <div class="skill-pill"><i class="fab fa-python"></i> Python/Django</div>
                        <div class="skill-pill"><i class="fas fa-database"></i> MySQL/PostgreSQL</div>
                        <div class="skill-pill"><i class="fas fa-leaf"></i> MongoDB</div>
                    </div>
                </div>

                <!-- Tools & DevOps -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                    <h3><i class="fas fa-tools"></i> Tools & DevOps</h3>
                    <div class="skill-items">
                        <div class="skill-pill"><i class="fab fa-git-alt"></i> Git/GitHub</div>
                        <div class="skill-pill"><i class="fab fa-docker"></i> Docker</div>
                        <div class="skill-pill"><i class="fab fa-aws"></i> AWS</div>
                        <div class="skill-pill"><i class="fas fa-terminal"></i> Linux CLI</div>
                        <div class="skill-pill"><i class="fas fa-fire"></i> Firebase</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Featured <span class="accent">Projects</span></h2>
            <p class="section-subtitle" data-aos="fade-up">Here are some of my recent works. Click to view details.</p>
            
            <div class="filter-container" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 40px; flex-wrap: wrap;">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="laravel">Laravel</button>
                <button class="filter-btn" data-filter="vue">Vue.js</button>
                <button class="filter-btn" data-filter="react">React</button>
                <button class="filter-btn" data-filter="fullstack">Full Stack</button>
            </div>
            
            <div class="projects-grid" id="projects-grid">
                @foreach($projects as $project)
                <div class="project-card" data-aos="fade-up" data-tech="{{ strtolower(implode(' ', $project->tech_stack ?? [])) }}">
                    <div class="project-img-container">
                        <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset($project->image) }}" alt="{{ $project->title }}" class="project-img">
                        <div class="project-overlay">
                            <a href="{{ $project->live_link ?? '#' }}" class="project-link" title="View Live"><i class="fas fa-external-link-alt"></i></a>
                            <a href="{{ $project->github_link ?? '#' }}" class="project-link" title="View Code"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-desc">{{ $project->description }}</p>
                        <div class="project-tech">
                            @foreach($project->tech_stack ?? [] as $tech)
                                <span class="tech-tag">#{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Experience Timeline -->
    <section id="experience" class="experience-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Work <span class="accent">Experience</span></h2>
            <div class="timeline">
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <span class="date">2021 - Present</span>
                        <h3>Senior Full Stack Developer</h3>
                        <h4>Tech Solutions Inc.</h4>
                        <p>Leading a team of 5 developers, architecting scalable web solutions, and implementing CI/CD pipelines.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="fade-left">
                    <div class="timeline-content">
                        <span class="date">2018 - 2021</span>
                        <h3>Full Stack Developer</h3>
                        <h4>Creative Digital Agency</h4>
                        <p>Developed 20+ custom websites for clients using Laravel and Vue.js. Optimized database performance.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <span class="date">2015 - 2018</span>
                        <h3>Junior Web Developer</h3>
                        <h4>StartUp Hub</h4>
                        <p>Collaborated on frontend development and maintained legacy PHP codebases.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Client Testimonials</h2>
            
            <div class="projects-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                @foreach($testimonials as $testimonial)
                <div class="project-card" data-aos="fade-up" style="padding: 30px; display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color);">
                        @else
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: #333; display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--primary-color);">{{ substr($testimonial->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <h3 style="font-size: 1.1rem; color: var(--text-primary); margin-bottom: 2px;">{{ $testimonial->name }}</h3>
                            <p style="font-size: 0.85rem; color: var(--text-secondary); margin: 0;">{{ $testimonial->role }}</p>
                        </div>
                    </div>
                    <div style="color: gold; font-size: 0.9rem;">
                        @for($i = 0; $i < $testimonial->rating; $i++) <i class="fas fa-star"></i> @endfor
                    </div>
                    <p style="color: var(--text-secondary); font-style: italic; font-size: 0.95rem; line-height: 1.6;">"{{ $testimonial->review }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Get In <span class="accent">Touch</span></h2>
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right">
                    <h3>Let's Talk About Your Project</h3>
                    <p>I'm available for freelance work and consulting. Send me a message and let's create something amazing together.</p>
                    
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <div class="details">
                            <span>Email</span>
                            <a href="mailto:contact@sufianmahbub.com">contact@sufianmahbub.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="details">
                            <span>Phone</span>
                            <a href="tel:+1234567890">+880 1XXX-XXXXXX</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="details">
                            <span>Location</span>
                            <p>Dhaka, Bangladesh</p>
                        </div>
                    </div>
                </div>

                <form class="contact-form" data-aos="fade-left" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message <i class="fas fa-paper-plane"></i></button>
                    <!-- Chat Trigger (Will implement overlay chat here later) -->
                </form>
            </div>
        </div>
    </section>
@endsection

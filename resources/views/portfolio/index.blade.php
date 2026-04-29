<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['hero_name'] ?? 'Portfolio' }} - {{ $settings['hero_title'] ?? 'Web Developer' }}</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
    @if(isset($settings['profile_picture']))
        <link rel="icon" type="image/png" href="{{ $settings['profile_picture'] }}">
    @endif
</head>
<body>
    <div class="bg-mesh"></div>

    <nav class="glass-nav">
        <div class="nav-container">
            <a href="#" class="logo">{{ $settings['hero_name'] ?? 'Portfolio' }}</a>
            
            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                <span class="hamburger"></span>
            </button>

            <div class="nav-links" id="navLinks">
                <button class="nav-close" id="navClose" aria-label="Close navigation">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#projects">Projects</a>
                <a href="#experience">Experience</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="hero-content">
            @if(isset($settings['profile_picture']))
                <div class="profile-pic-container mb-2">
                    <img src="{{ $settings['profile_picture'] }}" alt="{{ $settings['hero_name'] ?? 'Profile' }}" class="profile-pic">
                </div>
            @endif
            <h1 class="hero-title">
                <span class="gradient-text">{{ $settings['hero_name'] ?? 'Your Name' }}</span>
            </h1>
            <h2 class="hero-subtitle">{{ $settings['hero_title'] ?? 'Your Title' }}</h2>
            <p class="hero-desc">{{ $settings['about_subtitle'] ?? 'A short description about you.' }}</p>
            <div class="hero-actions">
                <a href="#projects" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    View Work
                </a>
                <a href="#contact" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    Contact Me
                </a>
            </div>
        </div>
        <div class="hero-3d-element">
            <div class="cube-container">
                <div class="cube">
                    @php
                        $faces = [
                            'front' => 'Cyber', 
                            'back' => 'Sec', 
                            'right' => 'Net', 
                            'left' => 'Work', 
                            'top' => 'Sys', 
                            'bottom' => 'Admin'
                        ];
                    @endphp
                    @foreach($faces as $class => $defaultText)
                        <div class="face {{ $class }}">
                            @if(isset($settings['cube_img_'.$class]))
                                <img src="{{ $settings['cube_img_'.$class] }}" alt="{{ $class }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                {{ $settings['cube_text_'.$class] ?? $defaultText }}
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <section id="about" class="section">
        <div class="section-header">
            <h2 class="section-title">About Me</h2>
            <div class="section-line"></div>
        </div>
        <div class="glass-card about-card">
            <p>{{ $settings['about_me'] ?? 'Full description goes here.' }}</p>
        </div>
    </section>

    <section id="skills" class="section">
        <div class="section-header">
            <h2 class="section-title">My Arsenal</h2>
            <div class="section-line"></div>
        </div>
        <div class="skills-grid">
            @foreach($skills as $skill)
            <div class="skill-tag hover-3d">
                <span class="skill-name">{{ $skill->name }}</span>
                <div class="skill-bar">
                    <div class="skill-progress" style="width: {{ $skill->proficiency }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section id="projects" class="section">
        <div class="section-header">
            <h2 class="section-title">Featured Projects</h2>
            <div class="section-line"></div>
        </div>
        <div class="projects-grid">
            @foreach($projects as $project)
            <div class="project-card card-3d">
                <div class="project-img-wrapper">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-img">
                </div>
                <div class="project-info">
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-desc">{{ $project->description }}</p>
                    <a href="{{ $project->url }}" class="project-link" target="_blank">View Project &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section id="experience" class="section">
        <div class="section-header">
            <h2 class="section-title">Experience & Certifications</h2>
            <div class="section-line"></div>
        </div>
        
        <div class="timeline-container">
            <div class="timeline-column">
                <h3 class="column-title">Experience</h3>
                @foreach($experiences as $exp)
                <div class="timeline-item glass-card hover-3d">
                    <div class="timeline-date">{{ $exp->start_date }} - {{ $exp->end_date }}</div>
                    <h4 class="timeline-role">{{ $exp->title }}</h4>
                    <div class="timeline-company">{{ $exp->company }}</div>
                    <p class="timeline-desc">{{ $exp->description }}</p>
                </div>
                @endforeach
            </div>

            <div class="timeline-column">
                <h3 class="column-title">Certifications</h3>
                @foreach($certifications as $cert)
                <div class="timeline-item glass-card hover-3d">
                    <h4 class="timeline-role">{{ $cert->name }}</h4>
                    <div class="timeline-company">{{ $cert->issuer }}</div>
                    <div class="timeline-date">{{ $cert->date }}</div>
                    @if($cert->certificate_file)
                        <div style="margin-top: 15px;">
                            <button onclick="openCertModal('{{ $cert->certificate_file }}')" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                View Certificate
                            </button>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="section contact-section">
        <div class="glass-card contact-card card-3d" style="width: 100%; max-width: 800px;">
            <h2 class="section-title text-center">Let's Connect</h2>
            <div class="section-line" style="margin: 0 auto 2rem;"></div>
            <p class="text-center mb-2">Interested in working together or have a question? Send me a message!</p>
            
            @if(session('success'))
                <div style="background: rgba(46, 204, 113, 0.2); border: 1px solid #2ecc71; color: #2ecc71; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" style="margin-bottom: 2rem;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Your Name</label>
                        <input type="text" name="name" required style="width: 100%; padding: 0.8rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: white; font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Your Email</label>
                        <input type="email" name="email" required style="width: 100%; padding: 0.8rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: white; font-family: inherit;">
                    </div>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Message</label>
                    <textarea name="message" required style="width: 100%; padding: 0.8rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: white; font-family: inherit; min-height: 150px; resize: vertical;"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem; font-size: 1.1rem; display: inline-flex; align-items: center; gap: 8px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        Send Message
                    </button>
                </div>
            </form>

            <div class="social-links text-center" style="border-top: 1px solid var(--glass-border); padding-top: 2rem; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;">
                @if(!empty($settings['contact_email']))
                <a href="mailto:{{ $settings['contact_email'] }}" class="btn btn-secondary" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    Mail
                </a>
                @endif

                @if(!empty($settings['facebook_url']))
                <a href="{{ $settings['facebook_url'] }}" class="btn btn-secondary" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    Facebook
                </a>
                @endif

                @if(!empty($settings['linkedin_url']))
                <a href="{{ $settings['linkedin_url'] }}" class="btn btn-secondary" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    LinkedIn
                </a>
                @endif

                @if(!empty($settings['github_url']))
                <a href="{{ $settings['github_url'] }}" class="btn btn-secondary" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                    GitHub
                </a>
                @endif

                @if(!empty($settings['twitter_url']))
                <a href="{{ $settings['twitter_url'] }}" class="btn btn-secondary" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    Twitter
                </a>
                @endif

                @if(!empty($settings['blog_url']))
                <a href="{{ $settings['blog_url'] }}" class="btn btn-secondary" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    Blog
                </a>
                @endif
            </div>
            <div class="text-center mt-2">
                <small>&copy; {{ date('Y') }} {{ $settings['hero_name'] ?? 'Portfolio' }}. All rights reserved.</small>
            </div>
        </div>
    </section>

    <script>
        // Add simple 3D interaction effect to cards
        const cards = document.querySelectorAll('.card-3d, .hover-3d');
        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -10;
                const rotateY = ((x - centerX) / centerX) * 10;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // Mobile Nav Toggle
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        const navClose = document.getElementById('navClose');
        const hamburger = document.querySelector('.hamburger');

        if (navToggle) {
            navToggle.addEventListener('click', () => {
                navLinks.classList.add('active');
                hamburger.classList.add('active');
            });
        }

        if (navClose) {
            navClose.addEventListener('click', () => {
                navLinks.classList.remove('active');
                hamburger.classList.remove('active');
            });
        }

        // Close menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });
        // Interactive 3D Cube
        const cube = document.querySelector('.cube');
        const cubeContainer = document.querySelector('.cube-container');
        let isDragging = false;
        let startX, startY;
        let rotateX = 0;
        let rotateY = 0;

        if (cubeContainer && cube) {
            cubeContainer.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.clientX;
                startY = e.clientY;
                cube.style.animation = 'none'; // Stop auto-rotation
                cubeContainer.style.cursor = 'grabbing';
            });

            window.addEventListener('mousemove', (e) => {
                if (!isDragging) return;

                const deltaX = e.clientX - startX;
                const deltaY = e.clientY - startY;

                rotateY += deltaX * 0.5;
                rotateX -= deltaY * 0.5;

                cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

                startX = e.clientX;
                startY = e.clientY;
            });

            window.addEventListener('mouseup', () => {
                if (isDragging) {
                    isDragging = false;
                    cubeContainer.style.cursor = 'pointer';
                    // Resume normal animation
                    cube.style.animation = 'rotate 20s infinite linear';
                    // Optional: Reset rotation values for next drag
                    rotateX = 0;
                    rotateY = 0;
                }
            });

            // Touch support
            cubeContainer.addEventListener('touchstart', (e) => {
                isDragging = true;
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                cube.style.animation = 'none';
            });

            window.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const deltaX = e.touches[0].clientX - startX;
                const deltaY = e.touches[0].clientY - startY;
                rotateY += deltaX * 0.5;
                rotateX -= deltaY * 0.5;
                cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            });

            window.addEventListener('touchend', () => {
                isDragging = false;
                cube.style.animation = 'rotate 20s infinite linear';
            });
        }
    </script>
    <!-- Certificate Viewer Modal -->
    <div id="certModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <div style="position: relative; max-width: 90%; max-height: 90%; text-align: center;">
            <button onclick="closeCertModal()" style="position: absolute; top: -40px; right: 0; background: none; border: none; color: white; font-size: 2rem; cursor: pointer;">&times;</button>
            <div class="cert-container" style="position: relative; display: inline-block;">
                <img id="certImage" src="" alt="Certificate" style="max-width: 100%; max-height: 80vh; border-radius: 8px; box-shadow: 0 0 20px rgba(255,255,255,0.2); pointer-events: none; user-select: none; -webkit-user-drag: none;" oncontextmenu="return false;" draggable="false">
                <div class="watermark-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10; pointer-events: none;"></div>
            </div>
        </div>
    </div>
    <script>
        function openCertModal(url) {
            document.getElementById('certImage').src = url;
            document.getElementById('certModal').style.display = 'flex';
        }
        function closeCertModal() {
            document.getElementById('certModal').style.display = 'none';
            document.getElementById('certImage').src = '';
        }
        
        // Prevent keyboard shortcuts for screenshot/printing (best effort)
        document.addEventListener('keyup', function (e) {
            if (e.key == 'PrintScreen') {
                if(navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText('Screenshots disabled.');
                }
            }
        });
        
        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === 'p' || e.key === 's')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

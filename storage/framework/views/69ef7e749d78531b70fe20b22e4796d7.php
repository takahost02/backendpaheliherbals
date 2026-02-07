<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About – Paheli Herbals | Modern Gradient UI</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- AOS LIBRARY -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<style>
 :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gold-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            --teal-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --green-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* FIXED: Title styling - PURE WHITE TEXT */
        .section-title {
            position: relative;
            display: inline-block;
            font-size: 3.5rem;
            font-weight: 800;
            color: #ffffff !important;
            text-shadow: 
                0 0 10px rgba(255, 255, 255, 0.3),
                0 0 20px rgba(59, 130, 246, 0.5),
                0 0 30px rgba(59, 130, 246, 0.3);
            letter-spacing: 0.5px;
            animation: titleGlow 3s ease-in-out infinite alternate;
            background: none !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        @keyframes titleGlow {
            0% { 
                text-shadow: 
                    0 0 10px rgba(255, 255, 255, 0.3),
                    0 0 20px rgba(59, 130, 246, 0.5),
                    0 0 30px rgba(59, 130, 246, 0.3);
            }
            100% { 
                text-shadow: 
                    0 0 15px rgba(255, 255, 255, 0.5),
                    0 0 30px rgba(59, 130, 246, 0.7),
                    0 0 45px rgba(59, 130, 246, 0.5);
            }
        }

        /* FIXED: Remove any gradient background from the text */
        .section-title span {
            color: #ffffff !important;
            -webkit-text-fill-color: #ffffff !important;
            background: none !important;
        }

        .section-subtitle {
            font-size: 1.25rem;
            line-height: 1.8;
            color: #e2e8f0;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            font-weight: 300;
        }

        .section-divider {
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
            margin: 2.5rem auto;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        .section-divider::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.9), transparent);
            animation: shine 2.5s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .empowerment-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .empowerment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .empowerment-card:hover::before {
            opacity: 1;
        }

        .empowerment-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 80px rgba(59, 130, 246, 0.2);
        }

        .icon-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .empowerment-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(360deg);
            border-color: transparent;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff !important;
            background: none !important;
            -webkit-background-clip: initial !important;
            background-clip: initial !important;
            -webkit-text-fill-color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .card-description {
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .pulse-dot {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #3b82f6;
            animation: pulse 2s infinite;
            box-shadow: 0 0 20px #3b82f6;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(3); opacity: 0; }
        }

        .glowing-text {
            text-shadow: 0 0 10px currentColor;
        }

        /* Particle animation */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #3b82f6;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.6;
        }

        /* Title icons animation */
        .title-icon {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2.2rem;
            }
            
            .section-subtitle {
                font-size: 1.1rem;
                padding: 0 1rem;
            }
            
            .icon-wrapper {
                width: 80px;
                height: 80px;
                font-size: 32px;
            }

/* Section Title */
.section-title {
    color: #1b1f24;
    font-size: 2.2rem;
}

/* Subtitle */
.section-subtitle {
    max-width: 680px;
    margin: auto;
    color: #555;
}

/* Gradient Separator */
.section-divider {
    width: 120px;
    height: 4px;
    margin: 20px auto;
    border-radius: 4px;
    background: linear-gradient(90deg, #75c4f0, #42919e);
}

/* ICON */
.aspect-icon {
    width: 75%;
    transition: .35s ease;
    filter: drop-shadow(0 0 6px rgba(117,196,240,0.4));
}

/* ICON HOVER GLOW */
.aspects:hover .aspect-icon {
    transform: scale(1.15);
    filter: drop-shadow(0 0 12px rgba(117,196,240,0.8));
}

/* Aspect Title */
.aspect-title {
    margin-top: 10px;
    font-size: 1.05rem;
    font-weight: 600;
}

/* Popup Info (full width) */
.inside-info {
    width: 100%;
    background: rgba(117,196,240,0.12);
    border-left: 4px solid #75c4f0;
    padding: 18px;
    border-radius: 12px;
    margin-top: 12px;
    display: none;
    animation: fadeIn .3s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(8px);}
    to {opacity: 1; transform: translateY(0);}
}

/* Hover behavior for desktops */
@media (min-width: 769px) {
    .aspects:hover .inside-info {
        display: block !important;
    }
}

/* Mobile accordion: tap to open */
@media (max-width: 768px) {
    .aspects {
        cursor: pointer;
    }
}
 </style>

</head>

<body>

<!-- AOS LIBRARY -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<section class="healthy-section py-5">
    <div class="container">

        <!-- HEADING -->
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paheli Herbals - Empowering Health, Wealth & Wellness</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gold-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            --teal-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --green-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .section-title {
            position: relative;
            display: inline-block;
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, 
                #ffffff 0%, 
                #dbeafe 25%, 
                #93c5fd 50%, 
                #60a5fa 75%, 
                #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            0% { text-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            100% { text-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 60px rgba(59, 130, 246, 0.4); }
        }

        .section-subtitle {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #e2e8f0;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .section-divider {
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            margin: 2rem auto;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
        }

        .section-divider::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            animation: shine 2s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .empowerment-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .empowerment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .empowerment-card:hover::before {
            opacity: 1;
        }

        .empowerment-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 80px rgba(59, 130, 246, 0.2);
        }

        .icon-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .empowerment-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(360deg);
            border-color: transparent;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #ffffff, #dbeafe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-description {
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .pulse-dot {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #3b82f6;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(3); opacity: 0; }
        }

        .glowing-text {
            text-shadow: 0 0 10px currentColor;
        }

        /* Particle animation */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #3b82f6;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.6;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
                padding: 0 1rem;
            }
            
            .icon-wrapper {
                width: 80px;
                height: 80px;
                font-size: 32px;
            }
        }
    </style>
</head>
<body class="antialiased min-h-screen overflow-x-hidden">

<!-- Animated Background Particles -->
<div id="particles-container" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>

<section class="py-20 px-4 relative">
    <!-- Floating decorative elements -->
    <div class="floating-element absolute top-20 left-10 opacity-20">
        <i class="fas fa-leaf text-6xl text-emerald-400"></i>
    </div>
    <div class="floating-element absolute bottom-20 right-10 opacity-20" style="animation-delay: 2s;">
        <i class="fas fa-heart text-6xl text-pink-400"></i>
    </div>

    <div class="container mx-auto max-w-6xl relative z-10">
        <!-- Main Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block relative mb-8">
                <!-- Decorative corner elements -->
                <div class="absolute -top-4 -left-4 w-8 h-8 border-t-2 border-l-2 border-blue-400"></div>
                <div class="absolute -top-4 -right-4 w-8 h-8 border-t-2 border-r-2 border-purple-400"></div>
                <div class="absolute -bottom-4 -left-4 w-8 h-8 border-b-2 border-l-2 border-cyan-400"></div>
                <div class="absolute -bottom-4 -right-4 w-8 h-8 border-b-2 border-r-2 border-indigo-400"></div>
                
                <h2 class="section-title text-white relative inline-block">
    <span class="relative inline-block px-10">
        <i class="fas fa-bolt absolute -left-10 top-1/2 -translate-y-1/2 text-yellow-400 text-3xl"></i>

        Empowering Health, Wealth & Wellness

        <i class="fas fa-bolt absolute -right-10 top-1/2 -translate-y-1/2 text-yellow-400 text-3xl"></i>
    </span>
</h2>

            </div>

            <div class="relative">
                <p class="section-subtitle mb-10">
                    Paheli Herbals empowers you to nurture holistic wellness through 
                    heart health, emotional balance, sleep recovery, and natural vitality.
                </p>
                
                <!-- Animated underline -->
                <div class="section-divider"></div>
            </div>

            <!-- Pulse dots -->
            <div class="pulse-dot top-1/2 left-1/4" style="animation-delay: 0s;"></div>
            <div class="pulse-dot top-1/2 left-1/2" style="animation-delay: 0.5s;"></div>
            <div class="pulse-dot top-1/2 left-3/4" style="animation-delay: 1s;"></div>
        </div>

        <!-- Four Pillars of Empowerment -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20" data-aos="fade-up" data-aos-delay="200">
            <!-- Health -->
            <div class="empowerment-card" style="--gradient: linear-gradient(90deg, #3b82f6, #8b5cf6);">
                <div class="icon-wrapper" style="--gradient: linear-gradient(135deg, #3b82f6, #8b5cf6); background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));">
                    <i class="fas fa-heart-pulse text-blue-400"></i>
                    <div class="absolute inset-0 rounded-full border-2 border-blue-400 opacity-20"></div>
                </div>
                <h3 class="card-title">Holistic Health</h3>
                <p class="card-description">
                    Nurture complete well-being with our natural formulations that support 
                    heart health, immunity, and overall physical vitality.
                </p>
                <div class="mt-6">
                    <span class="inline-flex items-center text-blue-300 text-sm">
                        <i class="fas fa-check-circle mr-2"></i>
                        Heart Care Solutions
                    </span>
                    <span class="inline-flex items-center text-blue-300 text-sm block mt-2">
                        <i class="fas fa-check-circle mr-2"></i>
                        Immune Support
                    </span>
                </div>
            </div>

            <!-- Wealth -->
            <div class="empowerment-card" style="--gradient: linear-gradient(90deg, #f59e0b, #fbbf24);">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(251, 191, 36, 0.2));">
                    <i class="fas fa-chart-line text-yellow-400"></i>
                    <div class="absolute inset-0 rounded-full border-2 border-yellow-400 opacity-20"></div>
                </div>
                <h3 class="card-title">Sustainable Wealth</h3>
                <p class="card-description">
                    Build financial freedom through our rewarding network marketing model 
                    that creates daily, monthly, and matching income opportunities.
                </p>
                <div class="mt-6">
                    <span class="inline-flex items-center text-yellow-300 text-sm">
                        <i class="fas fa-rupee-sign mr-2"></i>
                        Daily Income Streams
                    </span>
                    <span class="inline-flex items-center text-yellow-300 text-sm block mt-2">
                        <i class="fas fa-users mr-2"></i>
                        Team Building Rewards
                    </span>
                </div>
            </div>

            <!-- Wellness -->
            <div class="empowerment-card" style="--gradient: linear-gradient(90deg, #10b981, #34d399);">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(52, 211, 153, 0.2));">
                    <i class="fas fa-spa text-emerald-400"></i>
                    <div class="absolute inset-0 rounded-full border-2 border-emerald-400 opacity-20"></div>
                </div>
                <h3 class="card-title">Complete Wellness</h3>
                <p class="card-description">
                    Achieve emotional balance and mental clarity with our wellness 
                    solutions that promote stress relief, better sleep, and vitality.
                </p>
                <div class="mt-6">
                    <span class="inline-flex items-center text-emerald-300 text-sm">
                        <i class="fas fa-brain mr-2"></i>
                        Stress Management
                    </span>
                    <span class="inline-flex items-center text-emerald-300 text-sm block mt-2">
                        <i class="fas fa-bed mr-2"></i>
                        Sleep Recovery
                    </span>
                </div>
            </div>

            <!-- Natural -->
            <div class="empowerment-card" style="--gradient: linear-gradient(90deg, #8b5cf6, #ec4899);">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(236, 72, 153, 0.2));">
                    <i class="fas fa-leaf text-purple-400"></i>
                    <div class="absolute inset-0 rounded-full border-2 border-purple-400 opacity-20"></div>
                </div>
                <h3 class="card-title">Natural Vitality</h3>
                <p class="card-description">
                    Experience the power of 100% herbal formulations crafted from nature's 
                    finest ingredients for sustainable energy and natural healing.
                </p>
                <div class="mt-6">
                    <span class="inline-flex items-center text-purple-300 text-sm">
                        <i class="fas fa-seedling mr-2"></i>
                        100% Herbal
                    </span>
                    <span class="inline-flex items-center text-purple-300 text-sm block mt-2">
                        <i class="fas fa-recycle mr-2"></i>
                        Sustainable Solutions
                    </span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <div class="inline-flex flex-col md:flex-row gap-6 items-center">
                <a href="#" class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full font-bold text-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/30">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-rocket mr-3 group-hover:rotate-45 transition-transform"></i>
                        Start Your Wellness Journey
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="#" class="group px-8 py-4 border-2 border-blue-400 rounded-full font-bold text-lg hover:bg-blue-400/10 transition-all duration-300">
                    <span class="flex items-center">
                        <i class="fas fa-play-circle mr-3 text-blue-400"></i>
                        Watch Success Stories
                    </span>
                </a>
            </div>
            
            <p class="text-blue-300 mt-8 flex items-center justify-center">
                <i class="fas fa-star text-yellow-400 mr-2"></i>
                <span class="glowing-text">Join 10,000+ Successful Members Worldwide</span>
                <i class="fas fa-star text-yellow-400 ml-2"></i>
            </p>
        </div>
    </div>
</section>

<!-- Particle System Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create particles
        const particlesContainer = document.getElementById('particles-container');
        const particleCount = 50;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Random position
            const left = Math.random() * 100;
            const top = Math.random() * 100;
            const size = Math.random() * 3 + 1;
            const duration = Math.random() * 10 + 10;
            const delay = Math.random() * 5;
            
            particle.style.left = `${left}%`;
            particle.style.top = `${top}%`;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
            particle.style.opacity = Math.random() * 0.3 + 0.1;
            particle.style.background = `rgba(${Math.random() * 100 + 59}, ${Math.random() * 100 + 130}, 246, 0.5)`;
            
            particlesContainer.appendChild(particle);
        }

        // Add hover effect to cards
        const cards = document.querySelectorAll('.empowerment-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('a').forEach(button => {
            button.addEventListener('click', function(e) {
                const x = e.clientX - this.getBoundingClientRect().left;
                const y = e.clientY - this.getBoundingClientRect().top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>
</body>
</html>

        <div class="row">

            <!-- HEART -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="50">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/1.png" class="aspect-icon">
                    <p class="aspect-title">Heart</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Heart – Lifeline of Your Body</h6>
                    <p>A strong heart supports circulation, energy, and long-term balance.</p>
                </div>
            </div>

            <!-- ENERGY -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="100">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/2.png" class="aspect-icon">
                    <p class="aspect-title">Energy</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Energy – Powering Your Day</h6>
                    <p>Natural nutrition helps generate clean, sustainable daily energy.</p>
                </div>
            </div>

            <!-- STRESS -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="150">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/3.png" class="aspect-icon">
                    <p class="aspect-title">Stress</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Stress – The Silent Disruptor</h6>
                    <p>Managing stress improves mood, immunity, digestion & emotional calm.</p>
                </div>
            </div>

            <!-- WEIGHT -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="200">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/4.png" class="aspect-icon">
                    <p class="aspect-title">Weight</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Weight – Balance for Life</h6>
                    <p>Healthy weight supports metabolism, energy levels, and happiness.</p>
                </div>
            </div>

            <!-- SLEEP -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="250">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/5.png" class="aspect-icon">
                    <p class="aspect-title">Sleep</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Sleep – The Healing Solution</h6>
                    <p>Deep sleep restores immunity, hormones, and emotional recovery.</p>
                </div>
            </div>

            <!-- DIGESTION -->
            <div class="col-md-2 col-6 aspects" data-aos="fade-up" data-aos-delay="300">
                <div class="inside text-center">
                    <img src="https://paheliherbals.com/icon/6.png" class="aspect-icon">
                    <p class="aspect-title">Digestion</p>
                </div>
                <div class="inside-info">
                    <h6 class="fw-bold">Digestion – Root of Wellness</h6>
                    <p>Good digestion improves nutrient absorption, immunity & energy.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- AOS SCRIPT -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<!-- MOBILE ACCORDION JS -->
<script>
document.querySelectorAll(".aspects").forEach(item => {
    item.addEventListener("click", () => {

        // Close all others
        document.querySelectorAll(".inside-info").forEach(info => {
            if (info !== item.querySelector(".inside-info")) {
                info.style.display = "none";
            }
        });

        // Toggle current one
        const infoBox = item.querySelector(".inside-info");
        infoBox.style.display = infoBox.style.display === "block" ? "none" : "block";
    });
});
</script>







</body>
</html>
<?php /**PATH /home/paheliherbals/newplan.paheliherbals.com/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>
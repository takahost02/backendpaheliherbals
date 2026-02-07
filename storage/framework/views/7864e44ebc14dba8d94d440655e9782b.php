<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franchise Opportunity - Paheli Herbals</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* ============================================
           FRANCHISE SECTION ONLY - ISOLATED STYLES
           These styles ONLY affect the franchise section
        ============================================ */
        
        /* SECTION CONTAINER - ISOLATED */
        .franchise-section {
            --franchise-primary: #ff0080;
            --franchise-secondary: #ff6a00;
            --franchise-light: #fdf3ff;
            --franchise-dark: #e8f0ff;
            --franchise-card-bg: #ffffff;
            --franchise-text-dark: #333333;
            --franchise-text-light: #666666;
            --franchise-accent: #3a86ff;
            
            /* These styles only apply within .franchise-section */
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #75c4f0 0%, #42919e 100%) !important;

        }

        /* All child elements use the franchise variables */
        .franchise-section * {
            box-sizing: border-box;
        }

        /* Animated background elements - ISOLATED */
        .franchise-section .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 0, 128, 0.1) 0%, transparent 70%);
            animation: franchise-float 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes franchise-float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .franchise-section .shape-1 {
            width: 200px;
            height: 200px;
            top: -100px;
            right: -50px;
            animation-delay: 0s;
        }

        .franchise-section .shape-2 {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: -50px;
            animation-delay: 2s;
            background: radial-gradient(circle, rgba(255, 106, 0, 0.1) 0%, transparent 70%);
        }

        /* Title animation - ISOLATED */
        @keyframes franchise-titleGlow {
            0%, 100% { 
                text-shadow: 0 0 10px rgba(255, 0, 128, 0.3),
                             0 0 20px rgba(255, 0, 128, 0.2);
            }
            50% { 
                text-shadow: 0 0 20px rgba(255, 0, 128, 0.5),
                             0 0 40px rgba(255, 0, 128, 0.3),
                             0 0 60px rgba(255, 0, 128, 0.1);
            }
        }

        .franchise-section .title-gradient {
            background: linear-gradient(90deg, var(--franchise-primary) 0%, var(--franchise-secondary) 50%, var(--franchise-primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% auto;
            animation: franchise-gradientFlow 3s ease-in-out infinite;
            font-weight: 800;
        }

        @keyframes franchise-gradientFlow {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        /* Card styles - ISOLATED */
        .franchise-section .franchise-card {
            background: linear-gradient(145deg, var(--franchise-card-bg) 0%, #f8faff 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 
                0 10px 30px rgba(255, 0, 128, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .franchise-section .franchise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
            z-index: -1;
        }

        .franchise-section .franchise-card:hover::before {
            left: 100%;
        }

        .franchise-section .franchise-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 
                0 25px 50px rgba(255, 0, 128, 0.2),
                0 0 100px rgba(255, 106, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border-color: rgba(255, 0, 128, 0.2);
        }

        .franchise-section .card-icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 0, 128, 0.1), rgba(255, 106, 0, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--franchise-primary);
            position: relative;
            transition: all 0.3s ease;
        }

        .franchise-section .franchise-card:hover .card-icon-wrapper {
            transform: scale(1.1) rotate(360deg);
            background: linear-gradient(135deg, rgba(255, 0, 128, 0.2), rgba(255, 106, 0, 0.2));
            box-shadow: 0 0 30px rgba(255, 0, 128, 0.3);
        }

        .franchise-section .card-icon-wrapper::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--franchise-primary), var(--franchise-secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .franchise-section .franchise-card:hover .card-icon-wrapper::after {
            opacity: 0.3;
        }

        /* Badge styling - ISOLATED */
        .franchise-section .franchise-badge {
            background: linear-gradient(90deg, var(--franchise-primary), var(--franchise-secondary));
            color: white !important;
            padding: 8px 24px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(255, 0, 128, 0.3);
            position: relative;
            overflow: hidden;
        }

        .franchise-section .franchise-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: franchise-badgeShine 2s infinite;
        }

        @keyframes franchise-badgeShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* CTA Button - ISOLATED */
        .franchise-section .cta-button {
            background: linear-gradient(90deg, var(--franchise-primary), var(--franchise-secondary));
            position: relative;
            overflow: hidden;
            padding: 16px 48px;
            font-size: 20px;
            font-weight: 600;
            border-radius: 40px;
            color: white !important;
            box-shadow: 0 15px 30px rgba(255, 0, 128, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .franchise-section .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .franchise-section .cta-button:hover::before {
            left: 100%;
        }

        .franchise-section .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 20px 40px rgba(255, 0, 128, 0.4),
                0 0 60px rgba(255, 106, 0, 0.2);
        }

        /* Number counter - ISOLATED */
        .franchise-section .feature-count {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--franchise-primary), var(--franchise-secondary));
            color: white !important;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(255, 0, 128, 0.3);
            animation: franchise-countPulse 2s infinite;
        }

        @keyframes franchise-countPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Text colors - ISOLATED */
        .franchise-section h2,
        .franchise-section h3,
        .franchise-section h4 {
            color: var(--franchise-text-dark) !important;
        }

        .franchise-section p {
            color: var(--franchise-text-light) !important;
        }

        .franchise-section .text-pink-600 {
            color: var(--franchise-primary) !important;
        }

        .franchise-section .text-orange-600 {
            color: var(--franchise-secondary) !important;
        }

        .franchise-section .text-pink-500 {
            color: var(--franchise-primary) !important;
        }

        .franchise-section .border-pink-500 {
            border-color: var(--franchise-primary) !important;
        }

        .franchise-section .bg-pink-50 {
            background-color: rgba(255, 0, 128, 0.05) !important;
        }

        /* Custom particle animation - ISOLATED */
        @keyframes franchise-particleMove {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(100px, 100px) rotate(360deg); }
        }

        /* Responsive adjustments - ISOLATED */
        @media (max-width: 768px) {
            .franchise-section .title-gradient {
                font-size: 2rem !important;
            }
            
            .franchise-section .card-icon-wrapper {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            
            .franchise-section .cta-button {
                padding: 14px 32px;
                font-size: 18px;
            }
        }

        /* Reset any external Tailwind interference */
        .franchise-section .bg-gradient-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important;
        }
        
        .franchise-section .from-pink-600 {
            --tw-gradient-from: var(--franchise-primary) !important;
        }
        
        .franchise-section .to-orange-600 {
            --tw-gradient-to: var(--franchise-secondary) !important;
        }

        /* Ensure Tailwind colors don't override our franchise colors */
        .franchise-section * {
            --tw-text-opacity: 1;
        }
    </style>
</head>
<body class="antialiased">

<!-- FRANCHISE SECTION ONLY - Isolated Colors -->
<section class="franchise-section py-20 relative">
    <!-- Floating shapes - ISOLATED -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    
    <!-- Animated particles - ISOLATED -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="particle absolute w-2 h-2 bg-gradient-to-r from-pink-500 to-orange-500 rounded-full opacity-20" 
             style="top: 20%; left: 10%; animation: franchise-particleMove 15s infinite linear;"></div>
        <div class="particle absolute w-3 h-3 bg-gradient-to-r from-pink-500 to-orange-500 rounded-full opacity-20"
             style="top: 60%; left: 80%; animation: franchise-particleMove 20s infinite linear reverse;"></div>
        <div class="particle absolute w-1.5 h-1.5 bg-gradient-to-r from-pink-500 to-orange-500 rounded-full opacity-20"
             style="top: 80%; left: 30%; animation: franchise-particleMove 18s infinite linear;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Heading -->
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12 md:w-10/12">
                <div class="text-center mb-16">
                    <div class="inline-block mb-6">
                        <span class="franchise-badge inline-block mb-4">
                            <i class="fas fa-crown mr-2"></i>
                            FRANCHISE OPPORTUNITY
                            <i class="fas fa-crown ml-2"></i>
                        </span>
                    </div>

                    <h2 class="title-gradient text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        Start Your Own Business With a Brand That Grows With You
                    </h2>

                    <p class="text-xl leading-relaxed max-w-3xl mx-auto">
                        Join our fast-expanding network and become part of a powerful business ecosystem. 
                        We offer end-to-end support, proven business strategies, and industry-leading profitability 
                        to help you build a <span class="font-bold text-pink-600">successful and sustainable</span> business.
                    </p>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-6 mt-10">
                        <div class="text-center">
                            <div class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-orange-600 bg-clip-text text-transparent">500+</div>
                            <div class="text-gray-600">Franchises Nationwide</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-orange-600 bg-clip-text text-transparent">98%</div>
                            <div class="text-gray-600">Success Rate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-orange-600 bg-clip-text text-transparent">24/7</div>
                            <div class="text-gray-600">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Card 1 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">1</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">Low Investment</h4>
                <p class="text-center leading-relaxed">
                    Kickstart a profitable franchise with minimal setup cost & quick returns. 
                    <span class="block mt-2 text-pink-600 font-semibold">Starting from ₹50,000 only!</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock text-pink-500 mr-2"></i>
                        ROI in 6-12 months
                    </span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">2</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">High Profit Margin</h4>
                <p class="text-center leading-relaxed">
                    A proven business model that offers consistent, high-profit potential with 
                    <span class="font-semibold text-pink-600">up to 60% profit margins.</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-trophy text-pink-500 mr-2"></i>
                        Industry-best returns
                    </span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">3</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">Complete Training</h4>
                <p class="text-center leading-relaxed">
                    Hands-on training, marketing support, & operational guidance included. 
                    <span class="block mt-2">We train until you earn!</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-certificate text-pink-500 mr-2"></i>
                        Certified training program
                    </span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">4</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">Strong Brand Support</h4>
                <p class="text-center leading-relaxed">
                    Use our brand recognition, promotions, and nationwide customer base to 
                    <span class="font-semibold text-pink-600">accelerate your growth.</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-bullhorn text-pink-500 mr-2"></i>
                        Marketing campaigns included
                    </span>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">5</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-cogs"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">Easy Business Model</h4>
                <p class="text-center leading-relaxed">
                    Simple to operate — perfect for new entrepreneurs & professionals. 
                    <span class="block mt-2">No prior experience needed!</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-lightbulb text-pink-500 mr-2"></i>
                        Turnkey solution
                    </span>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="franchise-card rounded-3xl p-8">
                <div class="feature-count">6</div>
                <div class="card-icon-wrapper">
                    <i class="fas fa-headset"></i>
                </div>
                <h4 class="text-2xl font-bold text-center mb-4">Dedicated Support Team</h4>
                <p class="text-center leading-relaxed">
                    Our experts assist you from setup to daily operations & growth. 
                    <span class="block mt-2">Your success is our priority!</span>
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="inline-flex items-center text-sm text-gray-500">
                        <i class="fas fa-phone-alt text-pink-500 mr-2"></i>
                        Personal relationship manager
                    </span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center">
            <div class="bg-gradient-to-r from-white/80 to-white/60 backdrop-blur-sm rounded-3xl p-12 mb-10 border border-white/40 shadow-2xl">
                <h3 class="text-3xl font-bold mb-6">
                    Ready to Start Your Entrepreneurial Journey?
                </h3>
                <p class="text-xl mb-8 max-w-2xl mx-auto">
                    Join 500+ successful franchise owners who are building their legacy with Paheli Herbals.
                </p>
                
                <div class="flex flex-col md:flex-row gap-6 justify-center items-center">
                    <button class="cta-button group">
                        <span class="flex items-center">
                            <i class="fas fa-file-signature mr-3 group-hover:rotate-12 transition-transform"></i>
                            Apply Now
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                        </span>
                    </button>
                    
                    <a href="#" class="group inline-flex items-center px-8 py-4 border-2 border-pink-500 rounded-full text-pink-600 font-bold text-lg hover:bg-pink-50 transition-all duration-300">
                        <i class="fas fa-play-circle mr-3 text-pink-500 group-hover:scale-110 transition-transform"></i>
                        Watch Franchise Story
                    </a>
                </div>
                
                <div class="mt-8 flex flex-wrap justify-center gap-6">
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        No hidden charges
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        100% transparency
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Legal assistance included
                    </div>
                </div>
            </div>
            
            <!-- Trust badges -->
            <div class="flex flex-wrap justify-center gap-10 mt-12">
                <div class="text-center">
                    <div class="text-4xl mb-2 " style="color: var(--franchise-primary)">🏆</div>
                    <div class="font-semibold" style="color: black;">Award Winning</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-2" style="color: var(--franchise-primary)">⭐</div>
                    <div class="font-semibold" style="color: black;">5-Star Rated</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-2" style="color: var(--franchise-primary)">🔒</div>
                    <div class="font-semibold" style="color: black;">Secure Investment</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-2" style="color: var(--franchise-primary)">📈</div>
                    <div class="font-semibold" style="color: black;">Growing Network</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript for interactive elements - ISOLATED -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Only affect elements within franchise-section
        const franchiseSection = document.querySelector('.franchise-section');
        
        if (franchiseSection) {
            // Add hover effect to cards
            const cards = franchiseSection.querySelectorAll('.franchise-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-15px) scale(1.02)';
                    this.style.zIndex = '10';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.zIndex = '1';
                });
            });

            // Add click animation to CTA button
            const ctaButton = franchiseSection.querySelector('.cta-button');
            if (ctaButton) {
                ctaButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.5);
                        transform: scale(0);
                        animation: franchise-ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                    `;
                    
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => ripple.remove(), 600);
                    
                    // In real implementation, this would open a form
                    alert('Opening franchise application form...');
                });
            }

            // Add franchise-specific ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes franchise-ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 200);
                    }
                });
            }, observerOptions);

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        }
    });
</script>
</body>
</html><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/sections/transaction.blade.php ENDPATH**/ ?>
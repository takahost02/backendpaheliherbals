<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paheli Herbals - Leadership & Products</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom Styles */
        :root {
            --primary-blue: #0b3f75;
            --accent-blue: #3a7bd5;
            --light-blue: #00d2ff;
            --gold: #ffd700;
            --dark-bg: #0a192f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a192f 0%, #172a45 50%, #0a192f 100%);
            color: #fff;
            overflow-x: hidden;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--light-blue), var(--accent-blue));
            border-radius: 2px;
        }

        /* MD Section Styles */
        .md-section-wrapper {
            position: relative;
            overflow: hidden;
        }

        .md-section-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(58,123,213,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .md-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 
                0 20px 40px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.4s ease;
        }

        .md-card:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 30px 60px rgba(0,0,0,0.4),
                0 0 100px rgba(0,210,255,0.1),
                inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .md-photo-container {
            position: relative;
            width: 220px;
            height: 220px;
            margin: 0 auto;
        }

        .md-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid transparent;
            background: linear-gradient(45deg, var(--light-blue), var(--accent-blue), var(--gold)) border-box;
            padding: 4px;
            animation: photoGlow 3s ease-in-out infinite alternate;
        }

        @keyframes photoGlow {
            0% { box-shadow: 0 0 20px rgba(0,210,255,0.5); }
            100% { box-shadow: 0 0 40px rgba(0,210,255,0.8), 0 0 60px rgba(58,123,213,0.3); }
        }

        .md-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: linear-gradient(45deg, var(--gold), #ffed4e);
            color: #000;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
        }

        .quote-icon {
            font-size: 40px;
            color: var(--light-blue);
            opacity: 0.3;
            position: absolute;
            top: -20px;
            left: -10px;
        }

        .highlight-text {
            background: linear-gradient(90deg, var(--light-blue), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        /* How It Works Section */
        .work-section {
            position: relative;
            overflow: hidden;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: linear-gradient(45deg, rgba(0,210,255,0.1), rgba(58,123,213,0.1));
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 { width: 100px; height: 100px; top: 10%; left: 5%; animation-delay: 0s; }
        .shape-2 { width: 150px; height: 150px; bottom: 10%; right: 5%; animation-delay: 2s; }
        .shape-3 { width: 80px; height: 80px; top: 40%; right: 15%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .work-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .work-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s;
        }

        .work-card:hover::before {
            left: 100%;
        }

        .work-card:hover {
            transform: translateY(-10px);
            border-color: var(--light-blue);
            box-shadow: 
                0 20px 40px rgba(0,0,0,0.3),
                0 0 50px rgba(0,210,255,0.1);
        }

        .work-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--light-blue), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            box-shadow: 0 10px 30px rgba(0,210,255,0.3);
            transition: all 0.3s ease;
        }

        .work-card:hover .work-icon {
            transform: scale(1.1) rotate(360deg);
            box-shadow: 0 15px 40px rgba(0,210,255,0.5);
        }

        /* Products Marquee */
        .products-section {
            position: relative;
            padding: 60px 0;
            overflow: hidden;
        }

        .products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--light-blue), transparent);
        }

        .products-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-blue), transparent);
        }

        .product-title {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            background: linear-gradient(45deg, rgba(0,0,0,0.3), rgba(58,123,213,0.2));
            padding: 15px 40px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 40px;
            animation: titlePulse 2s infinite;
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .product-title i {
            color: var(--gold);
            font-size: 28px;
            animation: spinSlow 20s linear infinite;
        }

        @keyframes spinSlow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .marquee-container {
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        .marquee-track {
            display: flex;
            gap: 50px;
            animation: marqueeScroll 25s linear infinite;
            padding: 20px 0;
        }

        @keyframes marqueeScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .product-item {
            min-width: 200px;
            text-align: center;
            padding: 20px;
            background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.01));
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .product-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0,210,255,0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-10px);
            border-color: var(--light-blue);
            box-shadow: 
                0 20px 40px rgba(0,0,0,0.3),
                0 0 40px rgba(0,210,255,0.2);
        }

        .product-item:hover::before {
            opacity: 1;
        }

        .product-item img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
            transition: all 0.3s ease;
        }

        .product-item:hover img {
            transform: scale(1.15);
            filter: drop-shadow(0 15px 30px rgba(0,210,255,0.3));
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, var(--gold), #ffed4e);
            color: #000;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .md-photo-container {
                width: 180px;
                height: 180px;
            }
            
            .product-item {
                min-width: 150px;
            }
            
            .product-item img {
                width: 80px;
                height: 80px;
            }
            
            .marquee-track {
                gap: 30px;
            }
        }
    </style>
</head>
<body class="antialiased">

<!-- MD Speech Section -->
<section class="md-section-wrapper py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="section-title text-4xl md:text-5xl font-bold mb-4 text-white">
                Leadership <span class="highlight-text">Vision</span>
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Words that inspire from the helm of innovation
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="md-card rounded-3xl p-8 md:p-12">
                <div class="grid md:grid-cols-3 gap-8 items-center">
                    <!-- MD Photo -->
                    <div class="md:col-span-1">
                        <div class="md-photo-container">
                            <img src="https://paheliherbals.com/icon/md.jpg" 
                                 alt="Bappa Das - MD Paheli Herbals" 
                                 class="md-photo">
                            <div class="md-badge">
                                <i class="fas fa-award mr-1"></i> MD
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                Bappa Das
                            </h3>
                            <p class="text-gray-300 mt-2">Managing Director</p>
                            <p class="text-cyan-300 font-semibold">Paheli Herbals Pvt. Ltd.</p>
                            
                            <div class="flex justify-center space-x-4 mt-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Speech -->
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-quote-left quote-icon"></i>
                        
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-1 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full mr-4"></div>
                                <h3 class="text-2xl font-bold" style="color: orange;">A Message from Our Managing Director</h3>
                            </div>
                            
                            <div class="space-y-6">
                                <p class="text-lg leading-relaxed">
                                    <span class="text-cyan-300 font-semibold">"Never stop fighting</span> until you reach the place destiny has reserved for you — the place where the unique YOU finally shines. 
                                    Have a powerful aim in life. Keep learning, keep growing, keep pushing yourself forward. With relentless effort, 
                                    unshakable confidence, and perseverance that refuses to bend… <span class="text-yellow-300">you will create the extraordinary life you dream of."</span>
                                </p>
                                
                                <div class="p-4 bg-gradient-to-r from-blue-900/30 to-cyan-900/20 rounded-xl border-l-4 border-cyan-400">
                                    <p class="text-lg leading-relaxed">
                                        Network marketing is not just a business; it is the fastest-growing revolution of the 21st century. 
                                        Every young man and woman globally must join this movement — because if you do not use your youth to build your future, 
                                        you will never experience the true power of your potential.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center mt-8 pt-8 border-t border-gray-700">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 flex items-center justify-center mr-4">
                                <i class="fas fa-signature"></i>
                            </div>
                            <div>
                                <p class="font-semibold">Bappa Das</p>
                                <p class="text-sm text-gray-400">Inspiring Leaders Since 2015</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="work-section py-16 md:py-24">
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
   
    <div class="container mx-auto px-4">
        <div class="text-center mb-16"> 
            <span class="inline-block px-6 py-2 rounded-full bg-gradient-to-r from-cyan-500/20 to-blue-500/20 text-cyan-300 font-semibold mb-4">
                <i class="fas fa-cogs mr-2"></i>OUR PROCESS
            </span><br><br>
            <h2 class="section-title text-4xl md:text-5xl font-bold mb-4 text-white">
                How It <span class="highlight-text">Works</span>
            </h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                Simple steps to unlock your earning potential with Paheli Herbals
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Step 1 -->
            <div class="work-card">
                <div class="work-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">Register & Choose Plan</h3>
                    <p class="text-gray-300">
                        Sign up and select from our Basic, Premium, or Luxury packages to start your journey
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="work-card">
                <div class="work-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">Build Your Network</h3>
                    <p class="text-gray-300">
                        Grow your team and help others succeed while earning matching income
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="work-card">
                <div class="work-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">Earn & Grow Daily</h3>
                    <p class="text-gray-300">
                        Watch your income grow with daily earnings and monthly performance bonuses
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section">
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center">
            <div class="product-title">
                <i class="fas fa-box-open"></i>
                <span class="text-3xl font-bold bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">
                    Our Premium Products
                </span>
            </div>
            
            <p class="text-center text-gray-300 max-w-2xl mx-auto mb-12">
                Discover our range of herbal wellness products designed for modern living
            </p>
        </div>

        <div class="marquee-container">
            <div class="marquee-track">
                <!-- Product 1 -->
                <div class="product-item">
                    <div class="product-badge">Best Seller</div>
                    <img src="https://paheliherbals.com/icon/7.png" alt="Active Boost">
                    <h4 class="text-xl font-bold mt-4 text-white">Active Boost</h4>
                    <p class="text-gray-300 text-sm mt-2">Energy & Vitality</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-item">
                    <img src="https://paheliherbals.com/icon/8.png" alt="Go Gas Ultra">
                    <h4 class="text-xl font-bold mt-4 text-white">Go Gas Ultra</h4>
                    <p class="text-gray-300 text-sm mt-2">Digestive Health</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-item">
                    <div class="product-badge">New</div>
                    <img src="https://paheliherbals.com/icon/9.png" alt="Go Pain Relief">
                    <h4 class="text-xl font-bold mt-4 text-white">Go Pain Relief</h4>
                    <p class="text-gray-300 text-sm mt-2">Natural Pain Relief</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-item">
                    <img src="https://paheliherbals.com/icon/10.png" alt="Multi Vita">
                    <h4 class="text-xl font-bold mt-4 text-white">Multi Vita</h4>
                    <p class="text-gray-300 text-sm mt-2">Complete Nutrition</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="product-item">
                    <img src="https://paheliherbals.com/icon/11.png" alt="Tooth Powder">
                    <h4 class="text-xl font-bold mt-4 text-white">Tooth Powder</h4>
                    <p class="text-gray-300 text-sm mt-2">Oral Care</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>

                <!-- Duplicates for seamless loop -->
                <div class="product-item">
                    <div class="product-badge">Best Seller</div>
                    <img src="https://paheliherbals.com/icon/7.png" alt="Active Boost">
                    <h4 class="text-xl font-bold mt-4 text-white">Active Boost</h4>
                    <p class="text-gray-300 text-sm mt-2">Energy & Vitality</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                    </div>
                </div>

                <div class="product-item">
                    <img src="https://paheliherbals.com/icon/8.png" alt="Go Gas Ultra">
                    <h4 class="text-xl font-bold mt-4 text-white">Go Gas Ultra</h4>
                    <p class="text-gray-300 text-sm mt-2">Digestive Health</p>
                    <div class="mt-4">
                        <span class="inline-flex items-center text-cyan-300">
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star mr-1"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="https://paheliherbals.com/products" class="inline-flex items-center px-8 py-4 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-lg hover:scale-105 transition-transform shadow-lg hover:shadow-cyan-500/30">
                <i class="fas fa-shopping-cart mr-3"></i>
                View All Products
                <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    </div>
</section>

<!-- JavaScript for Interactive Elements -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.work-card, .product-item, .md-card').forEach(card => {
            observer.observe(card);
        });

        // Pause marquee on hover
        const marqueeTrack = document.querySelector('.marquee-track');
        const marqueeContainer = document.querySelector('.marquee-container');
        
        marqueeContainer.addEventListener('mouseenter', () => {
            marqueeTrack.style.animationPlayState = 'paused';
        });
        
        marqueeContainer.addEventListener('mouseleave', () => {
            marqueeTrack.style.animationPlayState = 'running';
        });

        // Add click effect to product items
        document.querySelectorAll('.product-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                // In real implementation, this would open product modal
                console.log('Product clicked:', this.querySelector('h4').textContent);
            });
        });
    });

    // Add CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
    `;
    document.head.appendChild(style);
</script>
</body>
</html><?php /**PATH /home/paheliherbals/test2.paheliherbals.com/core/resources/views/templates/basic/sections/how_it_works.blade.php ENDPATH**/ ?>
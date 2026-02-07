<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Responsive Pricing Plan Comparison</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        /* Custom Styles with Enhanced Visuals */
        :root {
            --basic-color: #345279;
            --premium-color: #9EC3DA;
            --luxury-color: #E6FFFF;
            --accent-gradient: linear-gradient(135deg, #75c4f0, #42919e);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden;
        }

        /* Enhanced Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset,
                0 30px 60px rgba(255, 255, 255, 0.1) inset;
        }

        /* Animated Background */
        .animated-bg {
            background: 
                radial-gradient(circle at 20% 80%, rgba(117, 196, 240, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(66, 145, 158, 0.3) 0%, transparent 50%),
                linear-gradient(135deg, #75c4f0 0%, #42919e 100%);
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        /* Pulse Animation */
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }

        .pulse-hover:hover {
            animation: pulse 2s infinite;
        }

        /* Swipe Indicator */
        .swipe-indicator {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .swipe-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .swipe-dot.active {
            background: white;
            transform: scale(1.2);
        }

        /* Mobile Swipe Container */
        .swipe-container {
            position: relative;
            overflow: hidden;
            -webkit-overflow-scrolling: touch;
        }

        /* Feature Icons Animation */
        .feature-icon {
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.2) rotate(10deg);
        }

        /* Enhanced Button */
        .gradient-btn {
            background: var(--accent-gradient);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .gradient-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .gradient-btn:hover::before {
            left: 100%;
        }

        .gradient-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(66, 145, 158, 0.4);
        }

        /* Shimmer Effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                transparent 0%,
                rgba(255, 255, 255, 0.1) 50%,
                transparent 100%
            );
            transform: rotate(30deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(30deg); }
            100% { transform: translateX(100%) rotate(30deg); }
        }

        /* Responsive Table */
        @media (max-width: 1024px) {
            .comparison-table {
                display: none;
            }
            .mobile-swiper {
                display: block;
            }
        }

        @media (min-width: 1025px) {
            .mobile-swiper {
                display: none;
            }
        }

        /* Package Cards */
        .package-card {
            border-radius: 20px;
            transition: all 0.4s ease;
        }

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Pricing Plan Section -->
<section class="animated-bg min-h-screen py-12 md:py-24 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-20 floating-element opacity-30">
        <i class="fas fa-star text-6xl text-white"></i>
    </div>
    <div class="absolute bottom-40 left-20 floating-element opacity-30" style="animation-delay: 2s;">
        <i class="fas fa-heart text-4xl text-white"></i>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 rounded-full glass-card text-white text-sm font-semibold tracking-wider mb-4">
                <i class="fas fa-rocket mr-2"></i>Choose Your Success Path
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Unlock Your 
                <span class="relative">
                    <span class="text-white">Potential</span>
                    <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white to-transparent"></span>
                </span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Select the perfect package for your journey and unlock powerful income opportunities with daily, monthly, and matching benefits.
            </p>
        </div>

        <!-- Mobile Swiper (Visible on Mobile/Tablet) -->
        <div class="mobile-swiper mb-12">
            <div class="swiper-container relative">
                <div class="swiper-wrapper">
                    <!-- Basic Package Card -->
                    <div class="swiper-slide">
                        <div class="package-card glass-card p-8 h-full" style="background: var(--basic-color);">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                                        <i class="fas fa-leaf text-2xl text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white mt-1">Basic Package</h3>
                                        <p class="text-3xl font-bold text-white mt-1">₹ 1,000</p>
                                    </div>
                                </div>
                                <span class="px-4 py-1 rounded-full bg-white/20 text-white text-sm">Entry Level</span>
                            </div>

                            <div class="space-y-4 mb-8">
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-boxes-stacked feature-icon text-white/80 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-white">Products Included</p>
                                        <p class="text-sm text-white/80">GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-link feature-icon text-white/80"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-white">Matching Income</p>
                                        <p class="text-xl font-bold text-white">₹ 750</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-sun feature-icon text-white/80"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-white">Daily Income</p>
                                        <p class="text-xl font-bold text-white">₹ 3,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-calendar-days feature-icon text-white/80"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-white">Monthly Income</p>
                                        <p class="text-xl font-bold text-white">₹ 90,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-user-check feature-icon text-white/80 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-white">Ideal For</p>
                                        <p class="text-sm text-white/80">New starters beginning their journey</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="gradient-btn w-full py-4 rounded-xl text-white font-bold text-lg text-center block pulse-hover">
                                <i class="fas fa-bolt mr-2"></i>Join Now
                            </a>
                        </div>
                    </div>

                    <!-- Premium Package Card -->
                    <div class="swiper-slide">
                        <div class="package-card glass-card p-8 h-full" style="background: var(--premium-color);">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-white/40 flex items-center justify-center">
                                        <i class="fas fa-gem text-2xl text-gray-800"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800">Premium Package</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">₹ 2,000</p>
                                    </div>
                                </div>
                                <span class="px-4 py-1 rounded-full bg-white/40 text-gray-800 text-sm font-semibold">Most Popular</span>
                            </div>

                            <div class="space-y-4 mb-8">
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-boxes-stacked feature-icon text-gray-700 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800">Products Included</p>
                                        <p class="text-sm text-gray-700">GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-link feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Matching Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 1,500</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-sun feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Daily Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 6,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-calendar-days feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Monthly Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 1,80,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-user-check feature-icon text-gray-700 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800">Ideal For</p>
                                        <p class="text-sm text-gray-700">Fast-growing team builders</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="gradient-btn w-full py-4 rounded-xl text-white font-bold text-lg text-center block pulse-hover">
                                <i class="fas fa-bolt mr-2"></i>Join Now
                            </a>
                        </div>
                    </div>

                    <!-- Luxury Package Card -->
                    <div class="swiper-slide">
                        <div class="package-card glass-card p-8 h-full shimmer" style="background: var(--luxury-color);">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-white/60 flex items-center justify-center">
                                        <i class="fas fa-crown text-2xl text-gray-800"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800">Luxury Package</h3>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">₹ 3,000</p>
                                    </div>
                                </div>
                                <span class="px-4 py-1 rounded-full bg-white/60 text-gray-800 text-sm font-semibold">Premium Elite</span>
                            </div>

                            <div class="space-y-4 mb-8">
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-boxes-stacked feature-icon text-gray-700 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800">Products Included</p>
                                        <p class="text-sm text-gray-700">GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-link feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Matching Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 2,250</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-sun feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Daily Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 9,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-center space-x-3">
                                    <i class="fas fa-calendar-days feature-icon text-gray-700"></i>
                                    <div class="flex-1 flex justify-between items-center">
                                        <p class="font-semibold text-gray-800">Monthly Income</p>
                                        <p class="text-xl font-bold text-gray-800">₹ 2,70,000</p>
                                    </div>
                                </div>
                                <div class="feature-item flex items-start space-x-3">
                                    <i class="fas fa-user-check feature-icon text-gray-700 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800">Ideal For</p>
                                        <p class="text-sm text-gray-700">Business leaders & serious earners</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="gradient-btn w-full py-4 rounded-xl text-white font-bold text-lg text-center block pulse-hover">
                                <i class="fas fa-bolt mr-2"></i>Join Now
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Swipe Indicator -->
                <div class="swipe-indicator">
                    <div class="swipe-dot active" data-index="0"></div>
                    <div class="swipe-dot" data-index="1"></div>
                    <div class="swipe-dot" data-index="2"></div>
                </div>
            </div>
        </div>

        <!-- Desktop Comparison Table (Visible on Desktop) -->
        <div class="comparison-table glass-card rounded-3xl overflow-hidden">
            <div class="overflow-x-auto swipe-container">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="p-8 text-left bg-white/10 backdrop-blur-sm">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-star text-cyan-400 text-xl"></i>
                                    <span class="text-xl font-bold text-white">Key Benefits</span>
                                </div>
                            </th>
                            <th class="p-8 text-center" style="background: var(--basic-color);">
                                <div class="text-white">
                                    <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-leaf text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mt-1">Basic Package</h3>
                                    <p class="text-3xl font-bold">₹ 1,000</p>
                                </div>
                            </th>
                            <th class="p-8 text-center" style="background: var(--premium-color);">
                                <div class="text-gray-800">
                                    <div class="w-20 h-20 rounded-2xl bg-white/40 flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-gem text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">Premium Package</h3>
                                    <p class="text-3xl font-bold">₹ 2,000</p>
                                    <span class="inline-block mt-2 px-4 py-1 rounded-full bg-white/40 text-sm font-semibold">Popular</span>
                                </div>
                            </th>
                            <th class="p-8 text-center" style="background: var(--luxury-color);">
                                <div class="text-gray-800">
                                    <div class="w-20 h-20 rounded-2xl bg-white/60 flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-crown text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">Luxury Package</h3>
                                    <p class="text-3xl font-bold">₹ 3,000</p>
                                    <span class="inline-block mt-2 px-4 py-1 rounded-full bg-white/60 text-sm font-semibold">Premium</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Products Row -->
                        <tr class="border-b border-white/10">
                            <td class="p-6 bg-white/5">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-boxes-stacked text-cyan-400 text-xl"></i>
                                    <span class="font-semibold text-white">Products Included</span>
                                </div>
                            </td>
                            <td class="p-6 text-center text-white" style="background: var(--basic-color);">
                                GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--premium-color);">
                                GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--luxury-color);">
                                GO-GAS ULTRA, ACTIVE BOOST, MULTIVITA, GO PAIN RELIEF, TOOTH POWDER
                            </td>
                        </tr>
                        
                        <!-- Matching Income Row -->
                        <tr class="border-b border-white/10">
                            <td class="p-6 bg-white/5">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-link text-cyan-400 text-xl"></i>
                                    <span class="font-semibold text-white">Matching Income</span>
                                </div>
                            </td>
                            <td class="p-6 text-center text-white" style="background: var(--basic-color);">
                                <span class="text-2xl font-bold">₹ 750</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--premium-color);">
                                <span class="text-2xl font-bold">₹ 1,500</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--luxury-color);">
                                <span class="text-2xl font-bold">₹ 2,250</span>
                            </td>
                        </tr>
                        
                        <!-- Daily Income Row -->
                        <tr class="border-b border-white/10">
                            <td class="p-6 bg-white/5">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-sun text-cyan-400 text-xl"></i>
                                    <span class="font-semibold text-white">Daily Income</span>
                                </div>
                            </td>
                            <td class="p-6 text-center text-white" style="background: var(--basic-color);">
                                <span class="text-2xl font-bold">₹ 3,000</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--premium-color);">
                                <span class="text-2xl font-bold">₹ 6,000</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--luxury-color);">
                                <span class="text-2xl font-bold">₹ 9,000</span>
                            </td>
                        </tr>
                        
                        <!-- Monthly Income Row -->
                        <tr class="border-b border-white/10">
                            <td class="p-6 bg-white/5">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-calendar-days text-cyan-400 text-xl"></i>
                                    <span class="font-semibold text-white">Monthly Income</span>
                                </div>
                            </td>
                            <td class="p-6 text-center text-white" style="background: var(--basic-color);">
                                <span class="text-2xl font-bold">₹ 90,000</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--premium-color);">
                                <span class="text-2xl font-bold">₹ 1,80,000</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--luxury-color);">
                                <span class="text-2xl font-bold">₹ 2,70,000</span>
                            </td>
                        </tr>
                        
                        <!-- Ideal For Row -->
                        <tr>
                            <td class="p-6 bg-white/5">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-user-check text-cyan-400 text-xl"></i>
                                    <span class="font-semibold text-white">Ideal For</span>
                                </div>
                            </td>
                            <td class="p-6 text-center text-white" style="background: var(--basic-color);">
                                <span class="font-semibold">New starters</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--premium-color);">
                                <span class="font-semibold">Fast-growing builders</span>
                            </td>
                            <td class="p-6 text-center text-gray-800" style="background: var(--luxury-color);">
                                <span class="font-semibold">Business leaders</span>
                            </td>
                        </tr>
                        
                        <!-- Action Row -->
                        <tr>
                            <td class="p-6 bg-white/5"></td>
                            <td class="p-6 text-center" style="background: var(--basic-color);">
                                <a href="https://paheliherbals.com/user/login" class="gradient-btn inline-block px-8 py-4 rounded-xl text-white font-bold text-lg">
                                    Join Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </td>
                            <td class="p-6 text-center" style="background: var(--premium-color);">
                                <a href="https://paheliherbals.com/user/login" class="gradient-btn inline-block px-8 py-4 rounded-xl text-white font-bold text-lg">
                                    Join Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </td>
                            <td class="p-6 text-center" style="background: var(--luxury-color);">
                                <a href="https://paheliherbals.com/user/login" class="gradient-btn inline-block px-8 py-4 rounded-xl text-white font-bold text-lg">
                                    Join Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Information Note -->
        <div class="mt-12 glass-card rounded-2xl p-6 max-w-3xl mx-auto">
            <div class="flex items-start space-x-4">
                <i class="fas fa-info-circle text-2xl text-cyan-400 mt-1"></i>
                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Important Information</h4>
                    <p class="text-white/90">
                        Income values shown are potential earnings based on team performance. Actual results may vary.
                        All packages include comprehensive training and support to maximize your success.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper for mobile
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Swiper
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swipe-indicator',
                clickable: true,
                bulletClass: 'swipe-dot',
                bulletActiveClass: 'active',
                renderBullet: function (index, className) {
                    return '<span class="' + className + '" data-index="' + index + '"></span>';
                }
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.2,
                    centeredSlides: true,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 25,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });

        // Update indicator dots
        swiper.on('slideChange', function () {
            document.querySelectorAll('.swipe-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === swiper.realIndex);
            });
        });

        // Touch swipe for desktop table
        const tableContainer = document.querySelector('.swipe-container');
        let startX = 0;
        let scrollLeft = 0;
        let isDown = false;

        tableContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - tableContainer.offsetLeft;
            scrollLeft = tableContainer.scrollLeft;
        });

        tableContainer.addEventListener('mouseleave', () => {
            isDown = false;
        });

        tableContainer.addEventListener('mouseup', () => {
            isDown = false;
        });

        tableContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - tableContainer.offsetLeft;
            const walk = (x - startX) * 2;
            tableContainer.scrollLeft = scrollLeft - walk;
        });

        // Touch events for mobile
        tableContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].pageX - tableContainer.offsetLeft;
            scrollLeft = tableContainer.scrollLeft;
        });

        tableContainer.addEventListener('touchmove', (e) => {
            const x = e.touches[0].pageX - tableContainer.offsetLeft;
            const walk = (x - startX) * 2;
            tableContainer.scrollLeft = scrollLeft - walk;
        });

        // Add hover effects
        document.querySelectorAll('.package-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click animation to buttons
        document.querySelectorAll('.gradient-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                // In real implementation, this would redirect to purchase page
                alert('Redirecting to package selection...');
            });
        });
    });

    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        const swiper = document.querySelector('.swiper-container').swiper;
        if (!swiper) return;
        
        if (e.key === 'ArrowLeft') {
            swiper.slidePrev();
        } else if (e.key === 'ArrowRight') {
            swiper.slideNext();
        }
    });
</script>
</body>
</html>
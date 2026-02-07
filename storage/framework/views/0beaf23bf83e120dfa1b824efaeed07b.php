<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern About Section - Paheli Herbals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #ff9800;
            --accent: #ff5722;
            --text: #333;
            --text-light: #666;
            --background: #f9f9f9;
            --white: #ffffff;
            --light-bg: #f0f7f0;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.7;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.4s ease;
            text-decoration: none;
            box-shadow: var(--shadow);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .section-header .subtitle {
            display: inline-block;
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .section-header .title {
            font-size: 2.8rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .section-header .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .about-section {
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f9f9f9 0%, #f0f7f0 100%);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
            align-items: center;
        }

        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        .about-content {
            padding-right: 30px;
        }

        .about-content p {
            margin-bottom: 25px;
            font-size: 1.1rem;
            color: var(--text-light);
        }

        .about-content strong {
            color: var(--primary-dark);
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin: 40px 0;
        }

        .feature-card {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.03), rgba(255, 152, 0, 0.03));
            z-index: 0;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-left-color: var(--secondary);
        }

        .feature-card strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: var(--primary-dark);
            position: relative;
            z-index: 1;
        }

        .feature-card span {
            font-size: 0.95rem;
            color: var(--text-light);
            position: relative;
            z-index: 1;
        }

        .about-thumb {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-hover);
            transform: perspective(1000px) rotateY(-5deg);
            transition: all 0.5s ease;
        }

        .about-thumb:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .about-thumb img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .about-thumb:hover img {
            transform: scale(1.05);
        }

        .about-thumb::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.2), rgba(255, 152, 0, 0.1));
            z-index: 1;
        }

        .shape {
            position: absolute;
            z-index: 0;
            opacity: 0.1;
        }

        .shape1 {
            top: 10%;
            left: 5%;
            width: 150px;
            animation: float 6s ease-in-out infinite;
        }

        .shape2 {
            bottom: 10%;
            right: 5%;
            width: 200px;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .col-lg-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .about-content {
                padding-right: 0;
                margin-bottom: 50px;
            }
            
            .about-thumb {
                transform: none;
            }
            
            .section-header .title {
                font-size: 2.3rem;
            }
        }

        @media (max-width: 768px) {
            .about-features {
                grid-template-columns: 1fr;
            }
            
            .section-header .title {
                font-size: 2rem;
            }
            
            .about-section {
                padding: 70px 0;
            }
        }

        @media (max-width: 576px) {
            .section-header .title {
                font-size: 1.8rem;
            }
            
            .feature-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="about-section">
        <div class="container">
            <div class="section-header">
                <span class="subtitle">Our Mission & Vision</span>
                <h2 class="title">Empowering Health, Wealth & Wellness</h2>
            </div>
            
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-6">
                    <div class="about-content">
                        <p>
                            At <strong>Paheli Herbals Marketing Pvt. Ltd.</strong>, our mission is to inspire healthier
                            lifestyles, financial independence, and entrepreneurial success through the science of
                            authentic herbal wellness. We combine ancient Ayurvedic wisdom with modern quality standards
                            to create products that transform lives—physically, mentally, and financially.
                        </p>

                        <p>
                            Over the years, Paheli Herbals has grown into a trusted national brand, known for its premium
                            herbal solutions and a business model that enables individuals across India to build
                            sustainable income and long-term security. We believe in empowering people—not just with
                            products, but with confidence, skills, and opportunities.
                        </p>

                        <!-- Feature List -->
                        <div class="about-features">
                            <div class="feature-card">
                                <strong>Authentic Ayurveda</strong>
                                <span>Traditional formulations enhanced with modern standards.</span>
                            </div>
                            
                            <div class="feature-card">
                                <strong>Financial Empowerment</strong>
                                <span>Multiple income streams for partners and entrepreneurs.</span>
                            </div>
                            
                            <div class="feature-card">
                                <strong>Quality Assurance</strong>
                                <span>Rigorous testing and multi-layered quality control.</span>
                            </div>
                            
                            <div class="feature-card">
                                <strong>Nationwide Network</strong>
                                <span>Empowering individuals across India with health & opportunity.</span>
                            </div>
                        </div>

                        <a href="about-us.html" class="btn">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6">
                    <div class="about-thumb">
                        <img src="https://images.unsplash.com/photo-1585435557343-3b092031d5ad?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Paheli Herbals Team">
                    </div>
                </div>
            </div>
        </div>

        <!-- Shapes -->
        <div class="shape shape1">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%232e7d32' d='M50,10 A40,40 0 1,1 50,90 A40,40 0 1,1 50,10 Z'/%3E%3C/svg%3E" alt="shape">
        </div>

        <div class="shape shape2">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23ff9800'/%3E%3C/svg%3E" alt="shape">
        </div>
    </section>

    <script>
        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            const featureCards = document.querySelectorAll('.feature-card');
            
            featureCards.forEach((card, index) => {
                // Add staggered animation
                card.style.animationDelay = `${index * 0.1}s`;
                
                // Add click effect
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
            
            // Parallax effect for shapes
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const shapes = document.querySelectorAll('.shape');
                
                shapes.forEach(shape => {
                    const speed = shape.classList.contains('shape1') ? 0.5 : 0.3;
                    shape.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });
        });
    </script>
</body>
</html><?php /**PATH /home/paheliherbals/public_html/Back/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>
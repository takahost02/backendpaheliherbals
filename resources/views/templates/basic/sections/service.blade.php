<style>/* Title */
.income-title {
    font-size: 40px;
    font-weight: 700;
    background: linear-gradient(45deg, #75c4f0, #42919e);
    -webkit-background-clip: text;
    color: transparent;
}

.income-subtext {
    font-size: 17px;
    opacity: 0.8;
}

.title-divider {
    width: 120px;
    height: 4px;
    margin: 20px auto;
    background: linear-gradient(90deg, #75c4f0, #42919e);
    border-radius: 10px;
}

/* CARD */
.income-card {
    background: #fff;
    border-radius: 22px;
    overflow: hidden;
    text-align: center;
    transition: 0.35s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    position: relative;
    border: 1px solid rgba(255,255,255,0.1);
}

.income-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.2);
}

/* CTA IMAGE */
.income-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* ICON */
.income-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #75c4f0, #42919e);
    box-shadow: 0 10px 20px rgba(117,196,240,0.4);
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 32px;
    margin: -40px auto 15px;
    transition: 0.3s ease;
}

.income-card:hover .income-icon {
    transform: scale(1.15);
}

/* Text */
.income-card-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
}

.income-card-text {
    font-size: 15px;
    opacity: 0.85;
    padding: 0 10px 20px;
}
</style>
<!-- AOS Library -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<section class="income-section-modern py-5">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="income-title">
                Income Opportunities
            </h2>
            <p class="income-subtext">
                Unlock multiple earning channels and grow your financial future.
            </p>
            <div class="title-divider"></div>
        </div>

        <!-- GRID -->
        <div class="row g-4 justify-content-center">

            <!-- CARD TEMPLATE -->
            <!-- 1 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h4 class="income-card-title">Master Binary Matching Income</h4>
                    <p class="income-card-text">Earn through our binary compensation plan with unlimited potential.</p>
                </div>
            </div>

            <!-- 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h4 class="income-card-title">Level Income</h4>
                    <p class="income-card-text">Earn rewards by building a powerful network across multiple levels.</p>
                </div>
            </div>

            <!-- 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="150">
                    <img src="https://images.unsplash.com/photo-1559526324-593bc073d938?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h4 class="income-card-title">Reward Income</h4>
                    <p class="income-card-text">Receive exclusive bonuses and milestone rewards.</p>
                </div>
            </div>

            <!-- 4 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4 class="income-card-title">Rank Achievement Income</h4>
                    <p class="income-card-text">Climb ranks and unlock higher earning opportunities.</p>
                </div>
            </div>

            <!-- 5 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="250">
                    <img src="https://images.unsplash.com/photo-1554224154-22dec7ec8818?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <h4 class="income-card-title">Salary Income</h4>
                    <p class="income-card-text">Earn consistent monthly income based on performance.</p>
                </div>
            </div>

            <!-- 6 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1521790361543-f645cf042ec4?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <h4 class="income-card-title">Franchise Bonus Income</h4>
                    <p class="income-card-text">Grow through franchises and earn additional bonuses.</p>
                </div>
            </div>

            <!-- 7 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
    <div class="income-card" data-aos="zoom-in" data-aos-delay="350">

        <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?auto=format&fit=crop&w=900&q=80" 
             class="income-img">

        <div class="income-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>

        <h4 class="income-card-title">Retail Profit</h4>
        <p class="income-card-text">Earn profit margins by selling our high-quality products.</p>
    </div>
</div>


            <!-- 8 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="income-card" data-aos="zoom-in" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80" class="income-img">
                    <div class="income-icon">
                        <i class="fas fa-redo"></i>
                    </div>
                    <h4 class="income-card-title">Repurchase Bonus</h4>
                    <p class="income-card-text">Earn bonuses whenever your team makes repeat purchases.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- AOS Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>


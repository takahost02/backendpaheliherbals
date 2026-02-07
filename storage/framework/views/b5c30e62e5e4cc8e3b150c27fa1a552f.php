

<?php
    $loginContent = getContent('login.content', true);
?>

<?php $__env->startSection('panel'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
        background: linear-gradient(135deg, #1d3557 0%, #457b9d 50%, #a8dadc 100%);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .login-wrapper::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(-20px, -20px) rotate(360deg); }
    }

    .login-card {
        width: 100%;
        max-width: 440px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 40px 35px;
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 35px 60px -12px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .login-card .logo {
        text-align: center;
        margin-bottom: 10px;
    }

    .login-card .logo img {
        width: 180px;
        height: auto;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .login-card .logo img:hover {
        transform: scale(1.05);
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #fff 0%, #a8dadc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .login-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        font-weight: 400;
    }

    .form--group {
        margin-bottom: 24px;
        position: relative;
    }

    .form--label {
        font-weight: 500;
        color: #fff;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        height: 52px;
        padding: 0 16px;
        border-radius: 12px;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        transition: all 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-control:focus {
        outline: none;
        border-color: #a8dadc;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(168, 218, 220, 0.2);
        transform: translateY(-1px);
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        padding: 4px;
    }

    .password-toggle:hover {
        color: #fff;
    }

    .remember-group {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .remember-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.1);
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .remember-checkbox.checked {
        background: #e63946;
        border-color: #e63946;
    }

    .remember-checkbox.checked::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 12px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .remember-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        cursor: pointer;
    }

    .account--btn {
        width: 100%;
        background: linear-gradient(135deg, #e63946 0%, #d62828 100%);
        padding: 15px 24px;
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .account--btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .account--btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(230, 57, 70, 0.4);
    }

    .account--btn:hover::before {
        left: 100%;
    }

    .account--btn:active {
        transform: translateY(0);
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin: 24px 0;
    }

    .action-btn {
        padding: 12px 16px;
        text-align: center;
        border-radius: 10px;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .action-btn.primary {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .forgot-section {
        text-align: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .forgot-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        margin-bottom: 8px;
    }

    .forgot-link {
        color: #ffb703;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .forgot-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #ffb703;
        transition: width 0.3s ease;
    }

    .forgot-link:hover {
        color: #ffd166;
    }

    .forgot-link:hover::after {
        width: 100%;
    }

    /* Floating elements */
    .floating-element {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 1;
        animation: float 6s ease-in-out infinite;
    }

    .float-1 {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .float-2 {
        width: 120px;
        height: 120px;
        bottom: 10%;
        right: 10%;
        animation-delay: 2s;
    }

    .float-3 {
        width: 60px;
        height: 60px;
        top: 50%;
        right: 15%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card {
            padding: 30px 20px;
            border-radius: 20px;
        }
        
        .action-buttons {
            grid-template-columns: 1fr;
        }
        
        .login-title {
            font-size: 24px;
        }
    }
</style>

<section class="login-wrapper">
    <!-- Floating background elements -->
    <div class="floating-element float-1"></div>
    <div class="floating-element float-2"></div>
    <div class="floating-element float-3"></div>

    <div class="login-card">
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(siteLogo()); ?>" alt="logo">
            </a>
        </div>

        <!-- Header -->
        <div class="login-header">
            <h1 class="login-title"><?php echo app('translator')->get('Welcome Back'); ?></h1>
            <p class="login-subtitle"><?php echo app('translator')->get('Sign in to continue to your account'); ?></p>
        </div>

        <!-- Login Form -->
        <form class="account-form verify-gcaptcha" method="POST" action="<?php echo e(route('user.login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Username Field -->
            <div class="form--group">
                <label class="form--label"><?php echo app('translator')->get('Username'); ?></label>
                <input class="form-control" 
                       name="username" 
                       type="text"
                       value="<?php echo e(old('username')); ?>" 
                       placeholder="<?php echo app('translator')->get('Enter your username'); ?>" 
                       required>
            </div>

            <!-- Password Field -->
            <div class="form--group">
                <label class="form--label"><?php echo app('translator')->get('Password'); ?></label>
                <div style="position: relative;">
                    <input class="form-control" 
                           id="password" 
                           name="password" 
                           type="password"
                           placeholder="<?php echo app('translator')->get('Enter your password'); ?>" 
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        👁️
                    </button>
                </div>
            </div>

            <!-- Captcha -->
            <?php $custom = true; ?>
            <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve(['custom' => $custom] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Captcha::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>

            <!-- Remember Me -->
            <div class="remember-group">
                <div class="remember-checkbox" id="rememberCheckbox"></div>
                <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> style="display: none;">
                <label for="remember" class="remember-label"><?php echo app('translator')->get('Remember Me'); ?></label>
            </div>

            <!-- Submit Button -->
            <button class="account--btn" type="submit"><?php echo app('translator')->get('Sign In'); ?></button>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a class="action-btn" href="http://paheliherbals.com/">
                    <?php echo app('translator')->get('Home'); ?>
                </a>
                <a class="action-btn primary" href="<?php echo e(route('user.register')); ?>">
                    <?php echo app('translator')->get('Create Account'); ?>
                </a>
            </div>
        </form>

        <!-- Forgot Password -->
        <div class="forgot-section">
            <p class="forgot-text"><?php echo app('translator')->get('Forgot your login credentials?'); ?></p>
            <a class="forgot-link" href="<?php echo e(route('user.password.request')); ?>">
                <?php echo app('translator')->get('Reset Password'); ?>
            </a>
        </div>
    </div>
</section>

<script>
    // Password toggle functionality
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = '🔒';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = '👁️';
        }
    }

    // Custom checkbox functionality
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('remember');
        const customCheckbox = document.getElementById('rememberCheckbox');
        
        // Set initial state
        if (checkbox.checked) {
            customCheckbox.classList.add('checked');
        }
        
        // Toggle on click
        customCheckbox.addEventListener('click', function() {
            checkbox.checked = !checkbox.checked;
            customCheckbox.classList.toggle('checked', checkbox.checked);
        });
        
        // Also toggle when label is clicked
        document.querySelector('.remember-label').addEventListener('click', function() {
            checkbox.checked = !checkbox.checked;
            customCheckbox.classList.toggle('checked', checkbox.checked);
        });
    });

    // Add focus effects to form controls
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paheliherbals/public_html/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>
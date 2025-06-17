<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transform Your Business - Exclusive Webinar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>') no-repeat center center/cover;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .webinar-info {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .info-item i {
            font-size: 1.2rem;
            margin-right: 1rem;
            color: var(--accent-color);
            width: 24px;
        }

        .registration-form {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 2rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--accent-color) 0%, #f97316 100%);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
        }

        .benefits-section {
            padding: 5rem 0;
            background: #f8fafc;
        }

        .benefit-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .benefit-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .countdown-section {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0;
        }

        .countdown-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            margin: 0.5rem;
        }

        .countdown-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
        }

        .countdown-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 3rem 0;
            }

            .registration-form {
                margin-top: 3rem;
                position: relative;
                top: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1 class="hero-title text-white">
                        Transform Your Business in
                        <span style="color: var(--accent-color);">90 Minutes</span>
                    </h1>
                    <p class="hero-subtitle text-white">
                        Join industry experts and discover proven strategies to scale your business,
                        increase revenue, and build lasting success.
                    </p>

                    <div class="webinar-info">
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="text-white"><strong>Date:</strong> June 25, 2025</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <span class="text-white"><strong>Time:</strong> 2:00 PM - 3:30 PM EST</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-laptop"></i>
                            <span class="text-white"><strong>Format:</strong> Live Online Webinar</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-gift"></i>
                            <span class="text-white"><strong>Bonus:</strong> Free Strategy Guide Included</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="registration-form">
                        <div class="text-center mb-4">
                            <h3 class="mb-2" style="color: var(--text-dark);">Reserve Your Spot</h3>
                            <p class="text-muted">Limited seats available - Register now!</p>
                        </div>

                        <form method="POST" action="{{ route('submission.store') }}">
                            @csrf
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if ($activeWebinar)
                            <input type="hidden" name="id" value="{{ $activeWebinar->id }}">
                            @else
                            <div class="alert alert-warning">No active webinar is available right now.</div>
                            @endif



                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
                            </div>

                            <button type="submit" class="btn btn-register w-100 text-white">
                                <i class="fas fa-lock me-2"></i>Secure My Free Spot
                            </button>

                            <p class="text-center mt-3 text-muted small">
                                <i class="fas fa-shield-alt me-1"></i>
                                Your information is 100% secure and will never be shared.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="countdown-section">
        <div class="container">
            <div class="text-center mb-4">
                <h3>Webinar Starts In:</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="countdown-box">
                        <span class="countdown-number" id="days">09</span>
                        <span class="countdown-label">Days</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="countdown-box">
                        <span class="countdown-number" id="hours">14</span>
                        <span class="countdown-label">Hours</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="countdown-box">
                        <span class="countdown-number" id="minutes">25</span>
                        <span class="countdown-label">Minutes</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="countdown-box">
                        <span class="countdown-number" id="seconds">42</span>
                        <span class="countdown-label">Seconds</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">What You'll Learn</h2>
                <p class="lead text-muted">Transform your business with these proven strategies</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="mb-3">Scale Your Revenue</h4>
                        <p class="text-muted">
                            Discover the exact framework used by successful entrepreneurs to 10X their revenue
                            in 12 months or less.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3">Build Your Team</h4>
                        <p class="text-muted">
                            Learn how to attract, hire, and retain top talent while building a culture
                            that drives exceptional results.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="mb-3">Automate & Scale</h4>
                        <p class="text-muted">
                            Implement systems and processes that allow your business to run and grow
                            without your constant involvement.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Business Transformation Webinar. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <i class="fas fa-envelope me-2"></i>support@businesswebinar.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple countdown timer (demo purposes)
        function updateCountdown() {
            const targetDate = new Date('2025-06-25T14:00:00');
            const now = new Date();
            const difference = targetDate - now;

            if (difference > 0) {
                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
</body>

</html>
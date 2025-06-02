<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SkillTrade</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
            color: #1a1a1a;
        }

        /* Subtle Background Pattern */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(#f0f0f0 1px, transparent 1px),
                radial-gradient(#f0f0f0 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.5;
            z-index: 0;
        }

        /* Accent Elements */
        .accent-shape {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        .accent-shape-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(247, 249, 255, 0.8), rgba(229, 239, 255, 0.8));
            top: -100px;
            left: -100px;
        }

        .accent-shape-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(240, 249, 255, 0.6), rgba(224, 242, 254, 0.6));
            bottom: -50px;
            right: -50px;
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            max-width: 1100px;
            width: 90%;
            margin: 2rem auto;
        }

        .welcome-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            animation: fadeIn 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        /* Logo Section */
        .logo-container {
            margin-bottom: 2rem;
            position: relative;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 16px;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2);
        }

        /* Typography */
        .welcome-card h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.2;
        }

        .highlight {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-card p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            color: #4b5563;
            line-height: 1.6;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }

        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            background: #f0f9ff;
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: #f0f9ff;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .feature-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
        }

        .feature-description {
            font-size: 0.9rem;
            color: #6b7280;
            margin-top: 0.5rem;
            line-height: 1.5;
        }

        /* Buttons */
        .button-container {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.875rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #f9fafb;
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #f3f4f6;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #f3f4f6;
        }

        .stat {
            text-align: center;
            padding: 1.5rem;
            border-radius: 16px;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3b82f6;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: #4b5563;
            font-weight: 500;
        }

        /* Animations */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .welcome-card {
                padding: 2rem;
            }

            .welcome-card h1 {
                font-size: 2.5rem;
            }

            .welcome-card p {
                font-size: 1.1rem;
            }

            .features {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .welcome-card h1 {
                font-size: 2rem;
            }

            .welcome-card p {
                font-size: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
                width: 100%;
            }
            
            .button-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Subtle Background Pattern -->
    <div class="bg-pattern"></div>
    
    <!-- Accent Shapes -->
    <div class="accent-shape accent-shape-1"></div>
    <div class="accent-shape accent-shape-2"></div>

    <div class="container">
        <div class="welcome-card">
            <!-- Logo Section -->
            <div class="logo-container">
                <div class="logo">ST</div>
            </div>

            <!-- Main Content -->
            <h1>Welcome to <span class="highlight">SkillTrade</span></h1>
            <p>Connect with experts, exchange knowledge, and elevate your skills. Discover a community where talent meets opportunity.</p>

            <!-- Features -->
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🤝</div>
                    <div class="feature-text">Connect</div>
                    <div class="feature-description">Find skilled professionals in your area</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⚡</div>
                    <div class="feature-text">Learn Fast</div>
                    <div class="feature-description">Accelerate your learning through direct exchange</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⭐</div>
                    <div class="feature-text">Rate & Review</div>
                    <div class="feature-description">Build trust through community feedback</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">📈</div>
                    <div class="feature-text">Grow Skills</div>
                    <div class="feature-description">Track progress and expand your expertise</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-container">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Go to Dashboard →
                </a>
                <a href="#" class="btn btn-secondary">
                    Learn More
                </a>
            </div>

            <!-- Stats Section -->
            <div class="stats">
                <div class="stat">
                    <span class="stat-number">1K+</span>
                    <span class="stat-label">Active Users</span>
                </div>
                <div class="stat">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Skills Available</span>
                </div>
                <div class="stat">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Satisfaction Rate</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to features
            const features = document.querySelectorAll('.feature');
            features.forEach(feature => {
                feature.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                feature.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add click ripple effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(59, 130, 246, 0.2);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Subtle scroll animation for stats
            const stats = document.querySelectorAll('.stat');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            stats.forEach(stat => {
                stat.style.opacity = '0';
                stat.style.transform = 'translateY(20px)';
                stat.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(stat);
            });  
        });
    </script>
</body>
</html>
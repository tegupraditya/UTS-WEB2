<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #4f46e5, #10b981);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3rem 4rem;
        text-align: center;
        color: #ffffff;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        animation: fadeIn 1.5s ease forwards;
        max-width: 600px;
    }

    .welcome-card img {
        width: 100px;
        height: auto;
        margin-bottom: 1.5rem;
    }

    .welcome-card h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .welcome-card p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .welcome-card a {
        display: inline-block;
        padding: 0.75rem 2rem;
        font-size: 1.2rem;
        font-weight: 600;
        color: #4f46e5;
        background-color: #ffffff;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    .welcome-card a:hover {
        background-color: #e0e7ff;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        transform: translateY(-3px);
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<div class="welcome-card">
    <h1>Welcome to SkillTrade</h1>
    <p>Trade skills with others, connect, and grow your expertise together. Your next opportunity starts here!</p>
    <a href="{{ route('dashboard') }}">Go to Dashboard</a>
</div>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B5CF6;
            --primary-dark: #7C3AED;
            --secondary-color: #A855F7;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
            --accent-purple: #8B5CF6;
            --accent-teal: #06b6d4;
            --accent-pink: #ec4899;
            --accent-green: #10b981;
            --primary-blue: #8B5CF6;
            --secondary-blue: #A855F7;
            --white: #ffffff;
            --light-gray: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f8fc;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: rgba(30, 64, 175, 0.15);
            color: #374151;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(30, 64, 175, 0.2);
            border-right: 1px solid rgba(30, 64, 175, 0.3);
        }

        .sidebar-header {
            background: rgba(30, 64, 175, 0.2);
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(30, 64, 175, 0.3);
            min-height: 80px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            overflow: visible;
            border: none;
            box-shadow: none;
            border-radius: 0;
            background: transparent;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%;}

        .sidebar-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.5);
        }

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            color: #1f2937;
            line-height: 1.2;
            word-wrap: break-word;
        }
        
        .sidebar-subtitle {
            font-size: 0.8rem;
            opacity: 0.7;
            font-weight: 700;
            color: #6b7280;
            line-height: 1.2;
            word-wrap: break-word;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            position: relative;
            margin: 0.25rem 1rem;
        }

        .nav-link:hover {
            background: rgba(30, 64, 175, 0.15);
            color: #1e40af;
        }

        .nav-link.active {
            background: rgba(30, 64, 175, 0.25);
            color: #1e40af;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .nav-link.active::before {
            display: none;
        }

        .nav-divider {
            height: 1px;
            background: rgba(30, 64, 175, 0.3);
            margin: 1rem 1.5rem;
            border-radius: 1px;
        }

        .nav-link i {
            margin-right: 0.875rem;
            width: 18px;
            font-size: 1rem;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            background: transparent;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .page-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .page-title {
            color: #1f2937 !important;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .page-date {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-arrow {
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);
        }

        .logout-arrow:hover {
            background: #b91c1c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        .logout-arrow i {
            font-size: 1rem;
        }

        .user-profile-simple {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notification-icons {
            display: flex;
            gap: 0.5rem;
        }

        .notification-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(99, 102, 241, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6366f1;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .notification-icon:hover {
            background: #6366f1;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        .user-profile {
            position: relative;
        }

        .user-profile .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            left: auto;
            margin-top: 0.5rem;
        }

        .user-profile-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            border: 1px solid rgba(99, 102, 241, 0.2);
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(10px);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            outline: none;
        }

        .user-profile-content:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: var(--shadow-lg);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .user-name {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-role {
            color: var(--light-gray);
            font-weight: 500;
            font-size: 0.8rem;
        }

        .user-email {
            color: var(--light-gray);
            font-weight: 500;
            font-size: 0.8rem;
        }

        .dropdown-arrow {
            color: var(--light-gray);
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .dropdown.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 200px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            z-index: 1050;
            max-height: 320px;
            overflow-y: auto;
        }

        .dropdown-header {
            padding: 0.5rem 1rem;
            background: rgba(99, 102, 241, 0.05);
            border-radius: 8px;
            margin: 0 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
        }

        .dropdown-item:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Ensure logout item is visible */
        .dropdown-item[href*="logout"] {
            color: #dc2626 !important;
            font-weight: 600;
        }

        .dropdown-item[href*="logout"]:hover {
            background: rgba(220, 38, 38, 0.1) !important;
            color: #b91c1c !important;
        }

        .dropdown-item[href*="logout"] i {
            color: #dc2626;
        }

        /* Logout item specific styling */
        .logout-item {
            color: #dc2626 !important;
            font-weight: 600 !important;
            background: rgba(220, 38, 38, 0.05) !important;
            border-left: 3px solid #dc2626 !important;
        }

        .logout-item:hover {
            background: rgba(220, 38, 38, 0.1) !important;
            color: #b91c1c !important;
            transform: translateX(5px);
        }

        .logout-item i {
            color: #dc2626 !important;
            font-size: 14px;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-blue) 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
            position: relative;
            overflow: hidden;
            color: var(--white);
            animation: float 6s ease-in-out infinite;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 8s linear infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .welcome-section {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .top-actions {
            display: flex;
            gap: 1rem;
        }

        .action-btn {
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(31, 111, 214, 0.3);
        }

        /* Welcome Banner */
        .welcome-banner {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            border-radius: 20px 20px 0 0;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .welcome-title {
            font-family: 'Poppins', 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 0.5rem;
            letter-spacing: .2px;
        }

        .welcome-subtitle {
            font-family: 'Poppins', 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            font-size: 1.2rem;
            color: #64748b;
            font-weight: 500;
            line-height: 1.6;
        }

        /* Statistics Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            box-shadow: var(--shadow-xl);
        }

        .stat-card.posts {
            border-top: 5px solid #8b5cf6;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
        }

        .stat-card.photos {
            border-top: 5px solid #6366f1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
        }

        .stat-card.agenda {
            border-top: 5px solid #10b981;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
        }

        .stat-card.admin-posts {
            border-top: 5px solid #8b5cf6;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: var(--white);
            font-size: 1.4rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }

        .stat-card.posts .stat-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        }

        .stat-card.photos .stat-icon {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        }

        .stat-card.agenda .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-card.admin-posts .stat-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Make all stat cards the same size */
        .stat-card { padding: 2rem; display: flex; align-items: center; gap: 1rem; min-height: 110px; }
        .stat-number {
            font-size: 2.4rem;
            background: none;
            -webkit-text-fill-color: initial;
            color: #0f172a; /* solid dark so tidak transparan */
        }
        .stat-card .stat-label { color: #1f2937; font-weight: 700; }

        /* Grid untuk 3 kartu besar agar tidak setengah */
        .big-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .big-grid .stat-card.big .stat-content { display: block; }
        .big-grid .stat-card.big .stat-label { text-transform: uppercase; letter-spacing: .5px; }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Quick Actions Section */
        .quick-actions-section {
            margin-bottom: 2rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .section-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        /* Action Cards */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .action-card.photos {
            border-top: 5px solid #8b5cf6;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
        }

        .action-card.categories {
            border-top: 5px solid #6366f1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
        }

        .action-card.agenda {
            border-top: 5px solid #10b981;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
        }

        .action-card.staff {
            border-top: 5px solid #f97316;
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.05) 0%, rgba(234, 88, 12, 0.05) 100%);
        }

        .card-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }

        .action-card.photos .card-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        }

        .action-card.categories .card-icon {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        }

        .action-card.agenda .card-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .action-card.staff .card-icon {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }

        .action-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
        }

        .card-description {
            color: #64748b;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .card-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .action-card.photos .card-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .action-card.categories .card-btn {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .action-card.agenda .card-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .action-card.staff .card-btn {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
        }

        .card-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        /* Recent Section */
        .recent-section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .see-all-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .see-all-link:hover {
            text-decoration: underline;
        }

        .recent-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .recent-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .recent-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .recent-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .recent-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .recent-card-amount {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .recent-card-amount.green {
            color: #10b981;
        }

        .recent-card-amount.red {
            color: #ef4444;
        }

        .recent-card-amount.blue {
            color: #3b82f6;
        }

        .status-tag {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-overdue {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-paid {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .recent-card-date {
            color: var(--light-gray);
            font-size: 0.8rem;
        }

        .view-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: var(--light-gray);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .view-icon:hover {
            color: var(--primary-color);
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1.25rem 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .success-message i {
            font-size: 1.4rem;
        }

        /* Hamburger Menu Button */
        .hamburger-menu {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .hamburger-menu:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .hamburger-menu span {
            display: block;
            width: 24px;
            height: 3px;
            background: #1e40af;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger-menu.active span:nth-child(1) {
            transform: rotate(45deg) translate(7px, 7px);
        }

        .hamburger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-menu.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hamburger-menu {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 80px;
            }
            
            .welcome-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        
            .action-cards {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .top-bar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .quick-links {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-links {
                grid-template-columns: 1fr;
            }

            .calendar-agenda-container {
                grid-template-columns: 1fr;
            }
        }

        /* Management Section */
        .management-section {
            margin-bottom: 2rem;
        }

        .management-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .management-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .management-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
            background: var(--gradient-primary);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }

        .card-description {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-primary, .btn-secondary {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--light-color);
            color: var(--dark-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .welcome-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .welcome-subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin: 0;
            line-height: 1.5;
        }

        /* Statistics Overview */
        .stats-overview {
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
        }

        .stat-icon-photos {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3) !important;
        }

        .stat-icon-categories {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
        }

        .stat-icon-agenda {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3) !important;
        }

        .stat-icon-suggestions {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3) !important;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #6b7280;
            font-weight: 500;
            font-size: 0.875rem;
        }

        /* Quick Access */
        .quick-access {
            margin-bottom: 2rem;
        }

        .quick-access-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .quick-links {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .quick-link {
            background: #f8fafc;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 1.5rem;
            text-decoration: none;
            color: #1f2937;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            text-align: center;
        }

        .quick-link:hover {
            border-color: var(--primary-color);
            background: rgba(99, 102, 241, 0.05);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.15);
        }

        .quick-link i {
            font-size: 2rem;
            color: var(--primary-color);
        }

        /* Calendar Section */
        .calendar-section {
            margin-bottom: 2rem;
        }

        .calendar-agenda-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
        }

        .calendar-card-small {
            background: white;
            border-radius: 16px;
            padding: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .calendar-header-small {
            margin-bottom: 0.75rem;
        }

        .calendar-month-small {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .calendar-nav-small {
            background: #f8fafc;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            padding: 0.25rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.625rem;
        }

        .calendar-nav-small:hover {
            background: #8b5cf6;
            color: white;
        }

        .month-year-small {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .calendar-grid-small {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.125rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-size: 0.625rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .calendar-day:hover {
            background: #f8fafc;
        }

        .calendar-day.today {
            background: #8b5cf6;
            color: white;
        }

        .calendar-day.other-month {
            color: #d1d5db;
        }

        .agenda-card {
            background: white;
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            min-height: 300px;
        }

        .agenda-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .agenda-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .agenda-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #8b5cf6;
        }

        .agenda-time {
            font-size: 0.75rem;
            font-weight: 600;
            color: #8b5cf6;
            min-width: 60px;
            flex-shrink: 0;
            text-align: center;
            line-height: 1.3;
        }

        .agenda-time small {
            font-size: 0.625rem;
            color: #6b7280;
        }

        .agenda-content {
            flex: 1;
        }

        .agenda-title-item {
            font-size: 0.875rem;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .agenda-location {
            font-size: 0.75rem;
            color: #6b7280;
            line-height: 1.2;
        }

        .quick-link span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .welcome-content {
            text-align: center;
        }

        .welcome-title {
            color: #2563eb !important;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .card-icon.blue { background: #3b82f6; }
        .card-icon.green { background: #10b981; }
        .card-icon.purple { background: #8b5cf6; }
        .card-icon.orange { background: #f59e0b; }

        .card-title {
            font-size: 0.9rem;
            font-weight: 500;
            color: #6b7280;
            margin: 0;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0.5rem 0;
        }

        .card-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .card-change.positive {
            color: #10b981;
        }

        .card-change.negative {
            color: #ef4444;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: rgba(248, 250, 252, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(30, 64, 175, 0.1);
            border: 1px solid rgba(30, 64, 175, 0.15);
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            text-align: center;
        }

        .chart-placeholder {
            height: 200px;
            background: #f9fafb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .chart-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            text-align: center;
        }

        .chart-container {
            width: 100%;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
        }

        .chart-container canvas {
            max-width: 100%;
            max-height: 100%;
        }

        .chart-icon {
            width: 50px;
            height: 50px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .chart-text {
            color: #6b7280;
            font-size: 0.9rem;
            text-align: left;
            line-height: 1.6;
            margin-bottom: 1rem;
            padding: 0 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            width: 100%;
            margin-top: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .stat-number {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 500;
        }

        /* Info Panels */
        .info-panels {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .info-panel {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .info-panel-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1f2937;
        }

        @media (max-width: 768px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger Menu Button -->
    <button class="hamburger-menu" id="hamburgerMenu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" style="width:100%;height:100%;object-fit:contain;background:transparent;">
            </div>
            <div>
                <div class="sidebar-title">SMKN 4 BOGOR</div>
                <div class="sidebar-subtitle">Admin Panel</div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard Admin
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.petugas') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    Manajemen Admin
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.photos.index') }}" class="nav-link">
                    <i class="fas fa-images"></i>
                    Kelola Galeri
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="fas fa-folder-open"></i>
                    Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.agenda') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    Kelola Agenda
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.suggestions.index') }}" class="nav-link" style="position: relative;">
                    <i class="fas fa-inbox"></i>
                    Kotak Masuk
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="badge bg-danger rounded-pill" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); font-size: 0.75rem; padding: 0.25rem 0.5rem;">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    Kelola Berita
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.reports') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    Laporan Aktivitas
                </a>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-item">
                <a href="{{ route('admin.logout') }}" class="nav-link" style="color: #ef4444;">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
        </nav>
    </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-info">
                    <h1 class="page-title">Selamat Datang Admin</h1>
                    <div class="page-date">{{ date('l, d F Y') }}</div>
                </div>
                <div class="user-info">
                    <div class="user-profile-simple">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <div class="user-name">
                                    @if($admin)
                                        {{ $admin->username }}
                                    @else
                                        admin
                                    @endif
                                </div>
                            </div>
                            </div>
                </div>
            </div>
                
        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                    </div>
        @endif


        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Galeri</h3>
                    <div class="card-icon blue">
                        <i class="fas fa-images"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalPhotos ?? 0 }}</div>
                
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Kategori</h3>
                    <div class="card-icon green">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalCategories ?? 0 }}</div>
                
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Agenda</h3>
                    <div class="card-icon purple">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalAgenda ?? 0 }}</div>
                
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Saran</h3>
                    <div class="card-icon orange">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalSuggestions ?? 0 }}</div>
                
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Petugas</h3>
                    <div class="card-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalPetugas ?? 0 }}</div>
                
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Total Berita</h3>
                    <div class="card-icon green">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div class="card-value">{{ $totalBerita ?? 0 }}</div>
                
            </div>
        </div>

        </div>


        
    </div>

    <!-- Add Agenda Modal -->
    <div class="modal fade" id="addAgendaModal" tabindex="-1" aria-labelledby="addAgendaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #1f6fd6, #8b5cf6); color: white;">
                    <h5 class="modal-title" id="addAgendaModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Agenda Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.agenda.store') }}" method="POST" id="agendaForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Judul Agenda</label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul agenda" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Waktu</label>
                                <input type="time" name="waktu" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Tempat kegiatan">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Kelas</label>
                                <input type="text" name="kelas" class="form-control" placeholder="Kelas yang terlibat">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="draft">Draft</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Deskripsi agenda"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tipe Agenda</label>
                            <input type="text" name="tipe" class="form-control" placeholder="Contoh: Rapat, Event, Ujian">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="agendaForm" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Agenda
                    </button>
                </div>
            </div>
        </div>
    </div>

    @php
        $categories = isset($recentCategories) ? $recentCategories->pluck('name')->take(4)->toArray() : ['Acara Sekolah', 'Kegiatan Siswa', 'Fasilitas', 'Prestasi'];
        $photoCounts = isset($recentCategories) ? $recentCategories->pluck('fotos_count')->take(4)->toArray() : [12, 8, 15, 6];
        $totalPhotos = isset($recentCategories) ? $recentCategories->sum('fotos_count') : 0;
        $percentages = (isset($recentCategories) && $recentCategories->count() > 0 && $totalPhotos > 0)
            ? $recentCategories->take(4)->map(function($cat) use ($totalPhotos) { return round(($cat->fotos_count / $totalPhotos) * 100, 1); })->toArray()
            : [29.3, 19.5, 36.6, 14.6];
    @endphp

    <script id="chartDataPayload" type="application/json">{!! json_encode(['categories'=>$categories,'photoCounts'=>$photoCounts,'percentages'=>$percentages]) !!}</script>
    <script id="agendaPayload" type="application/json">{!! json_encode($agendas ?? []) !!}</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Check for error message
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#8B5CF6',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        function openAgendaModal() {
            // Redirect to agenda page and open modal
            window.location.href = "{{ route('admin.agenda') }}#addAgendaModal";
        }

        // Chart data
        const chartData = JSON.parse(document.getElementById('chartDataPayload').textContent);

        // Bar Chart for Statistik Galeri
        const barCtx = document.getElementById('barChart');
        if (barCtx) {
            new Chart(barCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: chartData.categories,
                datasets: [{
                    label: 'Jumlah Foto',
                    data: chartData.photoCounts,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(59, 130, 246, 0.5)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(30, 64, 175, 0.2)',
                            drawBorder: true,
                            borderColor: 'rgba(30, 64, 175, 0.3)',
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#374151',
                            font: {
                                size: 13,
                                weight: '500'
                            },
                            stepSize: 1
                        },
                        border: {
                            display: true,
                            color: 'rgba(30, 64, 175, 0.3)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#374151',
                            font: {
                                size: 13,
                                weight: '500'
                            }
                        },
                        border: {
                            display: true,
                            color: 'rgba(30, 64, 175, 0.3)'
                        }
                    }
                }
            }
        });
        }

        // Donut Chart for Kategori Populer
        const donutCtx = document.getElementById('donutChart');
        if (donutCtx) {
            new Chart(donutCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: chartData.categories,
                datasets: [{
                    data: chartData.percentages,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 3,
                    hoverOffset: 15,
                    spacing: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 25,
                            color: '#374151',
                            font: {
                                size: 13,
                                weight: '600'
                            },
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const dataset = data.datasets[0];
                                        const value = dataset.data[i];
                                        const backgroundColor = dataset.backgroundColor[i];
                                        
                                        return {
                                            text: `${label}: ${value}%`,
                                            fillStyle: backgroundColor,
                                            strokeStyle: backgroundColor,
                                            lineWidth: 2,
                                            pointStyle: 'circle',
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(59, 130, 246, 0.5)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });
        }
        
        // Auto-open modal if URL contains hash
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#addAgendaModal') {
                const modal = new bootstrap.Modal(document.getElementById('addAgendaModal'));
                modal.show();
            }
            
            // Initialize dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            // Ensure dropdown menu is visible when opened
            document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    setTimeout(function() {
                        var menu = toggle.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            menu.style.display = 'block';
                            menu.style.visibility = 'visible';
                            menu.style.opacity = '1';
                            
                            // Debug: Check if logout item exists
                            var logoutItem = menu.querySelector('.logout-item');
                            if (logoutItem) {
                                console.log('Logout item found:', logoutItem);
                                logoutItem.style.display = 'flex';
                                logoutItem.style.visibility = 'visible';
                            } else {
                                console.log('Logout item NOT found in dropdown');
                            }
                        }
                    }, 10);
                });
            });
        });

        // Calendar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const calendarGrid = document.getElementById('calendarGrid');
            const currentMonthElement = document.getElementById('currentMonth');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            
            let currentDate = new Date();
            
            // Agenda data from Laravel
            const agendaData = JSON.parse(document.getElementById('agendaPayload')?.textContent || '[]');
            
            function generateCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                
                // Update month/year display
                currentMonthElement.textContent = currentDate.toLocaleDateString('en-US', { 
                    month: 'long', 
                    year: 'numeric' 
                });
                
                // Clear calendar
                calendarGrid.innerHTML = '';
                
                // Add day headers
                const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                dayHeaders.forEach(day => {
                    const dayHeader = document.createElement('div');
                    dayHeader.className = 'calendar-day';
                    dayHeader.style.fontWeight = '600';
                    dayHeader.style.color = '#6b7280';
                    dayHeader.textContent = day;
                    calendarGrid.appendChild(dayHeader);
                });
                
                // Get first day of month and number of days
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay();
                
                // Add empty cells for days before month starts
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day other-month';
                    emptyDay.textContent = '';
                    calendarGrid.appendChild(emptyDay);
                }
                
                // Add days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    dayElement.textContent = day;
                    
                    // Check if this day has agenda events
                    const dayDate = new Date(year, month, day);
                    const dayString = dayDate.toISOString().split('T')[0];
                    const dayAgendas = agendaData.filter(agenda => agenda.tanggal === dayString);
                    
                    // Highlight today
                    const today = new Date();
                    if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                        dayElement.classList.add('today');
                    }
                    
                    // Add event indicator if there are agendas
                    if (dayAgendas.length > 0) {
                        dayElement.style.position = 'relative';
                        dayElement.style.backgroundColor = '#f3f4f6';
                        dayElement.style.border = '1px solid #8b5cf6';
                        
                        const eventDot = document.createElement('div');
                        eventDot.style.position = 'absolute';
                        eventDot.style.bottom = '1px';
                        eventDot.style.right = '1px';
                        eventDot.style.width = '6px';
                        eventDot.style.height = '6px';
                        eventDot.style.backgroundColor = '#8b5cf6';
                        eventDot.style.borderRadius = '50%';
                        eventDot.style.boxShadow = '0 1px 2px rgba(0,0,0,0.2)';
                        dayElement.appendChild(eventDot);
                        
                        // Add tooltip on hover
                        dayElement.title = `${dayAgendas.length} agenda event${dayAgendas.length > 1 ? 's' : ''}`;
                    }
                    
                    calendarGrid.appendChild(dayElement);
                }
            }
            
            // Event listeners for navigation
            prevMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                generateCalendar();
            });
            
            nextMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                generateCalendar();
            });
            
            // Generate initial calendar
            generateCalendar();
        });
    </script>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerMenu = document.getElementById('hamburgerMenu');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle sidebar
            function toggleSidebar() {
                hamburgerMenu.classList.toggle('active');
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                
                if (sidebar.classList.contains('active')) {
                    sidebarOverlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                } else {
                    setTimeout(() => {
                        sidebarOverlay.style.display = 'none';
                    }, 300);
                    document.body.style.overflow = 'auto';
                }
            }

            // Hamburger menu click
            hamburgerMenu.addEventListener('click', toggleSidebar);

            // Overlay click to close
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking menu item on mobile
            if (window.innerWidth <= 768) {
                const sidebarLinks = sidebar.querySelectorAll('.sidebar-menu a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (sidebar.classList.contains('active')) {
                            toggleSidebar();
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
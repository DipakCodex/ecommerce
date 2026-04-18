<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dokan Registration Request</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary: #7c3aed;
            --accent: #f59e0b;
            --accent-soft: #fef3c7;
            --success: #10b981;
            --danger: #ef4444;
            --bg-light: #f8fafc;
            --bg-warm: #f1f5f9;
            --text-dark: #0f172a;
            --text-soft: #475569;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --border-muted: #cbd5e1;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
        }

        .email-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 35px 30px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .email-header p {
            font-size: 17px;
            opacity: 0.95;
        }

        .email-body {
            padding: 40px 35px;
        }

        .info-card {
            background-color: var(--bg-warm);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            padding: 25px;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-muted);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 15px;
        }

        .info-value {
            color: var(--text-dark);
            font-weight: 600;
            text-align: right;
            font-size: 15px;
        }

        .highlight {
            background-color: var(--accent-soft);
            color: var(--accent);
            padding: 4px 12px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 14px;
        }

        .message-box {
            background-color: white;
            border-left: 5px solid var(--secondary);
            padding: 20px;
            border-radius: var(--radius-lg);
            margin: 25px 0;
            font-style: italic;
            color: var(--text-soft);
        }

        .cta-button {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 14px 32px;
            border-radius: var(--radius-lg);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: all 0.3s;
            box-shadow: var(--shadow-md);
        }

        .cta-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .footer {
            background-color: var(--bg-light);
            padding: 25px 35px;
            text-align: center;
            border-top: 1px solid var(--border-light);
            color: var(--text-muted);
            font-size: 13px;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            background-color: var(--success);
            color: white;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>New Dokan Registration</h1>
            <p>A new vendor wants to join <strong>DipakHub</strong></p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p style="font-size: 16px; margin-bottom: 20px; color: var(--text-soft);">
                Hello Admin,
            </p>

            <p style="margin-bottom: 25px;">
                You have received a new <strong>dokan registration request</strong>. Here are the details:
            </p>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Dokan Name</span>
                    <span class="info-value">{{ $dokan->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $dokan->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Contact Number</span>
                    <span class="info-value">{{ $dokan->contact_no }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Category</span>
                    <span class="info-value">
                        <span class="highlight">{{ $dokan->category }}</span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Requested On</span>
                    <span class="info-value">{{ $dokan->created_at->format('d M, Y • h:i A') }}</span>
                </div>
            </div>

            @if($dokan->message)
            <div class="message-box">
                <strong style="color: var(--text-dark);">Message from Dokan:</strong><br><br>
                {{ $dokan->message }}
            </div>
            @endif

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/admin/dokans/' . $dokan->id) }}" class="cta-button">
                    Review Dokan Request →
                </a>
            </div>

            <p style="text-align: center; color: var(--text-muted); font-size: 14px;">
                Please review and approve/reject this request as soon as possible.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>DipakHub</strong> • E-commerce Platform</p>
            <p style="margin-top: 8px;">
                This is an automated notification from your DipakHub system.
            </p>
        </div>
    </div>
</body>
</html>

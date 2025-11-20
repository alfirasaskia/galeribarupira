<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

echo "=== Testing Brevo Email Configuration ===\n\n";

// Display current mail configuration
echo "📧 Mail Configuration:\n";
echo "   MAILER: " . config('mail.default') . "\n";
echo "   HOST: " . config('mail.mailers.smtp.host') . "\n";
echo "   PORT: " . config('mail.mailers.smtp.port') . "\n";
echo "   ENCRYPTION: " . config('mail.mailers.smtp.encryption') . "\n";
echo "   USERNAME: " . (config('mail.mailers.smtp.username') ? config('mail.mailers.smtp.username') : 'NOT SET') . "\n";
echo "   PASSWORD: " . (config('mail.mailers.smtp.password') ? '***SET***' : 'NOT SET') . "\n";
echo "   FROM ADDRESS: " . config('mail.from.address') . "\n";
echo "   FROM NAME: " . config('mail.from.name') . "\n\n";

// Get test email from argument or use default
$testEmail = $argv[1] ?? 'tanziljws@gmail.com';
$testOtp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

echo "📬 Testing Email Send:\n";
echo "   TO: $testEmail\n";
echo "   OTP: $testOtp\n\n";

try {
    echo "⏳ Sending email via Brevo...\n";
    
    Mail::to($testEmail)->send(new SendOtpMail($testOtp, 'Test User'));
    
    echo "✅ Email sent successfully!\n";
    echo "   Please check your inbox at: $testEmail\n";
    echo "   (Also check spam folder)\n";
    
} catch (\Exception $e) {
    echo "❌ Failed to send email!\n\n";
    echo "Error Message: " . $e->getMessage() . "\n\n";
    echo "Error Details:\n";
    echo $e->getTraceAsString() . "\n";
    
    // Check for common issues
    echo "\n🔍 Troubleshooting:\n";
    
    if (strpos($e->getMessage(), 'authentication') !== false) {
        echo "   ⚠️  Authentication failed. Check:\n";
        echo "      - MAIL_USERNAME in .env (should be your Brevo email)\n";
        echo "      - MAIL_PASSWORD in .env (should be Brevo SMTP API key)\n";
    }
    
    if (strpos($e->getMessage(), 'connection') !== false) {
        echo "   ⚠️  Connection failed. Check:\n";
        echo "      - MAIL_HOST in .env (should be smtp-relay.brevo.com)\n";
        echo "      - MAIL_PORT in .env (should be 587)\n";
        echo "      - Firewall is not blocking port 587\n";
    }
    
    if (strpos($e->getMessage(), 'SSL') !== false || strpos($e->getMessage(), 'TLS') !== false) {
        echo "   ⚠️  SSL/TLS issue. Check:\n";
        echo "      - MAIL_ENCRYPTION in .env (should be 'tls')\n";
    }
}


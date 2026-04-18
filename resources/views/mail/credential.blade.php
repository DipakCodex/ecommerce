<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokan Login Credentials</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fa; font-family: Arial, Helvetica, sans-serif;">

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f7fa; padding: 40px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #4f46e5; padding: 35px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 700;">Dokan</h1>
                            <p style="color: #c7d2fe; margin: 8px 0 0 0; font-size: 16px;">Your Store is Now Approved!</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 50px 40px;">

                            <h2 style="color: #1f2937; margin: 0 0 20px 0; font-size: 24px;">Welcome to Dokan!</h2>

                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0 0 30px 0;">
                                Your Dokan account has been approved. You can now log in to your dashboard using the credentials below:
                            </p>

                            <!-- Credential Box -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 2px solid #e0e7ff; border-radius: 10px; padding: 25px; margin-bottom: 30px;">
                                <tr>
                                    <td>
                                        <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px; font-weight: 600;">LOGIN URL</p>
                                        <a href="https://yourdomain.com/dokan/login"
                                           style="color: #4f46e5; font-size: 16px; text-decoration: none; word-break: break-all;">
                                            https://yourdomain.com/dokan/login
                                        </a>
                                    </td>
                                </tr>

                                <tr><td style="height: 20px;"></td></tr>

                                <tr>
                                    <td>
                                        <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px; font-weight: 600;">EMAIL</p>
                                        <p style="margin: 0; color: #1f2937; font-size: 17px; font-weight: 600;">
                                            {{ $data['email'] }}
                                        </p>
                                    </td>
                                </tr>

                                <tr><td style="height: 20px;"></td></tr>

                                <tr>
                                    <td>
                                        <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px; font-weight: 600;">PASSWORD</p>
                                        <p style="margin: 0; color: #1f2937; font-size: 17px; font-weight: 700; letter-spacing: 2px; background-color: #ffffff; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            {{ $password }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #ef4444; font-size: 15px; margin: 0 0 25px 0;">
                                <strong>Important:</strong> Please change your password after your first login for security reasons.
                            </p>

                            <!-- Button -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="https://yourdomain.com/dokan/login"
                                           style="background-color: #4f46e5; color: #ffffff; padding: 16px 32px; text-decoration: none; border-radius: 8px; font-size: 16px; font-weight: 600; display: inline-block;">
                                            Login to Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #64748b; font-size: 14px; margin: 0 0 8px 0;">
                                If you have any questions, feel free to contact our support team.
                            </p>
                            <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                                © {{ date('Y') }} Dokan. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Your Password</title>
    <!--[if mso]>
    <noscript>
        <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background:#0b0c0e;font-family:'Outfit',Arial,sans-serif;color:#f0ece4;-webkit-font-smoothing:antialiased;">

<!-- Pre-header (hidden preview text) -->
<div style="display:none;max-height:0;overflow:hidden;mso-hide:all;">
    Reset your admin password — this link expires in {{ $expiration }} minutes.
    &nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background:#0b0c0e;min-height:100vh;padding:48px 16px;">
    <tr>
        <td align="center" valign="top">

            <!-- ══ OUTER CARD ══ -->
            <table width="600" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:600px;width:100%;background:#111316;border-radius:20px;
                          border:1px solid rgba(200,169,110,.18);overflow:hidden;
                          box-shadow:0 32px 80px rgba(0,0,0,.6);">

                <!-- ── TOP GLOW LINE ── -->
                <tr>
                    <td style="height:1px;background:linear-gradient(90deg,transparent 0%,rgba(200,169,110,.45) 50%,transparent 100%);
                               font-size:0;line-height:0;">&nbsp;</td>
                </tr>

                <!-- ── HEADER ── -->
                <tr>
                    <td align="center" style="padding:44px 48px 32px;">

                        <!-- Logo icon using favicon.ico -->
                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 20px;">
                            <tr>
                                <td align="center"
                                    style="width:64px;height:64px;
                                           background:rgba(200,169,110,.08);
                                           border:1px solid rgba(200,169,110,.22);
                                           border-radius:16px;
                                           text-align:center;vertical-align:middle;">
                                    <img src="{{ asset('favicon.ico') }}"
                                         alt="Logo"
                                         width="36" height="36"
                                         style="display:block;margin:14px auto;
                                                border:0;outline:none;
                                                width:36px;height:36px;">
                                </td>
                            </tr>
                        </table>

                        <!-- Eyebrow -->
                        <p style="margin:0 0 10px;font-size:10px;font-weight:600;
                                  text-transform:uppercase;letter-spacing:2.5px;
                                  color:#c8a96e;">
                            — &nbsp; Security &nbsp; —
                        </p>

                        <!-- Title -->
                        <h1 style="margin:0;font-size:36px;font-weight:300;line-height:1.1;
                                   letter-spacing:-1px;color:#f0ece4;">
                            Reset Your
                            <span style="font-style:italic;color:#c8a96e;">Password.</span>
                        </h1>

                        <!-- Divider -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%"
                               style="margin:24px auto 0;max-width:320px;">
                            <tr>
                                <td style="height:1px;background:rgba(255,255,255,.07);font-size:0;"></td>
                                <td width="6" style="text-align:center;vertical-align:middle;padding:0 12px;">
                                    <div style="width:4px;height:4px;border-radius:50%;
                                                background:#c8a96e;opacity:.5;
                                                display:inline-block;"></div>
                                </td>
                                <td style="height:1px;background:rgba(255,255,255,.07);font-size:0;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ── BODY ── -->
                <tr>
                    <td style="padding:0 48px 36px;">

                        <p style="margin:0 0 16px;font-size:15px;line-height:1.8;
                                  color:rgba(240,236,228,.75);">
                            Hello,
                        </p>
                        <p style="margin:0 0 28px;font-size:15px;line-height:1.8;
                                  color:rgba(240,236,228,.75);">
                            We received a request to reset the password for your admin account.
                            Click the button below to create a new password. If you didn't make
                            this request, you can safely ignore this email.
                        </p>

                        <!-- CTA Button — mirrors .pf-btn-primary -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%"
                               style="margin:0 0 32px;">
                            <tr>
                                <td align="center">
                                    <a href="{{ $url }}"
                                       style="display:inline-block;
                                              padding:15px 36px;
                                              background:transparent;
                                              border:1px solid rgba(200,169,110,.55);
                                              border-radius:10px;
                                              color:#e8c98a;
                                              font-size:11px;font-weight:600;
                                              text-transform:uppercase;letter-spacing:2px;
                                              text-decoration:none;
                                              font-family:'Outfit',Arial,sans-serif;">
                                        &#x2192;&nbsp;&nbsp;Reset Password
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- Expiry notice -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%"
                               style="margin:0 0 28px;">
                            <tr>
                                <td style="padding:16px 20px;
                                           background:rgba(200,169,110,.04);
                                           border:1px solid rgba(200,169,110,.12);
                                           border-radius:12px;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td width="20" valign="top" style="padding-top:1px;">
                                                <span style="color:#c8a96e;font-size:12px;">&#9432;</span>
                                            </td>
                                            <td style="padding-left:10px;">
                                                <p style="margin:0 0 4px;font-size:11px;font-weight:600;
                                                          text-transform:uppercase;letter-spacing:1.5px;
                                                          color:#c8a96e;">
                                                    Important
                                                </p>
                                                <p style="margin:0;font-size:13px;line-height:1.75;
                                                          color:rgba(240,236,228,.55);">
                                                    This link expires in
                                                    <strong style="color:#e8c98a;">{{ $expiration }} minutes</strong>.
                                                    After that you'll need to request a new reset link.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- URL fallback -->
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td style="padding:16px 20px;
                                           background:#161820;
                                           border:1px solid rgba(255,255,255,.07);
                                           border-radius:12px;">
                                    <p style="margin:0 0 8px;font-size:11px;font-weight:600;
                                              text-transform:uppercase;letter-spacing:1.5px;
                                              color:rgba(240,236,228,.35);">
                                        Or copy this link into your browser
                                    </p>
                                    <p style="margin:0;font-size:12px;line-height:1.7;
                                              color:rgba(200,169,110,.6);
                                              word-break:break-all;font-family:monospace;">
                                        {{ $url }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ── DIVIDER ── -->
                <tr>
                    <td style="padding:0 48px;">
                        <div style="height:1px;background:rgba(255,255,255,.06);font-size:0;">&nbsp;</div>
                    </td>
                </tr>

                <!-- ── FOOTER ── -->
                <tr>
                    <td style="padding:28px 48px 40px;" align="center">

                        <!-- Logo row -->
                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 16px;">
                            <tr>
                                <td style="vertical-align:middle;">
                                    <img src="{{ asset('favicon.ico') }}"
                                         alt="Logo" width="20" height="20"
                                         style="display:inline-block;vertical-align:middle;
                                                border:0;opacity:.5;width:20px;height:20px;">
                                </td>
                                <td style="padding-left:8px;vertical-align:middle;">
                                    <span style="font-size:12px;font-weight:600;
                                                 text-transform:uppercase;letter-spacing:2px;
                                                 color:rgba(200,169,110,.5);">
                                        Ivan Kim Almadin
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 6px;font-size:12px;line-height:1.7;
                                  color:rgba(240,236,228,.25);">
                            This email was sent because a password reset was requested for your account.
                        </p>
                        <p style="margin:0;font-size:12px;color:rgba(240,236,228,.2);">
                            If you did not request this, no action is needed.
                        </p>
                    </td>
                </tr>

                <!-- ── BOTTOM GLOW LINE ── -->
                <tr>
                    <td style="height:1px;background:linear-gradient(90deg,transparent 0%,rgba(200,169,110,.12) 50%,transparent 100%);
                               font-size:0;line-height:0;">&nbsp;</td>
                </tr>

            </table>
            <!-- /OUTER CARD -->

        </td>
    </tr>
</table>

</body>
</html>
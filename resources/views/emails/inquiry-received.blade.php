<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: system-ui, sans-serif; color: #111827; background: #f9fafb; margin: 0; padding: 24px;">
    <div style="max-width: 640px; margin: 0 auto; background: white; border-radius: 20px; padding: 32px; box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);">
        <h1 style="margin-top: 0; font-size: 24px; color: #111827;">New inquiry received</h1>

        <p style="margin: 0 0 1rem; color: #374151;">A visitor submitted a new contact message through the portfolio site.</p>

        <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <tr>
                <td style="padding: 12px 0; font-weight: 700; color: #111827; width: 140px;">Name</td>
                <td style="padding: 12px 0; color: #4b5563;">{{ $inquiry->name }}</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; font-weight: 700; color: #111827;">Email</td>
                <td style="padding: 12px 0; color: #4b5563;">{{ $inquiry->email }}</td>
            </tr>
            @if($inquiry->phone)
            <tr>
                <td style="padding: 12px 0; font-weight: 700; color: #111827;">Phone</td>
                <td style="padding: 12px 0; color: #4b5563;">{{ $inquiry->phone }}</td>
            </tr>
            @endif
            @if($inquiry->subject)
            <tr>
                <td style="padding: 12px 0; font-weight: 700; color: #111827;">Subject</td>
                <td style="padding: 12px 0; color: #4b5563;">{{ $inquiry->subject }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding: 12px 0; font-weight: 700; color: #111827; vertical-align: top;">Message</td>
                <td style="padding: 12px 0; color: #4b5563; white-space: pre-wrap;">{{ $inquiry->message }}</td>
            </tr>
        </table>

        <p style="margin-top: 2rem; color: #6b7280; font-size: 0.95rem;">You can reply directly to the visitor at {{ $inquiry->email }}.</p>
    </div>
</body>
</html>

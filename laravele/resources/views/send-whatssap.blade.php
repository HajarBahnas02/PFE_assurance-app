<!DOCTYPE html>
<html>
<head>
    <title>Send WhatsApp Message</title>
</head>
<body>
    <form action="/send-whatsapp" method="POST">
        @csrf
        <label for="to">To (WhatsApp Number):</label>
        <input type="text" id="to" name="to" placeholder="whatsapp:+1234567890"><br><br>
        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea><br><br>
        <button type="submit">Send Message</button>
    </form>
</body>
</html>
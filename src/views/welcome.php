<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #ece9e6, #ffffff);
        color: #444;
        line-height: 1.6;
    }

    .container {
        width: 80%;
        max-width: 900px;
        margin: 50px auto;
        padding: 40px;
        background: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        border-top: 8px solid #6c757d;
        position: relative;
    }

    .container::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 5px;
        background: #007BFF;
        border-radius: 50px;
    }

    h1 {
        color: #343a40;
        font-size: 3em;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 700;
    }

    p {
        font-size: 1.2em;
        margin-bottom: 25px;
        text-align: justify;
        color: #555;
    }

    .footer {
        text-align: center;
        margin-top: 40px;
        font-size: 1em;
        color: #888;
    }
</style>

<div class="container">
    <h1><?php echo htmlspecialchars($title, ENT_QUOTES, "UTF-8"); ?></h1>
    <p><?php echo htmlspecialchars($content, ENT_QUOTES, "UTF-8"); ?></p>
    <div class="footer">
        &copy; <?php echo date("Y"); ?> My Elegant Website. All rights reserved.
    </div>
</div>
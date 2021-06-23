<head>
    <meta charset="utf-8">
    <title><?php echo $heading; ?></title>
    <style>
        body { text-align: center;}
        h1 { font-size: 50px; text-align: center }
        span[frown] { transform: rotate(90deg); display:inline-block; color: #bbb; }
        body { font: 20px Constantia, 'Hoefler Text',  "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; color: #999; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5); }
        ::-moz-selection{ background:#FF5E99; color:#fff; }
        ::selection { background:#FF5E99; color:#fff; }
        article {display:block; text-align: left; width: 600px; margin: 0 auto; }
        a { color: rgb(36, 109, 56); text-decoration:none; }
        a:hover { color: rgb(96, 73, 141) ; text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5); }
    </style>
</head>
<body>
    <article>
        <h1><?php echo $heading; ?>  <span frown> :( </span></h1>
        <div>
            <?php echo $message; ?>
            <p>Sorry, but the page you were trying to view does not exist.</p>
            <p>But don't give up. we like to helping people find information. Here's what you can do:</p>
            <ul>
                <li>Start over at the home page : <a href="" target="_blank" title="Sheba Holdings Ltd">Example Ltd Ltd</a></li>
                <li>Email us with what you're looking for : <a href="#" target="_blank">info@example.com</a></li>
            </ul>
            <p>We thank you for visiting "" , have a nice time !</p>
        </div>
    </article>
</body>
</html>
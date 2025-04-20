# ✈️ WebSec Air – CSEC 380 Final Project  
**By Yara Abdallah, Leen Malkawi, Omar Awad Ali, and Mohammed Ibrahim**

A simulated travel portal demonstrating both vulnerable and secure web application practices.  
This project was developed as part of the *Web Attacks & Mitigations* course at RIT Dubai.

---

## Project Structure

| Folder | Description |
|--------|-------------|
| `victim.local` | Vulnerable website used to demonstrate attacks |
| `secure.local` | Secure version implementing proper mitigations |
| `evil.local` | Attacker site used to inject remote XSS |

---

## Simulated Attacks

The vulnerable site (`victim.local`) demonstrates five common web application attacks:

1. **SQL Injection**
2. **Brute Force Login**
3. **Persistent Cross-Site Scripting (XSS)**
4. **Local File Inclusion (LFI)**
5. **Insecure Direct Object Reference (IDOR)**

Each attack is followed by a securely mitigated version in `secure.local`.

---

## Mitigation Techniques Implemented

- Prepared statements to prevent SQL injection  
- Output sanitization (`htmlspecialchars()`) to stop XSS  
- Whitelisting and path validation to prevent LFI  
- Session-based access control to fix IDOR  
- Secure design principles across all pages

---

## Styling

All CSS files (`style.css`, `style_guides.css`, `style_profile.css`, `style_dashboard.css`) are shared across both environments and serve **UI purposes only** — they do not affect security logic.

---

## Testing Tools Used

- **Burp Suite**  
- **Browser DevTools**  
- **Manual payload testing**  
- **Custom XSS injection via `evil.local`**

---

## Project Use

> This project is for **academic and ethical demonstration purposes only.**  
> Do not use these techniques outside of controlled environments.

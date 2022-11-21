# BIT Sample Project in PHP

This is sample project of BIT ISTTS in Git. This is for BIT LABS!

## This project can use PHP Docker/Podman

You can run this using this command 

```bash
podman run -it --rm -w /var/www/html -v .:/var/www/html:Z -p 8000:80 localhost/php:8.1.9 php -S 0.0.0.0:80 -t .
```
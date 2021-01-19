@echo off
:loop
php M20.php
timeout /t 1 > NUL
goto loop
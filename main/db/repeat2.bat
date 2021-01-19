@echo off
:loop
php M20_SO2.php
timeout /t 1 > NUL
goto loop
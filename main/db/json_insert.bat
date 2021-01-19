@echo off
:loop
php insert_start_json.php
timeout /t 3 > NUL
goto loop
@ECHO OFF
SET targetPath="%~1"
SET ToolPath=%~dp0

dir %targetPath% /b /s /a-d > "%ToolPath%list.txt"

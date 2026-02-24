$ErrorActionPreference = "Stop"

$pgctl = "C:\Program Files\PostgreSQL\16\bin\pg_ctl.exe"
$data = Join-Path $PSScriptRoot ".local_pg\data"

if (!(Test-Path $data)) {
  Write-Output "No local project DB cluster found."
  exit 0
}

& $pgctl -D $data stop -m fast
Write-Output "Project DB stopped."

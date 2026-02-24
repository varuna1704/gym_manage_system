$ErrorActionPreference = "Stop"

$pgctl = "C:\Program Files\PostgreSQL\16\bin\pg_ctl.exe"
$data = Join-Path $PSScriptRoot ".local_pg\data"
$log = Join-Path $PSScriptRoot ".local_pg\postgres.log"
$port = "5433"

if (!(Test-Path $data)) {
  Write-Error "Database cluster not found. Run .\\setup_project_db.ps1 first."
}

& $pgctl -D $data status *> $null
if ($LASTEXITCODE -eq 0) {
  Write-Output "Project DB is already running on localhost:$port"
} else {
  & $pgctl -D $data -l $log -o "-p $port" start
  Write-Output "Project DB started on localhost:$port"
}

$ErrorActionPreference = "Stop"

$bin = "C:\Program Files\PostgreSQL\16\bin"
$initdb = Join-Path $bin "initdb.exe"
$pgctl = Join-Path $bin "pg_ctl.exe"
$psql = Join-Path $bin "psql.exe"
$pgrestore = Join-Path $bin "pg_restore.exe"

$base = Join-Path $PSScriptRoot ".local_pg"
$data = Join-Path $base "data"
$log = Join-Path $base "postgres.log"
$dump = Join-Path $PSScriptRoot "tubcs_data.sql"

$port = "5433"
$db = "gym_mang_system_v1"
$dbUser = "gym_mang_user"
$dbPass = "gym_mang_pass_2026"

New-Item -ItemType Directory -Path $base -Force | Out-Null

if (!(Test-Path $data)) {
  & $initdb -D $data -U postgres -A trust --encoding=UTF8 --locale=C
}

& $pgctl -D $data status *> $null
if ($LASTEXITCODE -ne 0) {
  & $pgctl -D $data -l $log -o "-p $port" start | Out-Null
  Start-Sleep -Seconds 2
}

$roleExists = (& $psql -h localhost -p $port -U postgres -d postgres -t -A -c "SELECT 1 FROM pg_roles WHERE rolname='$dbUser';").Trim()
if ($roleExists -ne "1") {
  & $psql -h localhost -p $port -U postgres -d postgres -c "CREATE ROLE $dbUser LOGIN PASSWORD '$dbPass';"
} else {
  & $psql -h localhost -p $port -U postgres -d postgres -c "ALTER ROLE $dbUser WITH LOGIN PASSWORD '$dbPass';"
}

$dbExists = (& $psql -h localhost -p $port -U postgres -d postgres -t -A -c "SELECT 1 FROM pg_database WHERE datname='$db';").Trim()
if ($dbExists -ne "1") {
  & $psql -h localhost -p $port -U postgres -d postgres -c "CREATE DATABASE $db OWNER $dbUser;"
}

& $pgrestore -h localhost -p $port -U postgres -d $db --clean --if-exists --no-owner --no-privileges $dump
@'
CREATE TABLE IF NOT EXISTS public."user" (
  id SERIAL PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  username VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO public."user" (name, username, password)
SELECT DISTINCT ON (a.admin_name)
  COALESCE(NULLIF(TRIM(COALESCE(a.admin_fname, '') || ' ' || COALESCE(a.admin_lname, '')), ''), a.admin_name) AS name,
  a.admin_name AS username,
  md5(a.admin_pass) AS password
FROM public.admin a
WHERE a.admin_name IS NOT NULL AND a.admin_name <> ''
ORDER BY a.admin_name, a.admin_id DESC
ON CONFLICT (username)
DO UPDATE SET name = EXCLUDED.name, password = EXCLUDED.password;
'@ | & $psql -h localhost -p $port -U postgres -d $db

& $psql -h localhost -p $port -U postgres -d $db -c "GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO $dbUser;"
& $psql -h localhost -p $port -U postgres -d $db -c "GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO $dbUser;"

Write-Output "Database ready: $db on localhost:$port"

#!/usr/bin/env bash
set -euo pipefail

LOG_FILE="logs/actions.log"
ERR_FILE="logs/errors.log"
mkdir -p logs

timestamp=$(date '+%Y-%m-%d %H:%M:%S')
EXIT_CODE=0

clear
echo "Health Check"
echo "------------"

echo "[$timestamp] Health check started" >> "$LOG_FILE"

# Проверка API
if curl -fs http://localhost:8000/health > /dev/null 2>>"$ERR_FILE"; then
  echo "API OK"
else
  echo "API FAIL"
  EXIT_CODE=1
fi

# Проверка БД (Postgres пример)
if pg_isready -h localhost -p 5432 -q; then
  echo "Postgres OK"
else
  echo "Postgres FAIL"
  EXIT_CODE=1
fi

# Проверка Docker контейнеров
if docker ps > /dev/null 2>>"$ERR_FILE"; then
  echo "Docker OK"
else
  echo "Docker FAIL"
  EXIT_CODE=1
fi

echo "[$timestamp] Health check finished, Exit code: $EXIT_CODE" >> "$LOG_FILE"
exit $EXIT_CODE

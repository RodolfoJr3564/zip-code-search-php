#!/bin/sh

if [ ! -f .env ]; then
    cp .env.example .env
fi

/wait-for "${DB_HOST:-postgres}:${DB_PORT:-5432}"

php -d max_execution_time=0 -S 0.0.0.0:${PORT:-8000} -t public
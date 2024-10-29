#!/bin/bash

npm i; composer i

# Check if .env file does not exist
if [ ! -f .env ]; then
  cp .env.example .env
  echo $'\n.env file created from .env.example.'
else
  echo $'\n.env file already exists. No action taken.'
fi

# Check if APP_KEY in .env is empty or unset
if ! grep -q "^APP_KEY=" .env || [ -z "$(grep "^APP_KEY=" .env | cut -d '=' -f2)" ]; then
  php artisan key:generate
else
  echo $'\nAPP_KEY already exists and is not empty. No action taken.'
fi

# Check if port 5432 is open on localhost
if (echo > /dev/tcp/localhost/5432) &>/dev/null; then
  php artisan migrate && php artisan db:seed
  echo $'\nMigration and seeding completed.'
else
  echo $'\nNo database detected on port 5432. Migration and seeding skipped.'
fi
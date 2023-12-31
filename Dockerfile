FROM php:8.1-alpine

RUN apt-get update
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
COPY . .

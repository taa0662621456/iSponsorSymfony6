#!/bin/bash

BASE_URL="http://localhost:8000/api"

echo "=== 1. User Registration (Email Notification) ==="
curl -s -o /dev/null -w "%{http_code}\n" -X POST $BASE_URL/register \
  -H "Content-Type: application/json" \
  -d '{
    "email": "testuser@example.com",
    "password": "StrongPass123!",
    "username": "testuser"
  }'

echo "=== 2. Verify Account (Email Notification) ==="
curl -s -o /dev/null -w "%{http_code}\n" -X POST $BASE_URL/verify \
  -H "Content-Type: application/json" \
  -d '{
    "email": "testuser@example.com",
    "code": "123456"
  }'

echo "=== 3. Password Reset (Email Notification) ==="
curl -s -o /dev/null -w "%{http_code}\n" -X POST $BASE_URL/password/request-reset \
  -H "Content-Type: application/json" \
  -d '{
    "email": "testuser@example.com"
  }'

echo "=== 4. Send SMS Notification ==="
curl -s -o /dev/null -w "%{http_code}\n" -X POST $BASE_URL/notify/sms \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "+17135551234",
    "message": "Your verification code is 654321"
  }'

echo "=== 5. Send Push Notification ==="
curl -s -o /dev/null -w "%{http_code}\n" -X POST $BASE_URL/notify/push \
  -H "Content-Type: application/json" \
  -d '{
    "deviceToken": "fake-device-id",
    "message": "Hello from NotificationService!"
  }'

echo "=== DONE ==="
echo "Now check messenger worker logs:"
echo "  symfony console messenger:consume async -vv"

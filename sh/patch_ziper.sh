#!/bin/bash

#PATCH_DIR="/var/patch"

#ZIP_DIR="/var/zip"

ZIP_NAME="patch-$(date +%Y-%m-%d-%H-%M-%S).zip"

if [ $# -eq 0 ]; then
    echo "No files provided."
    exit 1
fi
zip "$ZIP_NAME" "$@"

echo "Created archive: $ZIP_NAME"

  if [ $? -ne 0 ]; then
    read -p "Произошла ошибка. Нажмите Enter для продолжения."
  fi

#!/usr/bin/env bash
set -euo pipefail

OUT_DIR="zips"
mkdir -p "$OUT_DIR"

clear
echo "Dynamic Zip Builder"
echo "-------------------"

# собираем список папок в корне
folders=()
i=1
for dir in */; do
  # считаем размер папки в байтах
  size=$(du -sb "$dir" | awk '{print $1}')
  if [ "$size" -lt 500000000 ]; then
    human=$(du -sh "$dir" | awk '{print $1}')
    echo "$i) $dir ($human)"
    folders+=("$dir")
    i=$((i+1))
  fi
done

# пункт для корневых файлов
echo "$i) Root files (без папок)"

read -p "Выберите номер: " choice
timestamp=$(date '+%Y-%m-%d_%H-%M-%S')

if [ "$choice" -eq "$i" ]; then
  zip -r "$OUT_DIR/root_$timestamp.zip" $(ls -p | grep -v /)
  echo "Создан $OUT_DIR/root_$timestamp.zip"
else
  folder="${folders[$((choice-1))]}"
  zip -r "$OUT_DIR/${folder%/}_$timestamp.zip" "$folder"
  echo "Создан $OUT_DIR/${folder%/}_$timestamp.zip"
fi

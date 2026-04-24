#!/bin/bash
cd "$(dirname "$0")/.."

declare -A PRODUCTS=(
    [fakro-lwk-komfort]="2:1Ixc-BsYEImkDg-VMTGzrz6JjzkaOzX9j 3:17hTnJc37OkReQpy7ne06npJgGFw8Kvle 4:1dAxNguJ-kC25Jd-JTsTWIsZQmz_5ZKuD"
    [fakro-lwt-thermo]="6:1mv-1lFFPvQ0B36YhhyFeompn2TIlnFu6 7:1OhQQ2O3Zp9L97ZEgUVq5CWIjADtZV3O3"
    [fakro-ltk-energy]="10:1XVyZTIK4b4R1Kw_mx4FzyjW8a7EYrWad 11:1IdOoGzWz0j6ScOlM4MrKI0gsmDnXSx2A"
    [fakro-lst]="13:1_CFu3dmPP64VZmtfbcr_1BW6hdzyWeiD 14:1lA7V9NK5oANNboy3S6iv2eZd7mfqd8sj"
    [fakro-lml-lux]="16:1Bam4O0ZWyqInlR_MijLoQijy9QHs41xz 17:1jv8srqF9S5HNQ9iA_L259Uy8t-ljuePh 18:1ltdf0lM4I9O1dNzxA9JohF6DZ4mevaFM"
    [fakro-lmf]="20:1Ss0OuPGodigWlJM_X4QjrSjv436Cl7mP 21:1Aq58JT3pZ0YkBNZYkXohVVDpbhTHPOzs 22:1XFEj8TdOSxJZQsLtmALxxCxD5taPiU2A"
    [fakro-lwl-extra]="24:1rGHla5uZIMKD39l4IbgYSPk7D5Hw1xoi 25:1X1mLgrYvoiEMTR0eWynGLhgiEm8HK11x"
    [fakro-lwf-45]="27:1eAjb2j1Eja5iUuGTBSgU99pucwWy4zpN 28:1bdH5Cui-wyy4VyvhnD2gR0dxtY576jrd"
    [fakro-lwz-plus]="33:1c9yDLT1oOCmtPyKiCsiouVjkDHyz_zR9 34:1NtZkr6tERlGvUbvOQ_6DpO8VozWel1FB"
    [fakro-lmk-komfort]="36:1NjEdxF6ggt7N8tkwnfG4LHTh4ZgQ_5_i 37:1hgvLfhBQPOSOmkJXk1kgtbDaZb9RS7ZY 38:15_OUECCujSw9c9iiL3ZqgnFJVhQaM4eg"
    [fakro-lmp]="40:1AQcJcWWuuI82uokC5TH6EuIFZjDEsBB- 41:100lQbPy29Tl3X20OE5RpeyAwR4O12R5N 42:1TQ25VpPvO9TfrIajwCMuUMXdOJ301EGC 43:1ORMo0QyNMId7DGteeusEyuP5vvAug5ZL 44:1uViAZ3vSL6da-hTioEkyRDRAWXaHkMqe"
    [fakro-lsz]="46:1cErqCCcy3IihzrmMpzEpqm7tWBQFCSbM 47:1Mdqxvpi21H_KwYeMOn--79G7bpUPOHRt"
    [fakro-lsf]="49:1_cPbFvfAZNYwQZqjrMPEQbP-jieU8rp5"
)

for slug in "${!PRODUCTS[@]}"; do
    mkdir -p "public/uploads/products/$slug"
    for pair in ${PRODUCTS[$slug]}; do
        num=${pair%:*}
        id=${pair#*:}
        file="public/uploads/products/$slug/$num.png"
        if [ ! -f "$file" ]; then
            curl -skL -o "$file" "https://drive.google.com/uc?export=download&id=${id}"
            sz=$(stat -c %s "$file" 2>/dev/null || echo 0)
            echo "$slug/$num.png -> $sz"
        fi
    done
done
echo "=== DONE ==="

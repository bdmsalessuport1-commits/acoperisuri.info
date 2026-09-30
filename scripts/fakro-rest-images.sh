#!/bin/bash
cd "$(dirname "$0")/.."

declare -A PRODUCTS=(
    # Ferestre Acoperis Terasa (8)
    [fakro-dxc-c-p2]="2:1smwwayhbp9NlY4AnVWlx3bpitmn9M-x4 3:1BrB458-GGxiCkQZAjpopMCawms1o8Dyy"
    [fakro-dxf-du6]="5:1xWH1WsYs0ED_iXuYSahrB6rLJN_U0v5b 6:1mNu6TD_aC0M-J84kIQoxhbkD5oEwQIt5 7:1tDmDJIwT_UYPmMNdG9nfVBgXGfXga6ot 8:1S1-ZzKAKGdVr3wx7o53CECHCER7NbK19"
    [fakro-dmf-du6]="10:1d-7ijInUklxzEIe-knYupJdc9yz2wONM 11:1WJVapNfBn-Edlh0B3beIqaGhsVUlLBIf 12:1QNzjq1RjJZQdBQHBfpJotkMiW0UaZRiE"
    [fakro-def-du6]="14:1ccLSEFLGzE5zDsVriPTiVZKRSIOKuGmv 15:1p-b3g109fZyr8r4fbKZ3I1TD6F8SVYFU"
    [fakro-dxw]="17:1pQxE4j0O0Mpzq-4iwSf6uYs5fYbZQt30 18:1Bi0b3_pC9dst-0L3WPU6kyVl6WvRx9Wt 19:1QLd2uA7wXurnEOgsosPQoLB_y_wBR8Vu"
    [fakro-dsf]="21:1BNY1YX1FSmFLzkER0XeefS2ZHgMia6E3 22:1914jYIbxqcrjFd5uB0SDjf-5ZNj8yI03"
    [fakro-drc-c-p2]="24:1v6IR7zPkjdcsgOoYmF8uXcTotRotlOCW 25:15yZWR1Fn_41uA6DUOxfST6pDH3On7VWN 26:1LtJkdgpM45z7qQ0oz4kKXHAygsIanO2-"
    [fakro-drl]="28:1MDN4azmDKgkNYzTfmgN8mDJmTD20RD6L 29:1T3jmNLlGqD-JMUBgwaClJLPHxi3dmTMa 30:1a1rDJ6F_e_NjIPdxmUs8eW0B9MghePkv"
    # Tunele de Lumina (4)
    [fakro-srt]="2:1p7Tqg0g97g4p1_y5EujEF39F1ISD6vIh 3:1CB6udrQskwG00e8AWj3PbGG0aXDTkgzA 4:1yCru-TYThb_CX89HRQ7YTgCpgIS2nZug"
    [fakro-slt]="6:1mW6IioV7vFEHn2MyTsixzcnBYH3IrS0P 7:1loGbst9-qczYkWDYg9u3NS3GHcA8Nfu_"
    [fakro-sr]="9:1aKKbM5wbPrgp3Ht3DoTtmoLAMHibDffY 12:1e-d9n2iqCYRS3tCkpRk-iPRnF8d778rW"
    [fakro-sf]="14:1rPGoye40Skn39wx-7OujvbO4DnJEaM_4"
    # Luminatoare (3)
    [fakro-wli]="2:1kkmHdw_OphM7Yn3h4pgkuBclTc7l9ncD 3:1Oikl91k5uTgHfm9sEClT-nf02eWfQT4u"
    [fakro-wgi]="5:1GFeZeJQ5T5M65Zuw3cmwSOo-BBdzZEOO 6:1-bzTlzLCcGAMFABkvC5LvEiEvuaUSEnL 7:1NAg9F78G2Rsg9ixfiCwU9Tn0sPTxtWBd"
    [fakro-wgt]="9:1PHtjLHsJXXu6_xOGZvtgCP22InRfkWej 10:1lA5cSq0-SM-3EqDalJrbY994IiVoAv-y"
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

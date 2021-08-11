<?php
    $bil =array (72, 65, 73, 78, 75, 74, 90, 81, 87, 65, 55, 69, 72, 78, 79, 91, 100, 40, 67, 77, 86);

    $i = 0;
        while(list($indeks,$nilai)=each($bil))
            {
                $i=$i+1;
            }

        for ($i=0; $i<=count($bil)-1; $i++)
            {
                $bilangan[$i]= $bil[$i];
                $jumlah= $jumlah + $bilangan[$i];
            }
    echo "Rata-rata nya "." = ".$jumlah/count($bil);
?>
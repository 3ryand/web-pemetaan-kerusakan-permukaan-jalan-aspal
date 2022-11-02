<script type="text/javascript">
    function konfirmasi(){
        var div = document.getElementById("dom-target");
        var myData = div.textContent;
        if (confirm("Apakah anda yakin ingin menghapus gambar tersebut?")) {
            const myArray = myData.split("konfirmasi();");
            const myArray2 = myArray[0].split(" ");
            let word = myArray2[4];
            window.location.replace("https://automata.masuk.id/home/" + word);
        }else {
            window.location.replace("https://automata.masuk.id/home");
        }
    }
</script>

<div id="dom-target" style="color:white;">
    <?php
        require('database.php');
        $gambar = $_GET["gambar"];
        $id_gambar = $_GET["id_gambar"];
        echo "hapus.php?gambar=".$gambar;
        echo "&id_gambar=".$id_gambar;
        echo '<script type="text/javascript">','konfirmasi();','</script>';
    ?>
</div>
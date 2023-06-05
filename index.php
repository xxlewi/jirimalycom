<!DOCTYPE html>
<html>
<head>
<style>
    .roll {
        font-family: Arial, sans-serif;
        max-width: 1100px;
        display: flex;          /* new line */
        justify-content: center; /* new line */
        margin: 0 auto;          /* new line */
        
    }

    .index_welcome {
        font-size: 20px;
        color: #333;
    }

    .index_intro {
        font-size: 16px;
        line-height: 1.6;
        color: #666;
    }

    .content_container {
        display: flex;
        align-items: center;
        margin-right: 20px;
        margin-left: 20px;
        margin-top: 20px;
    }

    .image_container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50%;   /* new line */
    }

    .image_container img {
        border-radius: 50%;
        max-width: 72%;
    }

    .text_container {
        width: 50%;
    }
</style>

</head>
<body>
<?php require_once "menu.php"; ?>

<div class="roll">

    <div class="content_container">

        <div class="image_container">
            <img src="./images/jiri_maly.jpg" alt="Jiří Malý">
        </div>

        <div class="text_container">
            <?php
                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<p class='index_welcome'>Vítej $username na mém webu, </p>";
                } else {
                    echo "<p class='index_welcome'>Vítej na mém webu, </p>";
                }
            ?>
            <p class="index_intro">

            <br>

            <p class="index_intro"><strong>Jsem Jiří Malý</strong>, freelancer se zaměřením na projektové a produktové řízení a programování. S více než 7 lety zkušeností v IT a s mým klíčovým odborným zaměřením na vývoj webových aplikací s využitím Pythonu a PHP, přináším hodnotu a odbornost do každého projektu, na kterém pracuji. </p><br>

            <p class="index_intro">Během mé kariéry jsem se podílel na významných projektech, jako je vedení produktu mobilní aplikace CarSharing, vývoj automatizačních skriptů pro instalaci routerů a vývoj AssetManagementu pro správu sítě. Kromě toho jsem také zkušený webdesigner a mám zkušenosti s projektovým řízením integrace vnitrofiremních procesů a podporou klíčových zákazníků. </p><br>

            <p class="index_intro">Mým hlavním cílem je vytvořit nástroje a aplikace, které usnadní lidem každodenní rutinu a automatizují procesy. <strong>Věřím, že dobrý software by měl zjednodušovat život a pomáhat lidem být produktivnějšími a efektivnějšími.</strong> Aplikace, jako je TimeTrackr, kterou najdete právě zde na mém webu, jsou příkladem toho, jak tohoto cíle dosahujeme. </p><br>

            <p class="index_intro">Pokud hledáte zkušeného profesionála, který vám může pomoci s vývojem aplikací nebo podporou projektu, jsem tu pro vás. Těším se na spolupráci s vámi a na možnost pomoci vám dosáhnout vašich cílů. Neváhejte mě kontaktovat, pokud máte nějaké dotazy nebo pokud byste chtěli probrat možnosti spolupráce. </p>
</p>
        </div>

    </div>

</div>
</body>
</html>

